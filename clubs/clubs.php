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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

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
<?php
session_start();
include ("../Database/LoginSystem/DB_Connect.php");
include ("../calendar_start.php");
include ("../header.php");

?>


<!-- Carousel
    ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="../images/sportsz.jpg" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1 style="color:cadetblue;">Portlethen's guide to healthy living and keeping active</h1>
                    <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                    <p><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            Sign up today
                        </button></p>
                </div>
            </div>
        </div>
        <!-- boom -->
        <div class="item">
            <img class src="../images/Clubs.jpg" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <p><a class="btn btn-lg btn-primary" href="http://cm3028groupd3newhost.azurewebsites.net/clubs/clubs.php" role="button">Explore clubs</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="../images/zen.jpg" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Health And Wellbeing</h1>
                    <p>Tips for healthy life</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<div class="row">
        <div class="col-md-6">
            <div class="well">
<?
            $sql = "SELECT * FROM club";
            $result = $conn->query($sql);

            while($row = $result->fetch_array()) {
                $clubID = $row['clubID'];
                $clubGenre = $row['genre'];
                $clubName = $row['clubName'];
                $clubEmail = $row['clubEmail'];

                echo "<ul class='a'>
<li><a href='../club_page.php/?ID={$clubID}'>{$clubName}</a> Contact: {$clubEmail}, Genre: {$clubGenre}. </li>
                </ul>";
            }



?>
                </div>
        </div><!--col-->
        <div class="col-md-6">
        </div>
    </div>-->

</div><!--container -->
<!-- /.container -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/jquery.js"><\/script>')</script>
<script src="../js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="../js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>
