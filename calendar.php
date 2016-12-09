<?php

showmonth('12','2016');

// ------------------------------------

/* +------------------------------------------+
   |            Show text calendar            |
   +------------------------------------------+ */
function showmonth($month, $year) {

    $first_day = mktime(0,0,0,$month, 1, $year);  // Here we generate the first day of the month
    $title = date('F', $first_day);               // This gets us the month name
    $day_of_week = date('D', $first_day);         // day of week for 1st day of month

    switch($day_of_week) {                        // blank days before months first day
        case "Sun": $blankdays = 0; break;
        case "Mon": $blankdays = 1; break;
        case "Tue": $blankdays = 2; break;
        case "Wed": $blankdays = 3; break;
        case "Thu": $blankdays = 4; break;
        case "Fri": $blankdays = 5; break;
        case "Sat": $blankdays = 6; break;
    }

    $days_in_month = cal_days_in_month(0, $month, $year); // days in the month

    echo "<table border=1 width=294>";
    echo "<tr><th colspan=7> $title $year </th></tr>";

    echo "<tr>                                     <!-- table header row  -->
            <td width=42>S</td>
            <td width=42>M</td>
            <td width=42>T</td>
            <td width=42>W</td>
            <td width=42>T</td>
            <td width=42>F</td>
            <td width=42>S</td>
          </tr>";

    $day_count = 1;

    $blank_cnt =  $blankdays;
    echo "<tr>";

    while ( $blank_cnt > 0 )                     // blank day table cells
    {
        echo "<td></td>";
        $blank_cnt--;
        $day_count++;
    }

    $day_num = 1;                                // day number
    $cnt = $blankdays;                           // skip blank days in first week

    while ( $day_num <= $days_in_month ) {       // count days until done
        if ($cnt==7) {$cnt = 0;};
        while ($cnt < 7) {
            echo " <td>$day_num</td> ";
            $day_num++;
            $day_count++;
            $cnt++;
            if ($day_num > $days_in_month) {break;}
            if ($cnt == 7) { echo "</tr>"; }
        }
    }

    while ( $cnt > 1 && $cnt <=6 ) {            // continue with $cnt for end of month blank days
        echo "<td></td>";
        $cnt++;
    }

    echo "</tr></table>";

} // end of function

?>