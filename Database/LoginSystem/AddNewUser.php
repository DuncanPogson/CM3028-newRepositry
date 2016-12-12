<?php
/**
 * Created by Duncan Pogson.
 * User: 1405466
 * Date: 21/11/2016
 * Time: 14:28
 */

include("DB_Connect.php");

$_username = htmlentities($_POST["username"]);
$_email = htmlentities($_POST["Email"]);
$_password = htmlentities($_POST["Password"]);
$_dateOfBirth = htmlentities($_POST["dateOfBirth"]);
$_address = htmlentities($_POST["address"]);
$_firstName = htmlentities($_POST["firstName"]);
$_lastName = htmlentities($_POST["lastName"]);
$_accessLevel = 1;


$sql = "INSERT INTO users (email, username, password, dateOfBirth, address, firstName, lastName, accessLevel) VALUES ('$_email', '$_username', '$_password', '$_dateOfBirth', '$_address', '$_firstName', '$_lastName', '$_accessLevel')";

if(mysqli_query($conn, $sql)){
    header("location:../../login.php");
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "invalid information, please check your details and try again";
}

