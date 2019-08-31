<?php
session_start();
$conn = oci_connect("sa", "coppersink21", "XE");
?>
<head>
<title>PHPBLOG</title>
<link href="bootstrap.min.css" rel="stylesheet" />
<style>
.header-site{
   background-color: #ff0000;
   background-image: url(top-rpt.jpg); 
   background-position: 100% 100%;
   background-repeat: repeat-x;
   height: 50px;
   color:white;
}
</style>
</head>

<body>
<nav style="bakground-color:red">
	<div class="container">
		<div class="navbar-header">
                    <?php
                        $uid = "";
                        if($_SESSION["userid"] != null)
                            $uid = $_SESSION["userid"];
                        else if($_GET["userid"] != null)
                            $uid = $_GET["userid"];
                        
                        if($uid != "") {
                        ?>
			<a class="navbar-brand" style="color:red;bckground-color: red" href="index2.php?userid=<?php echo $uid; ?>"><img src="logo.png" width="50%" height="50%"><?php echo $uid; ?>'s blog</a>
                        <?php
                        } else {
                        ?>
			<a class="navbar-brand" style="color:white;bckground-color: red" href="index2.php"><img src="logo.png"></a>
                        <?php
                        }
                        ?>
		</div>
		<div id="navbar" style="background-color: red">
			<ul class="nav navbar-nav navbar-right" style="bckground-color: red">
				<?php
                                if($_SESSION["userid"] == null) {
				?>
				<li style="bckground-color: red"><a style="color:red;width:100px" href="login.php">Sign in</a></li>
				<li style="bckground-color: red"><a style="color:red;" href="register.php"><nobr>Sign up</nobr></a></li>
				<?php
                                } else {
				?>
				<li class="active" style="bckground-color:red">
					<div class="navbar-brand" style="color:white;bckground-color: red">
						<a style="color:red;" href="login.php">Manage blog</a>
						|&nbsp;<a style="color:red;" href="t.php">Sign out</a>
					</div>
			  </li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</nav>