<!DOCTYPE html>
<html lang="en">

<?php require 'header.php'; ?>

<?php

userid = "";

if($_SESSION["userid"] == null) {
    $userid = $_GET["userid"];
}
else {
    $userid = $_SESSION["userid"];
}

if(!$userid != "") {

    $mon = $_GET["mon"];
    $year = $_GET["year"];

    if($mon == null || $year == null) {
      $ssql = "SELECT * FROM jspBlog WHERE userid='" . userid . "' ORDER BY id DESC";

      $stid = oci_parse($conn, $ssql);
      oci_execute($stid);
    } else {
      $ssql = "SELECT * FROM jspBlog WHERE date_part('year',datetime)=" . year . " AND date_part('month',datetime)=" . mon . " AND userid='" . userid . "' ORDER BY id DESC";

      $stid = oci_parse($conn, $ssql);
      oci_execute($stid);
    }

    $ssql = "SELECT * FROM jspBlogDesign WHERE userid = '" . userid . "'";

    $stid2 = oci_parse($conn, $ssql);
    oci_execute($stid2);

    if(($row = oci_fetch_array($stid3, OCI_BOTH)) != false) {
?>
    <center><a href="index.php?userid=<?php echo $userid; ?>"><img src="<?php echo $row["banner"]; ?>" style="position:relative;bottom:20px;"></a></center>
<?php
    }
?>

    <table class="table" cellpadding="2">
	<tr><td colspan="2"><h4><a href="index.jsp?userid=<%=userid%>">Home</a></h4></td></tr>
	<tr>
            <th>Entries</th>
            <th>Monthly Archives</th>
	</tr>
        <tr>
            <td valign="top">
<?php
  while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    // Use the uppercase column names for the associative array indices
        $id = rs1.getString("id");
        $title = rs1.getString("title");
        $user = rs1.getString("userid");
        $datetime = rs1.getString("datetime");
        $content = rs1.getString("content");
?>
		<table class="table table-striped">
                    <tr>
			<td>
                            On <%=datetime%> user <%=user%> wrote:<br><br>
                            <table width=100% class="table">
				<tr>
                                    <td>
					<h2><a href="entry.jsp?userid=<%=userid%>&id=<%=id%>"><%=title%></a></h2>
					<%=content%>
                                    </td>
				</tr>
                            </table>
			</td>
                    </tr>
		</table>
<%
    }

    Statement st2 = conn.createStatement();
    ResultSet rs2 = st2.executeQuery("SELECT to_char(to_timestamp (date_part('month', datetime)::text, 'MM'), 'Month') mont, date_part('month',datetime) mon, date_part('year',datetime) as yea, " +
			"count(datetime) as countArticlesInMonth FROM jspBlog WHERE userid='" + userid + "'" +
			"GROUP BY date_part('year',datetime), date_part('month',datetime) ORDER BY date_part('year',datetime), date_part('month',datetime)");
%>
            </td>
            <td style="width:180px;border:1px solid #e0e0e0">
<%
    if(rs2 != null)
    while(rs2.next()) {
        String month = rs2.getString("mont");
        String mont = rs2.getString("mon");
        year = rs2.getString("yea");
        String countArticlesInMonth = rs2.getString("countArticlesInMonth");
%>
        <a href="index.jsp?userid=<%=userid%>&mon=<%=mont%>&year=<%=year%>"><%=month%>, <%=year%> (<%=countArticlesInMonth%>)</a><br>
<%
  }
%>
            </td>
	</tr>
    </table>
<%
} else {
%>
<br>
<table cellpadding="10">
<tr>
<td>&nbsp;</td>
<td>
<font size="3">
JSP BLOG is a free blog creator for anyone who registers with us for free and is open to the internet community.
<br><br>
Try us out now and start blogging right away!
</font>
</td>
</tr>
</table>
<br>
<br>
<%
}

try {
    conn.close();
} catch(Exception e) {
}
%>

<%@include file="footer.jsp"%>

</body>
</html>