<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

session_start();

require('adminFunctions.php');

$enteredUser=$_POST['username'];

$enteredPassword=$_POST['password'];

$_SESSION['loggedIn']=logIn($enteredUser,$enteredPassword,$db);

echo $_SESSION['loggedIn'];

ifLoggedIn($_SESSION['loggedIn']);