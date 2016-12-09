<?php
/**
 * Created by Duncan Pogson - 1405466.
 * Date: 14/11/2016
 * Time: 15:07
 * Connect to groupD3 web app and select database
 */
//Storing login info for database as variables
$serverName = "eu-cdbr-azure-north-e.cloudapp.net";
$DB_name = "b4defdb830e2bc";
$DB_password = "44f41f1c";
$DB = "cm3028_groupd3_db";

//attempting to connect to the database
$conn = new mysqli($serverName, $DB_name, $DB_password, $DB);

//Letting the user know if the connection didnt work
if($conn->connect_error){
    die('ConnectFailed['.$conn->connect_error.']');
}else {

}

