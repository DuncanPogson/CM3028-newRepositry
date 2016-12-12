<?php
//include("header.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**

 **/
?>
<form name='eventform' method="post" action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month;?>&day=<?php echo $day;?>&year=<?php echo $year;?>&v=true&add=true">
    <table width="400px">
        <tr>
            <td width="150px">Title</td>
            <td width="250px"><input type="text" name="txttitle"></td>
        </tr>
        <tr>
            <td width="150px">Detail</td>
            <td width="250px"><textarea name="txtdetail"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="btnadd" value="Add Event"></td>
        </tr>
    </table>
</form>
<?php

include("Database/LoginSystem/DB_Connect.php");
include ("calendar.php");

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

