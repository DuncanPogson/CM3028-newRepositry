<?php
/**
 * Created by Duncan Pogson.
 * User: 1405466
 * Date: 21/11/2016
 * Time: 14:28
 */

include("DB_Connect.php");

$_username = $_POST["username"];
$_email = $_POST["Email"];
$_password = $_POST["Password"];
$_dateOfBirth = $_POST["dateOfBirth"];
$_address = $_POST["address"];
$_firstName = $_POST["firstName"];
$_lastName = $_POST["lastName"];
$_accessLevel = 1;


$sql = "INSERT INTO users (email, username, password, dateOfBirth, address, firstName, lastName, accessLevel) VALUES ('$_email', '$_username', '$_password', '$_dateOfBirth', '$_address', '$_firstName', '$_lastName', '$_accessLevel')";

if(mysqli_query($conn, $sql)){
    header("location:../../login.php");
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "invalid information, please check your details and try again";
}

