<?php 

session_start();

session_destroy();

$_SESSION['success'] = 'You have been logged out successfully!';
header("refresh:0;url=auth/signin.php");