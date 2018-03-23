<?php
require_once('cmsController.php');
$db = connectDatabase();

session_start();

require('adminFunctions.php');

$enteredUser=$_POST['username'];

$enteredPassword=$_POST['password'];

$_SESSION['loggedIn']=logIn($enteredUser,$enteredPassword,$db);

echo $_SESSION['loggedIn'];

ifLoggedIn($_SESSION['loggedIn']);