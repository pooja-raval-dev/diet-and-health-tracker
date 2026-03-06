<?php
session_start(); // Session start karo

// Sare session variables unset karo
$_SESSION = [];

// Session destroy karo
session_destroy();

// Redirect to login page
header("Location: admin_login.php");
exit;
?>
