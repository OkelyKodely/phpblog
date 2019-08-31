
<!DOCTYPE html>
<html lang="en">

<?php require 'header.php'; ?>

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

$entry = $_GET["id"];
?>

<?php
if($userid != null && $password != null) {
    $ssql = "select id from jspBlogUsers where id = '" . $userid . "' and password = '" . $password . "'";

    $stid = oci_parse($conn, $ssql);
    oci_execute($stid);

	$title = $_POST["title"];
	$content = $_POST["content"];
    $did = "";
    $did = $_POST["did"];
    if($did == null)
        $did = "";
	if($title != null) {
        $title = str_replace("'","''",$title);
        $content = str_replace("'","''",$content);
        $ssql = "update jspBlog set title = '" . $title . "', content = '" . $content . "' where id = " . $entry;
        $stid2 = oci_parse($conn, $ssql);
        oci_execute($stid2);
    } else if($did != "") {
        $ssql = "delete from jspBlog where id = " + did;
        $stid3 = oci_parse($conn, $ssql);
        oci_execute($stid3);
        header("Location: http://172.3.226.131:82/login.php", true, 301);
    }
    if(($ro = oci_fetch_array($stid, OCI_BOTH)) != false) {
            $_SESSION["userid"] = $userid;
            $_SESSION["password"] = $password;
?>

<div class="container">
    <form method="post" action="edit.php?id=<?php echo $entry; ?>">
	<table class="table table-striped">
            <tr><td><h1>Dashboard</h1></td></tr>
            <tr><td>Go <a href="login.php">back</a> to the main page of the Dashboard.</td></tr>
<?php
            $ssql = "select id, title, datetime, content from jspBlog where userid = '" . $userid . "' and id = " . $entry;
            $stid4 = oci_parse($conn, $ssql);
            oci_execute($stid4);

            if(($r = oci_fetch_array($stid4, OCI_BOTH)) != false) {
?>
            <tr>
		<td>
                    ID: <?php echo $r[0]; ?>
		</td>
            </tr>
            <tr>
                <td>
                    Title: <input type="text" name="title" value="<?php echo $r[1]; ?>">
		</td>
            </tr>
            <tr>
                <td>
                    Date: <?php echo $r[2]; ?>
		</td>
            </tr>
            <tr>
                <td>
                    <textarea name="content" rows="20" cols="150"><?php echo $r[3]->load(); ?></textarea>
		</td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Save">
		</td>
            </tr>
<?php
            }
?>

	</table>
    </form>
    <form method="post" action="edit.php" onsubmit="if(confirm('Want to delete?')){return true;}else{return false;}"><input type="hidden" name="did" value="<?php echo $entry; ?>">&nbsp;&nbsp;<input type="submit" style="color:red;" value="Delete"></form>
</div>
<br>

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