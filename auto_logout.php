<?php
// auto logout
/*session_start();
include 'logout_session.php';*/
date_default_timezone_set('asia/kolkata');
$_SESSION['auto_logout']=time();
$auto_logout=time()-$_SESSION['auto_logout'];




?>
<!--<html>
<head>
<META HTTP-EQUIV="refresh" CONTENT="10;URL=logout_session.php">
</head>
<body>
hello.....
</body>
</html>--!>
