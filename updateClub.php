<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 12/12/2016
 * Time: 02:44
 */

session_start();

if (isset($_SESSION['login_username'])) //Session exists and access level is high enough to set admins
{
    include ("Database/LoginSystem/DB_Connect.php");
    $_curUser = $_SESSION['login_username'];
    $sql = "SELECT clubID FROM users WHERE username = '" . $_curUser . "'";
    $result = $conn->query($sql);

    while($row = $result->fetch_array()) {

        $_currentUser = $row['clubID'];

        $_ChosenClub = $_GET['ID'];

        if ((int)$_currentUser == (int)$_ChosenClub) {

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                include("header.php");

                //php to collect all details from database
                $collect_sql = "SELECT * FROM club where clubID ='" . $_ChosenClub . "'";
                $collect_result = $conn->query($collect_sql);

                while ($collect_row = $collect_result->fetch_array()) {
                    $_clubName = $row['clubName'];
                    $_clubGenre = $row['genre'];
                    $_clubEmail = $row['clubEmail'];
                    $_clubWebsite = $row['website'];
                    $_contactName = $row['contactName'];
                    $_contactNo = $row['contactNo'];
                    $_description = $row['description'];



                    //html code to collect user input in the a html form and create a health article from the info
                ?>

                <head>
                    <title>Set Access Level</title>
                </head>
                <main>
                    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                    <script>tinymce.init({selector: 'textarea'});</script>
                    <form action="updateClub.php" method="post">
                        Club Name:<br>
                        <input type="text" name="clubNameUpdate" placeholder="<?php echo htmlspecialchars($_clubName); ?>">
                        <br>
                        <br>
                        Club Genre:<br>
                        <input type="text" name="clubGenreUpdate" placeholder="<?php echo htmlspecialchars($_clubGenre); ?>">
                        <br>
                        <br>
                        Club Email:<br>
                        <input type="text" name="clubEmailUpdate" placeholder="<?php echo htmlspecialchars($_clubEmail); ?>">
                        <br>
                        <br>
                        Club Website:<br>
                        <input type="text" name="clubWebsiteUpdate" placeholder="<?php echo htmlspecialchars($_clubWebsite); ?>">
                        <br>
                        <br>
                        Contact Name:<br>
                        <input type="text" name="contactNameUpdate" placeholder="<?php echo htmlspecialchars($_contactName); ?>">
                        <br>
                        <br>
                        Contact Num:<br>
                        <input type="text" name="contactNumberUpdate" placeholder="<?php echo htmlspecialchars($_contactNo); ?>">
                        <br>
                        <br>
                        Description:<br>
                        <textarea name="descriptionUpdate" placeholder="<?php echo htmlspecialchars($_description); ?>"></textarea>
                        <br>
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

                    echo "<li>Username: {$userName}, User ID: {$userID}";

                }

                include("footer.php");

            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

                include("Database/LoginSystem/DB_Connect.php");

                //Setting update for users
                $_UserAccLvl = $_POST['userForUpdate'];
                $_newAccLvl = $_POST["newAccessLvl"];

                $sql = "UPDATE users SET accessLevel ='" . $_newAccLvl ."' WHERE userID ='" . $_UserAccLvl . "'";

                if (mysqli_query($conn, $sql)) {
                    header("location:home.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "pairing failed, please try again later.";
                }
            }

        }
    }
} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to set Access Levels');
}
?>