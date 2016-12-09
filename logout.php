<?php
/**
 * Created by PhpStorm.
 * User: 1405466
 * Date: 29/11/2016
 * Time: 14:15
 */
session_start()
;
if
(isset
($_SESSION
    ['login_username']))
{
    unset
    ($_SESSION
        ['login_username'])
        ;
}
header("location:home.php");