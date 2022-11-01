<?php
require_once('config.php');

if(isset($_GET['action']) && $_GET['action'] == 'logout'){

	session_destroy();
	session_unset();
}


?>