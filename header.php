<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 22:38
 */
session_start();
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Go Portlethen</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://cm3028groupd3newhost.azurewebsites.net/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="http://cm3028groupd3newhost.azurewebsites.net/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://cm3028groupd3newhost.azurewebsites.net/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="http://cm3028groupd3newhost.azurewebsites.net/css/carousel.css" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<body>
<header>
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Sportlethen</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php if ($first_part=="") {echo "active"; } else  {echo "noactive";}?>"><a href="http://cm3028groupd3newhost.azurewebsites.net/">Home</a></li>
                        <li class="<?php if ($first_part=="clubs") {echo "active"; } else  {echo "noactive";}?>"><a href="http://cm3028groupd3newhost.azurewebsites.net/clubs/clubs.php">Clubs</a></li>
                        <li class="<?php if ($first_part=="health") {echo "active"; } else  {echo "noactive";}?>"><a href="http://cm3028groupd3newhost.azurewebsites.net/health/health_wellbeing.php">Health and wellbeing</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#contact">contact</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#about">about</a></li>


                            </ul>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?
                        if (isset($_SESSION['login_username'])) {
                            echo  "<li><a href='http://cm3028groupd3newhost.azurewebsites.net/logout.php'>Logout</a>
                            </li>";
                        } else {

                            echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal\">Login</a>

                            </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>
<!--MODAL-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Sign In</h4>
            </div>
            <div class="modal-body">

                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {


                    ?>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <!--Setting title of page-->
                        <title>Login Page</title>
                    </head>

                    <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#signUp" data-dismiss="modal" aria-label="Close">
                            Sign Up
                        </button></p>

                    <main>
                        <form action="http://cm3028groupd3newhost.azurewebsites.net/login.php" method="post">
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
                        header("location:index.php");
                    } else {
                        print('incorrect username or password');
                        header("location:#myModal");
                    }
                } else {
                    // nothing works
                    print('all kinds of errors');
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
            </div>
            <div class="modal-body">

                <header>
                    <h1>Create an account to use the site</h1>
                    <p><a href="http://cm3028groupd3newhost.azurewebsites.net/">Home</a></p>
                </header>

                <main>
                    <form action="database/loginsystem/AddNewUser.php" method="post">
                        <input type="text" name="username" placeholder="Username"><br>
                        <br>
                        <input type="text" name="firstName" placeholder="First Name"><br>
                        <br>
                        <input type="text" name="lastName" placeholder="Last Name"><br>
                        <br>
                        <input type="date" name="dateOfBirth" placeholder="00/00/0000"><br>
                        <br>
                        <input type="text" name="address" placeholder="Address"><br>
                        <br>
                        <input type="email" name="Email" placeholder="example@example.com"><br>
                        <br>
                        <input type="password" name="Password" placeholder="password"><br>
                        <br><br>
                        <input type="submit" text="Submit">
                    </form>
                </main>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
            </div>
        </div>
    </div>
            <!-- Modal -->
            <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Contact</h4>
                        </div>
                        <div class="modal-body">
                            <p>Having difficulty using the site? or have some ideas to help us improve?
                                send us an email at support@portlethen.net and we'll get back to you as soon as possible.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">About Us</h4>
                        </div>
                        <div class="modal-body">
                            <p>About Us bla bla bla</p>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

</header>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="http://belekaslol.azurewebsites.net//js/vendor/jquery.min.js"><\/script>')</script>
<script src="http://belekaslol.azurewebsites.net/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="http://belekaslol.azurewebsites.net//js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://belekaslol.azurewebsites.net/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>