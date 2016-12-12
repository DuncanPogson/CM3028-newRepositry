<?php
//include("header.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if (isset($_SESSION['login_username'])) //Session exists
{
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
include("header.php");

    ?>
    <html>
    <main>
        <form action="events.php" method="post">
            Event Name:<br>
            <input type="text" name="event_name" placeholder="Event Name">
            <br><br>
            Date:<br>
            <input type="date" name="event_date" placeholder="Date">
            <br><br>
            Time:<br>
            <input type="time" name="event_time" placeholder="Time">
            <br><br>
            Event Description:<br>
            <input type="text" name="event_description" placeholder="Description of Event">
            <br><br>
            <p><input type="submit" value="Create Event"></p>
        </form>
    </main>
    </html>
<?

include("footer.php");
include ("calendar.php");

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //connect to the database
    include("Database/LoginSystem/DB_Connect.php");

    $_eventName = $_POST["event_name"];
    $_date = $_POST["event_date"];
    $_time = $_POST["event_time"];
    $_description = $_POST["event_description"];

    $sql = "INSERT INTO event (eventName, date, time, description) VALUES ('" . $_eventName . "', '" . $_date . "', '" . $_time . "', '" .
        $_description . "')";

    while ($row = $result->fetch_array()) {
        $_eventName = $row['event_name'];
        $_date = $row['event_date'];
        $_time = $row['event_time'];
        $_description = $row['event_description'];


        echo "
        <article>
            Event Name: {$_eventName} \n
            Event Date: {$_date} \n
            Event Time: {$_timeeventName} \n
            Event Description: \n
            {$_description}
        </article>";
    }

//$sql_query = "SELECT * FROM event";

//$result = $conn->query($sql_query);

//while($row = $result->fetch_array()) {

   // echo "{{$row['eventName']}
 //<p>{$row['date']} AT {$row['time']}</p>
 //<p>{$row['description']}</p>
//";
//}

    if (mysqli_query($conn, $sql)) {
        header("location:home.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "cannot create club, please try again later.";
    }
}


} else {
    // not admin
    header("location:home.php");
    print('You must be an admin to add a club');
}
?>
