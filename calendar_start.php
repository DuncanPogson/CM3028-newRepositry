<?php
//$showmonth = $_POST['showmonth'];
//$showyear = $_POST['showyear'];
$showmonth = preg_replace('#[^0-9]#i', '', $showmonth);
$showyear = preg_replace('#[^0-9]#i', '', $showyear);
//$showmonth = date ('n');
//$showyear = date ('y');

// w = numeric representation of the day of the week
$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0,0,0, $showmonth, 1, $showyear));
$post_days = (6 - (date('w', mktime(0,0,0, $showmonth, $day_count, $showyear))));

echo '<div id="calendar_wrap">';
echo '<div class="title_bar">';
echo '<div class="previous_month"><input name="myBtn" type="submit" value="Previous Month" onclick="javascript:last_month();"></div>';
echo '<div class="show_month">' . $showmonth . '/' . $showyear . '</div>';
echo '<div class="next_month"><input name="myBtn" type="submit" value="Next Month" onclick="javascript:next_month();"></div>';
echo '</div>';
echo '<div class="week_days">';
echo '<div class="days_of_week">Sun</div>';
echo '<div class="days_of_week">Mon</div>';
echo '<div class="days_of_week">Tue</div>';
echo '<div class="days_of_week">Wed</div>';
echo '<div class="days_of_week">Thur</div>';
echo '<div class="days_of_week">Fri</div>';
echo '<div class="days_of_week">Sat</div>';
echo '<div class="clear"</div>';
echo '</div>';

/* previous month filler days  */
if ($pre_days != 0) {
    for($i=1; $i<=$pre_days; $i++){
        echo '<div class="non_cal_day"></div>';
    }
}

/* current month */
for ($i=1; $i<= $day_count; $i++){
    echo '<div class="cal_day">';
    echo '<div class="day_heading">' . $i . '</div>';
    echo '</div>';
}

/* next month filler days */
if ($post_days != 0){
    for($i=1; $i<=$post_days; $i++){
        echo '<div class="non_cal_day"></div>';
    }
}

echo '</div>';
?>