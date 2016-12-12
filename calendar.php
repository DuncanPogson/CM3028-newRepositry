<?php
//include ("Database/LoginSystem/DB_Connect.php");
$servername = "eu-cdbr-azure-north-e.cloudapp.net";
$username = "b4defdb830e2bc";
$password = "44f41f1c";
$dbname = "cm3028_groupd3_db";

?>

<html>
<head>
    <script>
        function goLastMonth(month, year){
            if (month == 1) {
                --year;
                month = 13;
            }
            --month;
            var monthstring = ""+month+"";
            var monthlength = monthstring.length;
            if(monthlength <=1){
                monthstring  = "0"+monthstring;
            }
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
        }

        function goNextMonth(month, year){
            if (month == 12) {
                ++year;
                month = 0;
            }
            ++month;
            var monthstring = ""+month+"";
            var monthlength = monthstring.length;
            if(monthlength <=1){
                monthstring  = "0"+monthstring;
            }
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
        }



    </script>




</head>

<body>

<?php
    if (isset($_GET['add'])){
        $title = htmlentities($_POST['txttitle']);
        $detail = htmlentities($_POST['txtdetail']);

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
<table border='1'>
    <tr>
        <td><input style='width:50px;' type='button' value='<' name='previousbutton' onclick="goLastMonth(<?php echo $month.",".$year?>)"></td>
        <td colspan='5' align='center'> <?php echo $monthName.", ".$year; ?></td>
        <td><input style='width:50px;' type='button' value='>' name='nextbutton' onclick="goNextMonth(<?php echo $month.",".$year?>)"></td>
        <td></td>
    </tr>
    <tr>
        <td width='50px' align='center'>Sun</td>
        <td width='50px' align='center'>Mon</td>
        <td width='50px' align='center'>Tue</td>
        <td width='50px' align='center'>Wed</td>
        <td width='50px' align='center'>Thur</td>
        <td width='50px' align='center'>Fri</td>
        <td width='50px' align='center'>Sat</td>
    </tr>
    <?php
    echo "<tr>";
    for($i = 1; $i < $numDays+1; $i++, $counter++) {
        $timeStamp = strtotime("$year-$month-$i");
        if ($i == 1) {
            $firstDay = date("w", $timeStamp);
            for ($j = 0; $j < $firstDay; $j++, $counter++) {
                // blank space //
                echo "<td>&nbsp;</td>";
            }
        }
        if ($counter % 7 == 0){
            echo "</tr><tr>";
        }
        $monthstring = $month;
        $monthlength = strlen($monthstring);
        $daystring = $i;
        $daylength = strlen($daystring);
        if ($monthlength <= 1){
            $monthstring = "0".$monthstring;
        }
        if ($daylength <= 1){
            $daystring = "0".$daystring;
        }
        echo "<td align='center'><a href='".$_SERVER['PHP_SELF']."?month=".$monthstring."&day=".$daystring."&year=".$year."&v=true'>".$i."</a></td>";
    }
    echo "</tr>";
    ?>

</table>
<?php
    if (isset($_GET['v'])){
        echo "<a href='".$_SERVER['PHP_SELF']."?month=".$month."&day=".$day."&year=".$year."&v=true&f=true'> Add Event </a>";
        if (isset($_GET['f'])){
            include ("events.php");
        }
    }
?>

</body>

</html>﻿