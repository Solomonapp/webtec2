
<?php
// this takes care of the log out session
session_start();
session_destroy();
header("Location: Index.php");
exit();
?>