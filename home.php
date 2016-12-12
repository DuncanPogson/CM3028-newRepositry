<?php
/**
 * Created by PhpStorm.
 * User: duncanpogson
 * Date: 28/11/2016
 * Time: 20:44
 */
//include the 'header'
include ("header.php");

if (isset($_SESSION['login_username'])) {
    if (((int)$_SESSION['AccessLevel']) >= 4) {
        echo "<li><a href='setH_Admins.php'>Set New Access Levels</a></li>";
    }
}

//Welcome message to site visitors
echo "
<main>
<p>Welcome to the Portlethen fitness page, please sign in to view more details and events</p>
</main>
";
//include the 'footer'
include ("footer.php");
