<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php
$userid = "";

$password = "";

if($_SESSION["userid"] == null) {

	$userid = $_POST["userid"];
	$password = $_POST["password"];

} else {

	$userid = $_SESSION["userid"];
	$password = $_SESSION["password"];

}
?>

<?php require 'header.php'; ?>

<?php
if($userid != null && $password != null) {
    $ssql = "select id from jspBlogUsers where id = '" . $userid . "' and password = '" . $password . "'";
    $stid = oci_parse($conn, $ssql);
    oci_execute($stid);
    if (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $_SESSION["userid"] = $userid;
        $_SESSION["password"] = $password;
?>
	<div class="container">

		<table class="table table-striped">
			<thead>
				<tr><td><h1>Manage Blog</h1></td></tr>
				<tr>
					<th colspan="3">You are now logged in to your Dashboard.  Visit your <a href="index2.php?userid=<?php echo $userid; ?>">blog</a>.</th>
				</tr>
				<tr><td><a href="new.php"><button type="button" class="btn btn-default">New Blog Entry</button></a></td></tr>
<?php
$bannr = $_POST["banner"];
$archives = $_POST["archives"];
$color = $_POST["color"];
$tcolor = $_POST["tcolor"];
$bcolor = $_POST["bcolor"];
$btcolor = $_POST["btcolor"];
$about = $_POST["about"];
if($archives != null && $bannr != null && $color != null && $about != null) {
    $ssql = "update jspBlogDesign set about = '" . $about . "', banner = '" . $bannr . "', archives = '" . $archives . "', color = '" . $color . "', tcolor = '" . $tcolor . "', bcolor = '" . $bcolor . "', btcolor = '" . $btcolor . "' where userid = '" . $userid . "'";
    $stid2 = oci_parse($conn, $ssql);
    oci_execute($stid2);
}

$ssql = "select banner, about, archives, color, tcolor, bcolor, btcolor, userid from jspBlogDesign where userid = '" . $userid . "'";
$stid3 = oci_parse($conn, $ssql);
oci_execute($stid3);
if (($rw = oci_fetch_array($stid3, OCI_BOTH)) != false) {
    $bannr = $rw[0];
    $archives = $rw[2];
    $color = $rw[3];
    $tcolor = $rw[4];
    $bcolor = $rw[5];
    $btcolor = $rw[6];
    
?>
<tr>
	<td>
	  <form method="post" action="login.php">
		<table>
			<td>
			  <table>
				<tr>
					<td colspan="3">
						<b>Colors Theme</b>
						<br>
						Black <input type="radio" name="color" value="black" <?php if($color == "black") echo "checked=\"checked\""; ?>>
						Blue <input type="radio" name="color" value="blue" <?php if($color == "blue") echo "checked=\"checked\""; ?>>
						Red <input type="radio" name="color" value="red" <?php if($color == "red") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<b>Title Colors</b>
						<br>
						Black <input type="radio" name="tcolor" value="black" <?php if($tcolor == "black") echo "checked=\"checked\""; ?>>
						Gray <input type="radio" name="tcolor" value="gray" <?php if($tcolor == "gray") echo "checked=\"checked\""; ?>>
						Navy <input type="radio" name="tcolor" value="blue" <?php if($tcolor == "navy") echo "checked=\"checked\""; ?>>
						Red <input type="radio" name="tcolor" value="red" <?php if($tcolor == "red") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<b>Body Colors</b>
						<br>
						Black <input type="radio" name="bcolor" value="black" <?php if($bcolor == "black") echo "checked=\"checked\""; ?>>
						Navy <input type="radio" name="bcolor" value="navy" <?php if($bcolor == "navy") echo "checked=\"checked\""; ?>>
						White <input type="radio" name="bcolor" value="white" <?php if($bcolor == "white") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<b>Body Text Colors</b>
						<br>
						Black <input type="radio" name="btcolor" value="black" <?php if($btcolor == "black") echo "checked=\"checked\""; ?>>
						Yellow <input type="radio" name="btcolor" value="yellow" <?php if($btcolor == "yellow") echo "checked=\"checked\""; ?>>
						White <input type="radio" name="btcolor" value="white" <?php if($btcolor == "white") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner1.jpg: <img src="banner1.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner1.jpg" <?php if($bannr == "banner1.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner2.jpg: <img src="banner2.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner2.jpg" <?php if($bannr == "banner2.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner3.jpg: <img src="banner3.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner3.jpg" <?php if($bannr == "banner3.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner4.jpg: <img src="banner4.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner4.jpg" <?php if($bannr == "banner4.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner5.jpg: <img src="banner5.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner5.jpg" <?php if($bannr == "banner5.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner6.jpg: <img src="banner6.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner6.jpg" <?php if($bannr == "banner6.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						banner7.jpg: <img src="banner7.jpg" width = 300>
						<br>
                        <input type="radio" name="banner" value="banner7.jpg" <?php if($bannr == "banner7.jpg") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<b>Archives</b>
						<br>
						Left Aligned <input type="radio" name="archives" value="L" <?php if($archives == "L") echo "checked=\"checked\""; ?>>
						Right Aligned <input type="radio" name="archives" value="R" <?php if($archives == "R") echo "checked=\"checked\""; ?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="submit" value="Save">
					</td>
				</tr>
					</table>
				</td>
				<td valign="top" style="padding:10px">
					<b>
						About this Blog
					</b>
					<br>
						<textarea name="about" style="width:300px;height:200px;"><?php echo $rw[1]->load(); ?></textarea>
					</form>
				</td>
			</tr>
		</table>
  	  </form>
	</td>
</tr>
				<tr>
					<td>
						ID
					</td>
					<td>
						Title
					</td>
					<td>
						Date
					</td>
				</tr>

<?php
}

$ssql = "select id, title, datetime from jspBlog where userid = '" . $userid . "' order by id desc";
$stid = oci_parse($conn, $ssql);
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
?>
				<tr>
					<td>
						<a href="entry.php?userid=<?php echo $userid; ?>&id=<?php echo $row[0]; ?>"><?php echo $row[0]; ?></a>
					</td>
					<td>
						<a href="edit.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a>
					</td>
					<td>
						<?php echo $row[2]; ?>
					</td>
				</tr>
<?php
}
?>

			</thead>

		</table>

	</div>

        <?php require 'footer.php'; ?>

</body>

<?php
    } else {
?>
	<div class="container">

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Login</th>
				</tr>
				<tr>
					<td>
						<form method="post" action="login.php">
						<table class="table">
							<tr><td>User ID: </td><td><input type="text" name="userid"></td></tr>
							<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
							<tr><td colspan="2"><input type="submit" value="Login"></td></tr>
						</table>
						</form>
					</td>
				</tr>
			</thead>

		</table>

	</div>

Powered by...
<br><br><br><br><br> <br>
<img src="main-banner.jpg" width="100%" height="137%">

        <?php require 'footer.php'; ?>

</body>
<?php
	}
} else {
?>
	<div class="container">

		<table class="table table-striped">

			<thead>
				<tr>
					<th>Login</th>
				</tr>
				<tr>
					<td>
						<form method="post" action="login.php">
						<table class="table">
							<tr><td>User ID: </td><td><input type="text" name="userid"></td></tr>
							<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
							<tr><td colspan="2"><input type="submit" value="Login"></td></tr>
						</table>
						</form>
					</td>
				</tr>
			</thead>

		</table>

	</div>

Powered by...
<br><br><br><br><br> <br><br><br><br><br><br> <br>
<img src="main-banner.jpg" width="100%" height="137%">

    <?php require 'footer.php'; ?>

</body>
<?php
}
oci_close($conn);
?>
</html>