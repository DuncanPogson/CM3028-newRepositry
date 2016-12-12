<?php
/**
 * Created by PhpStorm.
 * User: dave_000
 * Date: 10/12/2016
 * Time: 00:31
 */

session_start();

if (isset($_SESSION['login_username'])) //Session exists
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include("header.php");

        ?>
        <html>
        <main>
            <form action="createNew_club.php" method="post">
                Club Name:<br>
                <input type="text" name="club_name" placeholder="Club Name"  maxlength="60" pattern="[a-zA-Z0-9 ]+">
                <br><br>
                Club Genre:<br>
                <input type="text" name="club_genre" placeholder="Club Genre" maxlength="30" pattern="[a-zA-Z ]+">
                <br><br>
                Club Email:<br>
                <input type="text" name="club_email" placeholder="Club Email"maxlength="60" pattern="[a-zA-Z0-9@ ]+">
                <br><br>
                Club Description:<br>
                <input type="text" name="club_description" placeholder="Description of Club" maxlength="256" pattern="[a-zA-Z0-9 ]+">
                <br><br>
                Club Website:<br>
                <input type="text" name="club_website" placeholder="Club Website" maxlength="256" pattern="[a-zA-Z0-9 ]+">
                <br><br>
                Club Contact:<br>
                <input type="text" name="club_contact" placeholder="Contact Name" maxlength="60" pattern="[a-zA-Z ]+">
                <br><br>
                Club Contact No:<br>
                <input type="number" name="club_contactNo" placeholder="Contact Number" maxlength="14" pattern="[0-9+ ]+">
                <br><br>
                <p><input type="submit" value="Create Club"></p>
            </form>
        </main>
       </html>
        <?
        //
        include("footer.php");

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //connect to the database
        include("Database/LoginSystem/DB_Connect.php");

        $_club_name = htmlentities($_POST["club_name"]);
        $_club_genre = htmlentities($_POST["club_genre"]);
        $_club_email = htmlentities($_POST["club_email"]);
        $_club_description = htmlentities($_POST["club_description"]);
        $_club_website = htmlentities($_POST["club_website"]);
        $_club_contact = htmlentities($_POST["club_contact"]);
        $_club_contactNo = htmlentities($_POST["club_contactNo"]);


        $sql = "INSERT INTO club (clubName, genre, clubEmail, description, website, contactName, contactNo) VALUES ('" . $_club_name . "', '" . $_club_genre . "', '" . $_club_email . "', '" .
            $_club_description . "', '" . $_club_website . "', '" . $_club_contact . "', '" . $_club_contactNo . "')";



    if (mysqli_query($conn, $sql)) {
        header("location:home.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "cannot create club, please try again later.";
    }
}


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to add a club');
}
?>