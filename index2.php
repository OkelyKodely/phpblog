<!DOCTYPE html>
<html lang="en">

<?php require 'header.php'; ?>

<?php

$userid = "";

if($_SESSION["userid"] == null) {
    $userid = $_GET["userid"];
}
else {
    $userid = $_SESSION["userid"];
}

if($userid != "") {

    $mon = $_GET["mon"];
    $year = $_GET["year"];

    if($mon == null || $year == null) {
      $ssql = "SELECT id, title, content, datetime, userid FROM jspBlog WHERE userid='" . $userid . "' ORDER BY id DESC";

      $stid = oci_parse($conn, $ssql);
      oci_execute($stid);
    } else {
      $ssql = "SELECT id, title, content, datetime, userid FROM jspBlog WHERE extract(year from datetime)=" . $year . " AND extract(month from datetime)=" . $mon . " AND userid='" . $userid . "' ORDER BY id DESC";

      $stid = oci_parse($conn, $ssql);
      oci_execute($stid);
    }

    $ssql = "SELECT userid, banner, archives, color, tcolor, bcolor, btcolor FROM jspBlogDesign WHERE userid = '" . $userid . "'";

    $stid2 = oci_parse($conn, $ssql);
    oci_execute($stid2);

    $color = "";

    $tcolor = "";

    $bcolor = "";

    $btcolor = "";

    if(($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {
?>
    <center><a style="position:relative;top:20px" href="index2.php?userid=<?php echo $userid; ?>"><img width="100%" height="180" src="<?php echo $row[1]; ?>" style="position:relative;bottom:20px;"></a></center>
<?php
		$color = $row[3];
		$tcolor = $row[4];
		$bcolor = $row[5];
		$btcolor = $row[6];
    }
?>

    <table class="table" cellpadding="2">
	<tr><td colspan="2"><h4><a href="index2.php?userid=<?php echo $userid; ?>">Home</a></h4></td></tr>
	<tr>
		<?php
		if($row[2] == "R") {
            ?>
            <th>Entries</th>
            <th>Monthly Archives</th>
            <?php
        	} else if($row[2] == "L") {
        		?>
            <th>Monthly Archives</th>
            <th>Entries</th>
            <?php
        }
            ?>
	</tr>
        <tr>
        	<?php
if($row[2] == "R") {
	?>
            <td valign="top" style="border:1px solid <?php echo $color; ?>">
<?php
  while (($rw = oci_fetch_array($stid, OCI_BOTH)) != false) {
    // Use the uppercase column names for the associative array indices
        $id = $rw[0];
        $title = $rw[1];
        $user = $rw[4];
        $datetime = $rw[3];
        $content = $rw[2]->load();
?>
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
<?php
    }

    $ssql = "select extract(month from datetime) mon, 
extract(year from datetime) year,
count(datetime) cnt from jspBlog where userid = '".$userid."' 
group by extract(year from datetime), extract(month from datetime)
order by extract(year from datetime), extract(month from datetime)";

    $stid3 = oci_parse($conn, $ssql);
    oci_execute($stid3);
?>
            </td>
            <td style="width:180px;border:1px solid <?php echo $color; ?>">
<?php
    while(($r100 = oci_fetch_array($stid3, OCI_BOTH)) != false) {
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
        <a href="index2.php?userid=<?php echo $userid; ?>&mon=<?php echo $mont; ?>&year=<?php echo $year; ?>"><?php echo $mnth; ?>, <?php echo $year; ?> (<?php echo $countArticlesInMonth; ?>)</a><br>
<?php
  }
?>
            </td>
            <?php
			} else if($row[2] == "L") {
            ?>
<?php

    $ssql = "select extract(month from datetime) mon, 
extract(year from datetime) year,
count(datetime) cnt from jspBlog where userid = '".$userid."' 
group by extract(year from datetime), extract(month from datetime)
order by extract(year from datetime), extract(month from datetime)";

    $stid3 = oci_parse($conn, $ssql);
    oci_execute($stid3);
?>
            <td style="width:180px;border:1px solid <?php echo $color; ?>">
<?php
    while(($r100 = oci_fetch_array($stid3, OCI_BOTH)) != false) {
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
        <a href="index2.php?userid=<?php echo $userid; ?>&mon=<?php echo $mont; ?>&year=<?php echo $year; ?>"><?php echo $mnth; ?>, <?php echo $year; ?> (<?php echo $countArticlesInMonth; ?>)</a><br>
<?php
  }
?>
</td>
            <td valign="top" style="border:1px solid <?php echo $color; ?>">
                <a href="about.php?userid=<?php echo $userid; ?>">About <?php echo $userid; ?></a><br>
<?php
  while (($rw3 = oci_fetch_array($stid, OCI_BOTH)) != false) {
    // Use the uppercase column names for the associative array indices
        $id = $rw3[0];
        $title = $rw3[1];
        $user = $rw3[4];
        $datetime = $rw3[3];
        $content = $rw3[2]->load();
?>
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
<?php
    }
?>
            </td>
            <?php
			}
            ?>
	</tr>
    </table>
<?php
} else {
?>
<img src="main-banner.jpg" width="100%" height="137%" style="position:relative;top:-0px">
<br>
<table cellpadding="10">
<tr>
<td>&nbsp;</td>
<td>
<font size="4">
<em>PHPBLOG</em> is an online blogger for everyone who registers with us (for free) wchich is currently available to the internet community for all to share openly.
<br><br>
Try us out now and start blogging right away!
<br><br>
<center>
<b><i>demo</i></b><br>
<iframe width="860" height="500" src="https://www.youtube.com/embed/j7jTwqBNSwE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</center>
<br><br><br> <br>
Powered by... <b>php</b>
<br><br><br><br><br> <br>
</font>
</td>
</tr>
</table>

<?php
}
oci_close($conn);
?>

<?php 
require 'footer.php';
?>

</body>
</html>