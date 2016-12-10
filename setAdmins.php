<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 10/12/2016
 * Time: 13:52
 */

session_start();

if ((isset($_SESSION['login_username'])) && (((int)$_SESSION['AccessLevel']) >= 4)) //Session exists and access level is high enough to set admins
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include("header.php");

        //html code to collect user input in the a html form and create a health article from the info
        ?>

        <head>
            <title>Set Access Level</title>
        </head>
        <main>
            <form action="setAdmins.php" method="post">
                <input type="text" name="clubForAdmin" placeholder="Club Title">
                <br>
                <input type="number" name="newClubAdmin" placeholder="UserID" ><br>
                <br>
                <input type="submit" value="Set Admins">
            </form>
        </main>

        </body>
        </html>

        <?

        include("footer.php");

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //connect to the database
        include("Database/LoginSystem/DB_Connect.php");


        echo"\nAll Users:";
        $sql = "SELECT * FROM users ";
        $result = $conn->query($sql);

        while($row = $result->fetch_array())
        {
            $userName = $row['username'];
            $userID = $row['userID'];

            echo "<li>{$userName}, User ID: {$userID}";

        }

        echo"\n\nAll Clubs:";
        $sql = "SELECT * FROM clubs ";
        $result = $conn->query($sql);

        while($row = $result->fetch_array())
        {
            $clubName = $row['clubName'];
            $clubID = $row['clubID'];
            $currentAdmin = $row['userID'];


            echo "<li>{$clubName}, ID: {$clubID}, Current Admin: {$currentAdmin}</li>";

        }

        //Adding new admin to club
        //$_author = $_SESSION['login_username'];
        //$_ha_title = $_POST["articleTitle"];
        //$_ha_importance = $_POST["ha_importance"];
        //$_ha_content = $_POST["articleText"];


        //$sql = "INSERT INTO healthnews (title, content, importance, username) VALUES ('" . $_ha_title . "', '" . $_ha_content . "', '" . $_ha_importance . "', '" . $_author . "')";

        //if (mysqli_query($conn, $sql)) {
        //    header("location:home.php");
        //} else {
        //    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        //    echo "post failed, please try again later.";
        //}
    }


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to set admins');
}
?>