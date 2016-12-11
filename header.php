<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 22:38
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Go Portlethen</title>
    <link rel="stylesheet" href="calendarCss.css" type="text/css" media="all"/>
    <script language="JavaScript" type="text/javascript">
        function initialCalendar() {
            var hr = new XMLHttpRequest();
            var url = "calendar_start.php";
            var currentTime = new Date();
            var month = currentTime.getMonth() + 1;
            var year = currentTime.getFullYear();
            showmonth = month;
            showyear = year;
            var vars = "$showmonth=" + showmonth + "$showyear=" + showyear;
            hr.open("POST", url, true);
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if(hr.readyState == 4 && hr.status == 200){
                    var return_data = hr.responseText;
                    document.getElementById("showCalendar").innerHTML = return_data;
                }
            };
            hr.send(vars);
            document.getElementById("showCalendar").innerHTML = "processing...";
        }
    </script>
    <script language="JavaScript" type="text/javascript">
        function next_month() {
            var next_month = showmonth + 1;
            if(next_month > 12) {
                next_month = 1;
                showyear =  showyear + 1;
            }
            showmonth = next_month;
            var hr = new XMLHttpRequest();
            var url = "calendar_start.php";
            var vars = "showmonth=" + showmonth + "$showyear=" + showyear;
            hr.open("POST", url, true);
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            hr.onreadystatechange = function(){
                if(hr.readyState == 4 && hr.status == 200){
                    var return_data = hr.responseText;
                    document.getElementById("showCalendar").innerHTML = return_data;
                }
            };
            hr.send(vars);
            document.getElementById("showCalendar").innerHTML = "processing...";

        }
    </script>
    <script language="JavaScript" type="text/javascript">
        function last_month() {
            var last_month = showmonth - 1;
            if(last_month < 1){
                last_month = 12;
                showyear = showyear - 1;
            }
            showmonth = last_month;

            var hr = new XMLHttpRequest();
            var url = "calendar_start.php";
            var vars = "showmonth=" + showmonth + "$showyear=" + showyear;
            hr.open("POST", url, true);
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if(hr.readyState == 4 && hr.status == 200){
                    var return_data = hr.responseText;
                    document.getElementById("showCalendar").innerHTML = return_data;
                }
            };
            hr.send(vars);
            document.getElementById("showCalendar").innerHTML = "processing...";
        }
    </script>

</head>
<!--<body onLoad="initialCalendar();">
<div id="showCalendar"></div>
</body>
-->
<header>
    <h1>Go Portlethen</h1>
    <nav>
        <ul>
            <li><a href="/home.php">Home</a></li>
            <li><a href="/sportlethen.php">Sportlethen</a></li>
            <li><a href="/health_wellbeing.php">Health and Well-being</a></li>
            <li><a href="/about.php">About</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <?
            if (isset($_SESSION['login_username'])) {
                echo "<li><a href='logout.php'>Logout</a></li>";
            } else {
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </nav>
</header>