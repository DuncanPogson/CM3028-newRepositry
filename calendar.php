<html>
    <head>

    </head>
    <body>
        <?php
            $day = date("j");
            $month = date("n");
            $year = date ("Y");

//calendar variable
        $currentTimeStamp = strtotime("$year -  $month - $day");
        $monthName = date("F", $currentTimeStamp);
        $numDays = date("t", $currentTimeStamp);
        $counter = 0;
        echo $day."/".$month."/".$year;
        ?>
        <table border ='1'>
                <tr>
                    <td></td>
                    <td colsplan ='5'><?php echo $monthName. ", " .$year; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td width = '50px'>Sub</td>
                    <td width = '50px'>Mon</td>
                    <td width = '50px'>Tue</td>
                    <td width = '50px'>Wed</td>
                    <td width = '50px'>Thur</td>
                    <td width = '50px'>Fri</td>
                    <td width = '50px'>Sat</td>
                </tr>
            <?php
                echo "<tr>";
                    for ($i = 1; $i < $numDays+1; $i++, $counter++){
                        $timeStamp = strtotime("$year-$month-$i");
                        if($i == 1){
                            $firstDay = date("w", $timeStamp);
                            for ($j == 0; $j < $firstDay; j++, $counter++){
                                echo "<td>&nonbreakingspace;</td>";
                            }
                        }
                        if ($counter % 7 == 0){
                            echo"<tr></tr>";
                        }
                        echo "<td align='center'>".$i."</td>";
                    }
                echo "</tr>";
            ?>
        </table>

    </body>
</html>