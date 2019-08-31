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

    $ssql = "SELECT userid, banner, archives, color, tcolor, bcolor, btcolor, about FROM jspBlogDesign WHERE userid = '" . $userid . "'";

    $stid2 = oci_parse($conn, $ssql);
    oci_execute($stid2);

    $color = "";

    $tcolor = "";

    $bcolor = "";

    $btcolor = "";

    $about = "";

    if(($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {
?>
    <center><a style="position:relative;top:20px" href="index2.php?userid=<?php echo $userid; ?>"><img width="100%" height="180" src="<?php echo $row[1]; ?>" style="position:relative;bottom:20px;"></a></center>
<?php
		$color = $row[3];
		$tcolor = $row[4];
		$bcolor = $row[5];
		$btcolor = $row[6];
        $about = $row[7]->load();
    }
?>

    <table class="table" cellpadding="2">
	   <tr><td colspan="2"><h4><a href="index2.php?userid=<?php echo $userid; ?>">Home</a></h4></td></tr>
	   <tr>
            <td valign="top" style="border:1px solid <?php echo $color; ?>">
                <h1>About <?php echo $userid; ?></h1>
                <?php echo $about; ?>
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