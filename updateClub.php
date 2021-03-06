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

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                include ("Database/LoginSystem/DB_Connect.php");

                $_curUser = $_SESSION['login_username'];
                $sql = "SELECT clubID FROM users WHERE username = '" . $_curUser . "'";
                $result = $conn->query($sql);

                while($row = $result->fetch_array()) {

                    $_currentUser = $row['clubID'];

                    $_ChosenClub = $_GET['selectClubID'];

                    if ((int)$_currentUser == (int)$_ChosenClub) {

                    

                        //php to collect all details from database
                        $collect_sql = "SELECT * FROM club where clubID ='" . $_ChosenClub . "'";
                        $collect_result = $conn->query($collect_sql);

                        while ($collect_row = $collect_result->fetch_array()) {
                            $_clubName = $collect_row['clubName'];
                            $_clubGenre = $collect_row['genre'];
                            $_clubEmail = $collect_row['clubEmail'];
                            $_clubWebsite = $collect_row['website'];
                            $_contactName = $collect_row['contactName'];
                            $_contactNo = $collect_row['contactNo'];
                            $_description = $collect_row['description'];

                            $_SESSION['clubID'] = $_ChosenClub;
                            $_SESSION['clubName'] = $_clubName;
                            $_SESSION['genre'] = $_clubGenre;
                            $_SESSION['clubEmail'] = $_clubEmail;
                            $_SESSION['website'] = $_clubWebsite;
                            $_SESSION['contactName'] = $_contactName;
                            $_SESSION['contactNo'] = $_contactNo;
                            $_SESSION['description'] = $_description;
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
                                    <input type="text" name="clubNameUpdate" maxlength="60" pattern="[a-zA-Z0-9\s]+" placeholder="<?php echo htmlentities($_clubName); ?> ">
                                    <br>
                                    <br>
                                    Club Genre:<br>
                                    <input type="text" name="clubGenreUpdate" maxlength="30" pattern="[a-zA-Z0-9\s]+" maxplaceholder="<?php echo htmlentities($_clubGenre); ?>">
                                    <br>
                                    <br>
                                    Club Email:<br>
                                    <input type="text" name="clubEmailUpdate" maxlength="60" pattern="[a-zA-Z0-9@\s]+"placeholder="<?php echo htmlentities($_clubEmail); ?>">
                                    <br>
                                    <br>
                                    Club Website:<br>
                                    <input type="text" name="clubWebsiteUpdate" maxlength="256" pattern="[a-zA-Z0-9\s]+" placeholder="<?php echo htmlentities($_clubWebsite); ?>">
                                    <br>
                                    <br>
                                    Contact Name:<br>
                                    <input type="text" name="contactNameUpdate" maxlength="60" pattern="[a-zA-Z0-9\s]+" placeholder="<?php echo htmlentities($_contactName); ?>">
                                    <br>
                                    <br>
                                    Contact Num:<br>
                                    <input type="text" name="contactNumberUpdate" maxlength="14" pattern="[0-9+\s]+"placeholder="<?php echo htmlentities($_contactNo); ?>">
                                    <br>
                                    <br>
                                    Description:<br>
                                    <textarea name="descriptionUpdate" maxlength="256" pattern="[a-zA-Z0-9\s]+"placeholder="<?php echo  htmlentities($_description); ?>"></textarea>
                                    <br>
                                    <br>
                                    <input type="submit" value="Update Club">
                                </form>
                            </main>

                            <?
                           
                        }
                    }
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

                include("Database/LoginSystem/DB_Connect.php");

                //Setting update for users
                $new_clubName = htmlentities($_POST['$_clubName']);
                $new_clubGenre = htmlentities($_POST['clubGenreUpdate']);
                $new_clubEmail = htmlentities($_POST['clubEmailUpdate']);
                $new_clubWebsite = htmlentities($_POST['clubWebsiteUpdate']);
                $new_contactName = htmlentities($_POST['contactNameUpdate']);
                $new_contactNo = htmlentities($_POST['contactNumberUpdate']);
                $new_description = htmlentities($_POST['descriptionUpdate']);

                if($new_clubName != null) {
                    $final_clubName = $new_clubName;
                }else{
                    $final_clubName = $_SESSION['clubName'];
                }
                if($new_clubGenre != null) {
                    $final_clubGenre = $new_clubGenre;
                }else{
                    $final_clubGenre = $_SESSION['genre'];
                }
                if($new_clubEmail != null) {
                    $final_clubEmail = $new_clubEmail;
                }else{
                    $final_clubEmail = $_SESSION['clubEmail'];
                }
                if($new_clubWebsite != null) {
                    $final_clubWebsite = $new_clubWebsite;
                }else{
                    $final_clubWebsite = $_SESSION['website'];
                }
                if($new_contactName != null) {
                    $final_contactName = $new_contactName;
                }else{
                    $final_contactName = $_SESSION['contactName'];
                }
                if($new_contactNo != null) {
                    $final_contactNo = $new_contactNo;
                }else{
                    $final_contactNo = $_SESSION['contactNo'];
                }
                if($new_description != null) {
                    $final_description = $new_description;
                }else{
                    $final_description = $_SESSION['description'];
                }

                $_clubID = $_SESSION['clubID'];

                $sql = "UPDATE club SET clubName ='" . $final_clubName ."', genre ='" . $final_clubGenre . "', clubEmail ='" . $final_clubEmail . "', description ='" . $final_description . "', website ='" . $final_clubWebsite . "', contactName ='" . $final_contactName . "', contactNo ='" . $final_contactNo . "' WHERE clubID ='" . $_clubID . "'";

                unset ($_SESSION['login_username'],$_SESSION['AccessLevel'],$_SESSION['clubID'], $_SESSION['clubName'], $_SESSION['genre'], $_SESSION['clubEmail'], $_SESSION['website'], $_SESSION['contactName'], $_SESSION['contactNo'], $_SESSION['description']);

                if (mysqli_query($conn, $sql)) {
                    header("location:/sportlethen.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "pairing failed, please try again later.";
                }
            }



} else {
    // not admin
    header("location:/home.php");
    print('You must be an admin to set Access Levels');
}
?>
