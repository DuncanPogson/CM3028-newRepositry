<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 05/12/2016
 * Time: 20:14
 */
session_start();

//include ("Database/LoginSystem/DB_Connect.php");
include ("header.php");

if (isset($_SESSION['login_username'])) {
    //$_curUser = $_GET['login_username'];
    include ("Database/LoginSystem/DB_Connect.php");
    $_UserSql = "SELECT userID FROM users WHERE username = '" . $_SESSION['login_username'] . "'";
    $userResult = $conn->query($_UserSql);
    echo "User ID: " . $userResult . "";


    //$_ChosenClub = $_GET['ID'];
    $_ClubSql = "SELECT userID FROM club WHERE clubID = '" . $_GET['ID'] . "'";
    $clubResult = $conn->query($_ClubSql);
    echo "Club ID: " . $clubResult . "";

    if (((int)$userResult) == ((int)$clubResult)) {
            echo "<li><a href='updateClub.php'>Update Club</a></li>";
    }
}

    if (isset($_GET['ID'])) {
//    echo $_GET['ID'];
        $_selected_club = $_GET['ID'];
    } else {
        // Fallback behaviour
        echo "Uh Oh, this club seems to be missing, please go back and pick another club.";
    }

    $sql = "SELECT * FROM club where clubID ='" . $_selected_club . "'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
        $_clubName = $row['clubName'];
        $_clubGenre = $row['genre'];
        $_clubEmail = $row['clubEmail'];
        $_clubWebsite = $row['website'];
        $_contactName = $row['contactName'];
        $_contactNo = $row['contactNo'];
        $_description = $row['description'];

        echo "
        <article>
            Title: {$_clubName} \n
            Genre: {$_clubGenre} \n
            Contact Us: \n
            Contact Name: {$_contactName} \n
            Email: {$_clubEmail} \n
            Website: {$_clubWebsite} \n
            Phone Number: {$_contactNo} \n
            Description: \n
            {$_description}
        </article>";
    }

include ("footer.php");