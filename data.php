<?php

require('config.php');
	print_r($_SESSION);
?>


<!DOCTYPE html>
<html>
<head>
	<title> Logout Page</title>
</head>
<body>
	<a href="logout.php?action=logout" name="logout" value="logout"> <button> Log Out </button> </a>
</body>
</html>