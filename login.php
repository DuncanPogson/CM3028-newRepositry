<?php
/**
 * Created by PhpStorm.
 * User: 1405466
 * Date: 29/11/2016
 * Time: 14:04
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include("header.php");
    //html code to collect information from a form
    ?>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--Setting title of page-->
        <title>Login Page</title>
    </head>

    <h1><a href="Database/LoginSystem/Sign_Up.php">Sign Up</a></h1>

    <main>
        <form action="login.php" method="post">
            Name:<br>
            <input type="text" name="login_username" placeholder="Username">
            <br>
            Password:<br>
            <input type="password" name="login_password" placeholder="Password">
            <br><br>
            <p><input type="submit" value="Login"></p>
        </form>
    </main>
    </html>
    <?
    //
    include("footer.php");


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //connect to the database
    include("Database/LoginSystem/DB_Connect.php");
    //saving user input as variables
    $_username = $_POST["login_username"];
    $_password = $_POST["login_password"];

    function check_login($_username, $_password, $conn)
    {
        //sql query to test the username and password against ones already in the database
        $sql = "SELECT * FROM users WHERE username='" . $_username . "' AND password='" . $_password . "'";

        //run the sql script
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {
            return true;
        }
        return false;
    }
    if (check_login($_username, $_password, $conn)) {
        session_start();
        $_SESSION['login_username'] = $_username;

        //sql query to test the username and password against ones already in the database
        //$sql_UserID = "SELECT CAST(accessLevel AS INT) FROM users WHERE username='" . $_username . "'";

        //run the sql script
        //$_username_AC = $conn->query($sql_UserID);

        $_SESSION['username_AccessLvl'] = $row['userID'];

        $_SESSION['admin_AccessLvl'] = 2;

        header("location:home.php");
    } else {
        print('incorrect username or password');
        header("");
    }
} else {
    // nothing works
    print('all kinds of errors');
}
?>