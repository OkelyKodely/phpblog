<!DOCTYPE html>
<html lang="en">

<?php require 'header.php'; ?>

<?php
$userid = $_POST["userid"];

if($userid != null) {
    
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    $ssql = "insert into jspBlogUsers (id,password,name,email,newsletter,framework) values ('".$userid."','".$password."','".$name."','".$email."','1','1')";
    $stid = oci_parse($conn, $ssql);
    oci_execute($stid);

    $ssql = "insert into jspBlogDesign (userid,banner,about) values ('".$userid."','banner1.jpg',' ')";
    $stid = oci_parse($conn, $ssql);
    oci_execute($stid);

    header("Location: http://172.3.226.131:82/index.php", true, 301);
}
?>
	<div class="container">

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Register</th>
				</tr>
				<tr>
					<td>
						<form method="post" action="register.php">
						<table class="table">
							<tr><td>User ID: </td><td><input type="text" name="userid"></td></tr>
							<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
                                                        <tr><td>Name: </td><td><input type="text" name="name"></td></tr>
                                                        <tr><td>Email: </td><td><input type="text" name="email"></td></tr>
							<tr><td colspan="2"><input type="submit" value="Register"></td></tr>
						</table>
						</form>
					</td>
					<td>
						<b><i>demo</i></b><br>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/j7jTwqBNSwE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
oci_close($conn);
?>
</html>