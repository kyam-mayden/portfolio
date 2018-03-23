<?php
require_once('cmsController.php');
$db = connectDatabase();

/**
 *The function retrieves the password from the database based off the userName, de-hashes DB password and compares to input password
 *
 * @param $enteredPassword string value
 * @param $enteredUName string value
 * @param $db PDO to draw from
 *
 *@return boolean result to confirm passwords match
 */

function pullAndComparePasswords(string $enteredPassword, string $enteredUName, PDO $db):bool {
    $query = $db->prepare("SELECT `password` FROM `users` WHERE `user` = :uName;");
    $query->bindParam(':uName', $enteredUName);
    $query->execute();
    $passwordDB = $query->fetch();
    return password_verify($enteredPassword, $passwordDB['password']);
}

function stripPassword(string $password):string {
    $string1 = trim($password);
    $string2 = htmlspecialchars($string1);
    $newPassword = stripslashes($string2);
    return $newPassword;
}

function ifLoggedIn($loggedIn) {
    if ($loggedIn === true) {
        header('Location: cmsInput.php');
    } else {  header('Location: index.php');}
}

function logIn($username, $password, $db)
{
    $password = stripPassword($password);
    if (pullAndComparePasswords($password, $username, $db) === true) {
        return true;
    } else {
        return false;
    }
}