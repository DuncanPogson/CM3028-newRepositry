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
if (isset($_GET['add'])){
    $title = $_POST['txttitle'];
    $detail = $_POST['txtdetail'];

    $eventdate = $day."/".$month."/".$year;

    $sqlinsert =  "insert into eventcalendar (Title, Detail, eventDate, dateAdded) values ('".$title."','".$detail."','".$eventdate."', now())";

    $resultinsert = mysql_query($sqlinsert);
    if ($resultinsert){
        echo "Event was succsessfully added";
    }else{
        echo "Event failed to be added";
    }
}
?>