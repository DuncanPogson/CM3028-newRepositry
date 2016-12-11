<?php

/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 20:48
 */

session_start();

include ("header.php");
include ("Database/LoginSystem/DB_Connect.php");
//include ("calendar_start.php");
echo "

<main>

<h2>Sportlethen</h2>

<p>Sportlethen CSH is an association of local clubs who are working together to develop safe and fun sport and fitness activities within their local area. 
Our website is a single access point to find out more about the fantastic sporting opportunities in our area. </p>

<p>Sportlethen launched on the 13th August 2016 at Portlethen Academy, 
which gave people the opportunity to take part in taster sessions of the different sports they can take up in the local area. </p>

";

$sql = "SELECT * FROM club";
$result = $conn->query($sql);

while($row = $result->fetch_array())
{
    $clubID = $row['clubID'];
    $clubGenre = $row['genre'];
    $clubName = $row['clubName'];
    $clubEmail = $row['clubEmail'];

    echo "<li><a href='club_page.php/?ID={$clubID}'>{$clubName}</a> Contact: {$clubEmail}, Genre: {$clubGenre}. </li>";
}

echo "
</main>
";

//include the footer
include ("footer.php");

