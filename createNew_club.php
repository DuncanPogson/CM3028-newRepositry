<?php
/**
 * Created by PhpStorm.
 * User: dave_000
 * Date: 10/12/2016
 * Time: 00:31
 */

if (isset($_SESSION['login_username'])) //Session exists
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include("header.php");

        ?>

        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <!--Setting title of page-->
            <title>Clubs Page</title>
        </head>

        <main>
            <form action="createNew_Club.php" method="post">
                Club Name:<br>
                <input type="text" name="club_name" placeholder="Club Name">
                <br>
                Genre:<br>
                <input type="text" name="club_genre" placeholder=" Club Genre">
                <br><br>
                <input type="text" name="club_email" placeholder="Club Email">
                <br><br>
                <input type="text" name="club_description" placeholder="Description of Club">
                <br><br>
                <input type="text" name="club_website" placeholder="Club Website">
                <br><br>
                <input type="text" name="club_contact" placeholder="Contact Name">
                <br><br>
                <input type="number" name="club_contactNo" placeholder="Contact Number">
                <br><br>
                <p><input type="submit" value="Post"></p>
            </form>
        </main>
        </html>
        <?
        //
        include("footer.php");

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //connect to the database
        include("Database/LoginSystem/DB_Connect.php");

        $_author = $_SESSION['login_username'];
        $_club_name = $_POST["club_name"];
        $_club_genre = $_POST["club_genre"];
        $_club_email = $_POST["club_email"];
        $_club_description = $_POST["club_description"];
        $_club_website = $_POST["club_website"];
        $_club_contact = $_POST["club_contact"];
        $_club_contactNo = $_POST["club_contactNo"];


        $sql = "INSERT INTO club (clubName, genre, clubEmail, description, website, contactName, contactNo) VALUES ('" . $_club_name . "', '" . $_club_genre . "', '" . $_club_email . "', '" . $_club_description . "', '" .
            $_club_description . "', '" . $_club_website . "', '" . $_club_contact . "', '" . $_club_contactNo . "', '" . $_author . "')";

    }


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to add a club');
}
?>