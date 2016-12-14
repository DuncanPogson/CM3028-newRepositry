<?php
/**
 * Created by PhpStorm.
 * User: 1405466
 * Date: 09/12/2016
 * Time: 14:20
 */



if (isset($_SESSION['login_username'])) //Session exists
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
       

        //html code to collect user input in the a html form and create a health article from the info
        ?>

        <head>
            <title>Create Article</title>
        </head>
        <main>
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            <script>tinymce.init({selector: 'textarea'});</script>
            <form action="createNew_HealthArticle.php" method="post">
                Article Title: <br>
                <input type="text" name="articleTitle" placeholder="Article Title" maxlength="30" pattern="[a-zA-Z0-9 ]+">
                <br>
                Article Importance: <br>
                <input type="number" name="ha_importance" placeholder="0" min="0" max="5"><br>
                <br>
                Content: <br>
                <textarea name="articleText" maxlength="256" pattern="[a-zA-Z0-9 ]+"></textarea>
                <br><br>
                <input type="submit" value="Post">
            </form>
        </main>

        <?

        

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //connect to the database
        include("Database/LoginSystem/DB_Connect.php");

        $_author = $_SESSION['login_username'];
        $_ha_title = htmlentities($_POST["articleTitle"]);
        $_ha_importance = htmlentities($_POST["ha_importance"]);
        $_ha_content = htmlentities($_POST["articleText"]);


        $sql = "INSERT INTO healthnews (title, content, importance, username) VALUES ('" . $_ha_title . "', '" . $_ha_content . "', '" . $_ha_importance . "', '" . $_author . "')";

        if (mysqli_query($conn, $sql)) {
            header("location:home.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "post failed, please try again later.";
        }
    }


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to create an article');
}
?>
