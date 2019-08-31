<?php
session_start();
$_SESSION["userid"] = null
?>
<?php

header("Location: http://www.phpblog.gq/index2.php", true, 301);
?>