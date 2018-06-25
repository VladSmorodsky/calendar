<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.06.18
 * Time: 16:11
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Calendar
{
    private $year;
    private $month;
    private $days_of_week;
    private $num_days;
    private $date_info;
    private $day_of_week;

    public function __construct($year, $month, $days_of_week = array('ПН','ВТ','СР','ЧТ', 'ПТ', 'СБ', 'ВС')){

        $this->month = $month;
        $this->year = $year;
        $this->days_of_week = $days_of_week;
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(strtotime('first day of', mktime(0,0,0,$this->month, 1, $this->year)));
        $this->day_of_week = $this->date_info['wday']-1;
    }

    public function show() {

        //Month and year caption
        $output = '<div class="calendar"><table class="calendar">';
        $output .= '<h3 class="month_name">'  .   $this->date_info['month']   .   ' ' . $this->year   .   '</h3>';
        $output .= '<tr>';


        //Days of the week header
        foreach ($this->days_of_week as $day) {
            $output .= '<th class="header">'    .   $day    .   '</th>';
        }

        //close the header row and open first row of days
        $output .= '</tr><hr><tr>';

        //If the first day of a month doesn`t fail on a Sunday, then we need to fill beginning space using colspan
        if ($this->day_of_week != 0) {
            if ($this->day_of_week == -1) {
              $this->day_of_week = 6;
              // code...
            }
            $output .= '<td colspan="' .   $this->day_of_week  .   '"></td>';
        }

        //Start num days counter
        $current_day = 1;

        //building days
        while ($current_day <= $this->num_days){
            //Reset "day_of_week" counter and close each row
            if ($this->day_of_week == 7) {
                $this->day_of_week = 0;
                $output .= '</tr><tr>';
            }

            if ($this->day_of_week == 5 || $this->day_of_week == 6){
                $output .= '<td class="day rest_day">'   .   $current_day    .   '</td>';
            }
            else {
                $output .= '<td class="day">'   .   $current_day    .   '</td>';
            }


            $current_day++;
            $this->day_of_week++;
        }

        //Once num_days counter stops, if day_of_week counter is not 7,
        //then we need to fill the remaining space on the row using colspan
        if ($this->day_of_week !=7){
            $remaining_days = 7 - $this->day_of_week;
            $output .= '<td colspan="'  .   $remaining_days .   '"></td>';
        }

        //Close final row and table
        $output .= '</tr>';
        $output .= '</table></div>';

        //Output
        echo $output;
    }
}
?>
