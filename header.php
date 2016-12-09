<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 22:38
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Go Portlethen</title>
    <link rel="stylesheet" href="calendarCss.css" type="text/css">
</head>
<body>
<header>
    <h1>Go Portlethen</h1>
    <nav>
        <ul>
            <li><a href="/home.php">Home</a></li>
            <li><a href="/sportlethen.php">Sportlethen</a></li>
            <li><a href="/health_wellbeing.php">Health and Well-being</a></li>
            <li><a href="/about.php">About</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <?
            if (isset($_SESSION['login_username'])) {
                echo "<li><a href='logout.php'>Logout</a></li>";
            } else {
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </nav>
</header>