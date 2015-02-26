<?php

/**
 * TimeString.php
 *
 * A Yii widget for displaying a human friendly view of two dates.
 *
 * @author CobraF
 * @category Date and Time
 * @version 0.1
 */
class TimeString extends CWidget
{
    public $startDate;
    public $endDate;
    public $duration = false;
    private $_date = [];
    private $_dateString;

    public function init()
    {
        // split the date into separate date/month/year components
        // presumably, it's faster to access an array than to express dates all the time
        // this could be improved however
        $_date['start'] = explode("-", $this->startDate);
        $_date['end'] = explode("-", $this->endDate);
        // perform 'strtotime' once only and use the variable in the conditions below.
        $timeFormatStartDate = strtotime($this->startDate);
        $timeFormatEndDate = strtotime($this->endDate);
        // stringFirst and stringLast are the two components used for preparing the final string.
        // stringLast will be setup by default. stringFirst must be declared as empty in case it's never used.
        $stringFirst = "";
        // Set the last part of the final string.
        // In all conditions, the last part of the final string is always 
        $stringLast = date("Y", $timeFormatEndDate);
        $stringLast = date("M", $timeFormatEndDate) . " " . $stringLast;
        $stringLast = date("d", $timeFormatEndDate) . " " . $stringLast;
        // IF - the year number is different and prepare the first part of the final string.
        // Logic: If year is different, display as "dd mmm yyyy to dd mmm yyyy"
        if ($_date['start'][0] != $_date['end'][0]) {
            $stringFirst = date("Y", $timeFormatStartDate);
            $stringFirst = date("M", $timeFormatStartDate) . " " . $stringFirst;
            $stringFirst = date("d", $timeFormatStartDate) . " " . $stringFirst;
        }
        // ELSE - If the year is the same, check if the month number is different and update the first part of the string.
        // Logic: If year is the same but month is different, display as "dd mmm to dd mmm yyyy"
        elseif ($_date['start'][1] != $_date['end'][1]) {
            $stringFirst = date("M", $timeFormatStartDate) . " " . $stringFirst;
            $stringFirst = date("d", $timeFormatStartDate) . " " . $stringFirst;
        }
        // ELSE - If the year and month are the same, check if the day is different and update the first part of the string.
        // Logic: If year and month are the same, but day is different, display as "dd to dd mmm yyyy"
        elseif ($_date['start'][2] != $_date['end'][2]) {
            $stringFirst = date("d", $timeFormatStartDate) . " " . $stringFirst;
        }
        // If 'duration' is true, include the duration in brackets, otherwise keep as an empty string.
        if ($this->duration) {
            $days = (($timeFormatEndDate - $timeFormatStartDate) / (60 * 60 * 24)) + 1;
            if ($days == 1) {
                $days = " (1 day)";
            } else {
                $days = " (" . $days . " days)";
            }
        } else {
            $days = "";
        }
        // Prepare string
        if ($stringFirst != "") {
            $stringFirst .= " to ";
        }
        $this->_dateString = $stringFirst . $stringLast . $days;
    }

    public function run()
    {
        // render the string in a view file.
        $this->render('renderTimeString', [
            'dateString' => $this->_dateString,
        ]);
    }
}