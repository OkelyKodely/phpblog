<!DOCTYPE html>
<html lang="en">

<?php require 'header.php'; ?>

<?php

$userid = "";

if($_SESSION["userid"] == null) {
    $userid = $_GET["userid"];
} else {
    $userid = $_SESSION["userid"];
}

$entry = "";

$entry = $_GET["id"];

if($userid != null && $entry != null) {
    $ssql = "SELECT id, title, userid, datetime, content FROM jspBlog WHERE id=" . $entry . " AND userid='" . $userid . "'";

    $stid = oci_parse($conn, $ssql);
    oci_execute($stid);
    if(($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $id = $row[0];
        $title = $row[1];
        $user = $row[2];
        $datetime = $row[3];
        $content = $row[4]->load();

        $ssql = "SELECT banner, tcolor, bcolor, btcolor, color FROM jspBlogDesign WHERE userid = '" . $userid . "'";

        $stid2 = oci_parse($conn, $ssql);
        oci_execute($stid2);
        if(($ro = oci_fetch_array($stid2, OCI_BOTH)) != false) {
?>
    <center><a style="position:relative;top:20px" href="index.php?userid=<?php echo $userid; ?>"><img width="100%" height="180" src="<?php echo $ro[0]; ?>" style="position:relative;bottom:20px;"></a></center>
<?php
        $tcolor = $ro[1];
        $bcolor = $ro[2];
        $btcolor = $ro[3];
        $color = $ro[4];
    }
?>
    <table class="table" cellpadding="2">
        <tr>
            <td style="border:1px solid <?php echo $color; ?>">
                <h4><a href="index.php?userid=<?php echo $userid; ?>">Home</a> > <a href="entry.php?userid=<?php echo $userid; ?>&id=<?php echo $entry; ?>"><?php echo $title; ?></a></h4>
		<table class="table table-striped">
                    <tr>
			<td>
                            On <?php echo $datetime; ?> user <?php echo $user; ?> wrote:<br><br>
                            <table width=100% class="table">
				<tr>
                                    <td bgcolor="<?php echo $bcolor; ?>">
                    <h2><a href="entry.php?userid=<?php echo $userid; ?>&id=<?php echo $id; ?>"><span style="color:<?php echo $tcolor; ?>"><?php echo $title; ?></span></a></h2>
                    <span style="color:<?php echo $btcolor; ?>"><?php echo $content; ?></span>
                                    </td>
				</tr>
                            </table>
			</td>
                    </tr>
		</table>

            </td>
            <td style="width:180px;border:1px solid <?php echo $color; ?>">
<?php
    $ssql = "select extract(month from datetime) mon, 
extract(year from datetime) year,
count(datetime) cnt from jspBlog where userid = '".$userid."' 
group by extract(year from datetime), extract(month from datetime)
order by extract(year from datetime), extract(month from datetime)";

    $stid12 = oci_parse($conn, $ssql);
    oci_execute($stid12);

    while(($r100 = oci_fetch_array($stid12, OCI_BOTH)) != false) {
        $mont = $r100[0];
        $year = $r100[1];
        $countArticlesInMonth = $r100[2];

        $mnth = "January";
        if($mont == 1)
            $mnth = "January";
        else if($mont == 2)
            $mnth = "February";
        else if($mont == 3)
            $mnth = "March";
        else if($mont == 4)
            $mnth = "April";
        else if($mont == 5)
            $mnth = "May";
        else if($mont == 6)
            $mnth = "June";
        else if($mont == 7)
            $mnth = "July";
        else if($mont == 8)
            $mnth = "August";
        else if($mont == 9)
            $mnth = "September";
        else if($mont == 10)
            $mnth = "October";
        else if($mont == 11)
            $mnth = "November";
        else if($mont == 12)
            $mnth = "December";
?>
        <a href="index.php?userid=<?php echo $userid; ?>&mon=<?php echo $mont; ?>&year=<?php echo $year; ?>"><?php echo $mnth; ?>, <?php echo $year; ?> (<?php echo $countArticlesInMonth; ?>)</a><br>
<?php
  }
?>
            </td>
	</tr>
    </table>
<?php
    }

}

oci_close($conn);
?>
<br><br><br><br>
<br><br><br><br>
<?php require 'footer.php'; ?>

</body>
</html>