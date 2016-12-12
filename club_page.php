<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 05/12/2016
 * Time: 20:14
 */
session_start();

include ("header.php");

    if (isset($_GET['ID'])) {
//    echo $_GET['ID'];
        $_selected_club = $_GET['ID'];
    } else {
        // Fallback behaviour
        echo "Uh Oh, this club seems to be missing, please go back and pick another club.";
    }

    include ("Database/LoginSystem/DB_Connect.php");
    $_curUser = $_SESSION['login_username'];
    $sql = "SELECT clubID FROM users WHERE username = '" . $_curUser . "'";
    $result = $conn->query($sql);

    while($row = $result->fetch_array()) {

        $_currentUser = $row['clubID'];

        $_ChosenClub = $_GET['ID'];

        if ((int)$_currentUser == (int)$_ChosenClub) {
            //echo "<li><a href='/updateClub.php/?ID={$_ChosenClub}'>Update Club</a></li>";
            echo "<li><a href='/updateClub.php/?selectClubID={$_ChosenClub}'>Update Club</a></li>";
        }
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

$sql = "SELECT * FROM photo where clubID ='" . $_selected_club . "'";
$result = $conn->query($sql);

while ($row = $result->fetch_array()) {
    $_caption = $row['caption'];
    $_url = $row['url'];

    echo "<table>";

    while($row = $result->fetch_array()) {

        echo "<tr>";
        echo "<td>";?> <img src="<?php echo $row["url"]; ?>" <height="100" width="100"> <?php echo "</td>";
        echo "<td>"; echo $row["caption"]; echo "</td>";

        echo "</tr>";

    }
    echo "</table>";






}

include ("footer.php");