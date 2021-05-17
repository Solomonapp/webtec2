<?php
	//this starts session
	session_start();
	//removes session information
	session_unset();
	//destroys session
	session_destroy();
	//relocates user
	header("Location: ../Index.php");
?>
