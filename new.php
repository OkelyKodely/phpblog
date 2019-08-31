<?php require 'header.php'; ?>

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

<?php
if($userid != null && $password != null) {
	$ssql = "select id from jspBlogUsers where id = '" . $userid . "' and password = '" . $password . "'";
	$stid = oci_parse($conn, $ssql);
	oci_execute($stid);

    $title = $_POST["title"];
    $content = $_POST["content"];
    if($title == null)
        $title = "";
    if($content == null)
        $content = "";
    $title = str_replace("'","''",$title);
    $content = str_replace("'","''",$content);
    $content = str_replace("\n","<br><br>",$content);

    if($title != "" && $content != "") {
		$ssql = "insert into jspBlog (title,content,datetime,userid) values ('" . $title . "','" . $content . "',current_timestamp,'".$userid."')";
		$stid2 = oci_parse($conn, $ssql);
		oci_execute($stid2);

	    header("Location: http://www.phpblog.gq/login.php", true, 301);
    }

    if (($rw = oci_fetch_array($stid, OCI_BOTH)) != false) {
        $_SESSION["userid"] = $userid;
        $_SESSION["password"] = $password;
?>
<div class="container">

<form method="post" action="new.php">
		<table class="table table-striped">
			<tr><td><h1>New Blog Entry</h1></td></tr>
			<tr><td>Go <a href="login.php">back</a> to the main page of the Dashboard.</td></tr>
				<tr>
					<td>
						ID: New ID
					</td>
				</tr>
				<tr>
					<td>
						Title: <input type="text" name="title">
					</td>
				</tr>
				<tr>
					<td>
						Date: Current
					</td>
				</tr>

				<tr>
					<td>
						<textarea name="content" rows="20" cols="130"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Submit">
					</td>
				</tr>

		</table>
</form>
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

	<?php require 'footer.php'; ?>

</body>
<?php
}

oci_close($conn);
?>

</html>