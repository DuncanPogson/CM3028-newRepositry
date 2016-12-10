<?php
/**
 * Created by Phd
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 20:59
 */
session_start();

include ("Database/LoginSystem/DB_Connect.php");
include ("header.php");
//include ("calendar.php");
include ("events.php");

echo "
<main>
<h2>Health Articles</h2>
<ul>
";

if (((int)$_SESSION['AccessLevel']) >= 2) {
    echo "<a href='createNew_HealthArticle.php'>Create New Article</a>";
} else {
    echo "You can only read articles, Login to write your own!";
}

$sql = "SELECT * FROM healthnews ";
$result = $conn->query($sql);

while($row = $result->fetch_array())
{
    $articleID = $row['itemID'];
    $articleName = $row['title'];
    $articleAuthor = $row['username'];


    echo "<li><a href='health_article.php/?ID={$articleID}'>{$articleName}</a> by {$articleAuthor}</li>";

}


echo "
</main>
";
include ("footer.php");

