
<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 21:25
 */
session_start();

include ("Database/LoginSystem/DB_Connect.php");


if (isset($_GET['ID'])) {
//    echo $_GET['ID'];
    $_selected_article = $_GET['ID'];
}else{
    // Fallback behaviour
    echo "Uh Oh, theres been an error, please go back and select a new article";
}

    $sql = "SELECT * FROM healthnews where itemID ='" . $_selected_article . "'";
    $result = $conn->query($sql);

    while($row = $result->fetch_array())
    {
        $_articleName = $row['title'];
        $_articleAuthor = $row['username'];
        $_articleText = $row['content'];


        echo "
        <article>
             <h2>{$_articleName}</h2>
             <h3>by {$_articleAuthor}</h3>
             {$_articleText}
        </article>";

    }
