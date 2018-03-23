<?php
require_once('cmsController.php');
$db = connectDatabase();

session_start();

require('adminFunctions.php');

$_SESSION['loggedIn']=logIn($_POST['username'],$_POST['password'],$db);

ifLoggedIn($_SESSION['loggedIn']);