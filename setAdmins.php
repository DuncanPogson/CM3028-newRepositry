<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 10/12/2016
 * Time: 13:52
 */

//session_start();

if ((isset($_SESSION['login_username'])) && (((int)$_SESSION['AccessLevel']) >= 4)) //Session exists and access level is high enough to set pairings
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        

        //html code to collect user input in the a html form and create a health article from the info
        ?>

        <head>
            <title>Set Access Level</title>
        </head>
        <main>
            <form action="setAdmins.php" method="post">
                <input type="number" name="clubForAdmin" placeholder="ClubID">
                <br>
                <input type="number" name="newClubAdmin" placeholder="UserID" ><br>
                <input type="submit" value="Set Admins">
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

            echo "<li>Username: {$userName}, User ID: {$userID}";

        }

        echo""."<br/>"."All Clubs:"."<br/>"."";
        $sqlClub = "SELECT * FROM club ";
        $clubResult = $conn->query($sqlClub);

        while($clubRow = $clubResult->fetch_array())
        {
            $clubName = $clubRow['clubName'];
            $clubID = $clubRow['clubID'];
            $currentAdmin = $clubRow['userID'];


            echo "<li>Club Name: {$clubName}, ID: {$clubID}, Current Admin: {$currentAdmin}</li>";

        }


       

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include("Database/LoginSystem/DB_Connect.php");

        //Adding new admin to club
        $_ClubForAdmin = htmlentities($_POST['clubForAdmin']);
        $_AdminForClub = htmlentities($_POST["newClubAdmin"]);

        $sql = "UPDATE club SET userID ='" . $_AdminForClub ."' WHERE clubID ='" . $_ClubForAdmin . "'";

        if (mysqli_query($conn, $sql)) {
            header("location:sportlethen.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "pairing failed, please try again later.";
        }
    }


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to create admin/club pairings');
}
?>
