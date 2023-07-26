<?php

session_start();

session_destroy();

$_SESSION['success'] = "You have been logged out";
header('location: auth/signin.php');
