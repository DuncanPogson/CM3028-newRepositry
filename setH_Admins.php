<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 12/12/2016
 * Time: 01:49
 */
session_start();

if ((isset($_SESSION['login_username'])) && (((int)$_SESSION['AccessLevel']) >= 4)) //Session exists and access level is high enough to set admins
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      

        //html code to collect user input in the a html form and create a health article from the info
        ?>

        <head>
            <title>Set Access Level</title>
        </head>
        <main>
            <form action="setH_Admins.php" method="post">
                UserID:<br>
                <input type="number" name="userForUpdate" placeholder="UserID">
                <br>
                <br>
                Access Level: 1 - 4<br>
                <input type="number" name="newAccessLvl" placeholder="1" min="1" max="4">
                <br>
                <input type="submit" value="Update Admins">
            </form>
        </main>

        <?

        //Listing all clubs/Users to make it easier for the club admin to select which user/club admin relationship they wish to create.
        include("Database/LoginSystem/DB_Connect.php");

        echo""."<br/>"."All Users:"."<br/>"."";
        $sql = "SELECT * FROM users ";
        $result = $conn->query($sql);

        while($row = $result->fetch_array())
        {
            $userName = $row['username'];
            $userID = $row['userID'];
            $userAccessLvl = $row['accessLevel'];

            echo "<li>Username: {$userName}, User ID: {$userID}, Access Level: {$userAccessLvl}";

        }

 

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include("Database/LoginSystem/DB_Connect.php");

        //Setting update for users
        $_UserAccLvl = htmlentities($_POST['userForUpdate']);
        $_newAccLvl = htmlentities($_POST["newAccessLvl"]);

        $sql = "UPDATE users SET accessLevel ='" . $_newAccLvl ."' WHERE userID ='" . $_UserAccLvl . "'";

        if (mysqli_query($conn, $sql)) {
            header("location:home.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "pairing failed, please try again later.";
        }
    }


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to set Access Levels');
}
?>
