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
            <input type="text" name="login_username" placeholder="Username" maxlength="30" pattern="[a-zA-Z0-9\s]+">
            <br>
            Password:<br>
            <input type="password" name="login_password" placeholder="Password" maxlength="255" pattern="[a-zA-Z0-9 ]+">
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
    $_username = htmlentities($_POST["login_username"]);
    $_password = htmlentities($_POST["login_password"]);

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

        $sql = "SELECT accessLevel FROM users where username='" . $_username . "'";
        $result = $conn->query($sql);

        while($row = $result->fetch_array()) {

            $_SESSION['AccessLevel'] = $row['accessLevel'];

            $_SESSION['login_username'] = $_username;

            header("location:index.php");
        }
    } else {
        print('incorrect username or password');
        header("");
    }
} else {
    // nothing works
    print('all kinds of errors');
}
?>
