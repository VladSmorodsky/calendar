<?php
function draw_calendar($month, $year, $action = 'none') {
  $days = array(1 => 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'ВС');
  echo date('l',mktime(0,0,0, $month, 3, $year))."<br>";
  echo cal_days_in_month(CAL_GREGORIAN, $month, $year);
}
 ?>
