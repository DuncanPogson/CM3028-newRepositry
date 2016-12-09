<?php
/**
 * Created by PhpStorm.
 * User: 1405466
 * Date: 29/11/2016
 * Time: 14:04
 */

include("../../header.php");
//html code to collect user information from a form and a submit button to run the 'addNewUser' php script
?>
    
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
<header>
    <h1>Create an account to use the site</h1>
</header>

<main>
    <form action="AddNewUser.php" method="post">
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

</body>
</html>
    
<?

include("../../footer.php");
    
?>