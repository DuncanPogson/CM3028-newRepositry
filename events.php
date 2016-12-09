<?php
//include("header.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**

 **/

include("Database/LoginSystem/DB_Connect.php");

$sql_query = "SELECT * FROM event";
    
$result = $conn->query($sql_query);

while($row = $result->fetch_array()) {

    echo "{$row['eventID']} - {$row['eventName']}</h2>
 <p>{$row['date']} AT {$row['time']}</p>
 <p>{$row['description']}</p>
";
}

echo "<a href='events.php'>Create Event</a>";

include("footer.php");

