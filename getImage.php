<!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Display Pictures</title>
    </head>

<body>



<?php
/**
 * Created by PhpStorm....

 */
include("header.php");
include("Database/LoginSystem/DB_Connect.php");

$sql_query = "SELECT * FROM photo";
$result = $conn->query($sql_query);
echo "<table>";
while($row = $result->fetch_array()) {

    echo "<tr>";
    echo "<td>";?> <img src="<?php echo $row["url"]; ?>" <height="100" width="100"> <?php echo "</td>";
    echo "<td>"; echo $row["caption"]; echo "</td>";



    echo "</tr>";





}
echo "</table>";




include("footer.php")
?>

</body>
</html>
