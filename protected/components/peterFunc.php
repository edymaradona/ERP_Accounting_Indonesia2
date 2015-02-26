<?php

/*
 *
 * Class : peterFunc
 * Beraneka ragam fungsi yang berhubungan dengan datetime, 
 * memperpendek sintaks dan menyamakan standard date dari Fungsi2 Date di Database, PHP maupun Yii Framework
 *
 * author: Peter J. Kambey
 * 7 November 2012
 * gratis
 *
 * contoh:
 * echo peterFunc::convertTime('2012-01-01 13:50');
 * hasil: 13:50
 * 
 * pertimbangan:
  http://php.net/manual/en/function.strtotime.php
  besluitloos at gmail dot com 05-Oct-2011 01:28
  I just found out PHP thinks slashes in date-formats aren't very european:
  (I guess this is not a bug, just the way it works. But correct me if I'm wrong.)
  $date = "06/10/2011 14:28"; // 6 october 2011 2:28 pm
  $otherDate = "06-10-2011 14:28"; // 6 october 2011 2:28 pm
  echo $stamp = strtotime($date) . "<br/>"; // outputs 1307708880
  echo $otherStamp = strtotime($otherDate) . "<br />"; // outputs 1317904080
  echo date("d-m", $stamp); // outputs 10-06
  echo date("d-m", $otherStamp); // outputs 06-10
 * hasil keluaran dari baseModel (class dasar dari seluruh CActiveRecord) adalah $date = "06-10-2011 14:28"; // 6 october 2011 2:28 pm
 * format standard MySQL dari database adalah $date = "2011-10-06 14:28"; // 6 october 2011 2:28 pm
 * Meskipun tidak begitu bermasalah, HARUS perhatikan pemanggilan parameter $datetime diambil dari BaseModel atau langsung ke Database. 
 * Format Date Time Yii menggunakan Format di link berikut ini:
  http://www.unicode.org/reports/tr35/#Date_Format_Patterns
 * PHP Format
  // Assuming today is March 10th, 2001, 5:16:18 pm, and that we are in the
  // Mountain Standard Time (MST) Time Zone
  $today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
  $today = date("m.d.y");                         // 03.10.01
  $today = date("j, n, Y");                       // 10, 3, 2001
  $today = date("Ymd");                           // 20010310
  $today = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
  $today = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
  $today = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
  $today = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
  $today = date("H:i:s");                         // 17:16:18
  $today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)
 */

Class peterFunc
{

    public static function toTime($datetime)
    {
        if (isset($datetime)) {
            //$_val=Yii::app()->dateFormatter->format("kk:mm",strtotime($datetime));  //Yii Format
            $_val = date("H:i", strtotime($datetime)); //PHP Format
        } else
            $_val = "";
        return $_val;
    }

    public static function issetC($value,$return = null)
    {
        if (isset($value) || $value != null) {
            if ($return == null) {
                $_val = $value;
            } else
                $_val = $return;           
        } else
            $_val = "";

        return $_val;
    }

    public static function nolC($value,$return = null)
    {
        if ($value != 0) {
            if ($return == null) {
                $_val = $value;
            } else
                $_val = $return;
        } else
            $_val = "";
        return $_val;
    }

    public static function isTimeMore($from, $to)
    { //in => actual vs schedule
        //Time1 must be convert to same date with time2
        //$thisdatetime = Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($to)) . " " . Yii::app()->dateFormatter->format("kk:mm", strtotime($from));
        $thisdatetime = date("d-m-Y", strtotime($from)) . " " . date("H:i", strtotime($to)); //PHP Format
        if (isset($to) && strtotime($from) > strtotime($thisdatetime)) {
            $_val = true;
        } else
            $_val = false;
        return $_val;
    }

    public static function isTimeMore2($from, $to, $to2)
    { //out=schedule vs actual
        //Time2 must be convert to same date with time1
        //$thisdatetime = Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($from)) . " " . Yii::app()->dateFormatter->format("kk:mm", strtotime($to));
        $thisdatetime = date("d-m-Y", strtotime($to2)) . " " . date("H:i", strtotime($from)); //PHP Format
        if (isset($from) && strtotime($thisdatetime) > strtotime($to)) {
            $_val = true;
        } else
            $_val = false;
        return $_val;
    }

    public static function countTimeDiff($from, $to)
    {
        if (isset($from) && isset($to)) {
            //Time1 must be convert to same date with time2
            //$thisdatetime = Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($to)) . " " . Yii::app()->dateFormatter->format("kk:mm", strtotime($from));
            $thisdatetime = date("d-m-Y", strtotime($to)) . " " . date("H:i", strtotime($from)); //PHP Format
            $diff = strtotime($thisdatetime) - strtotime($to);
            if ($hours = intval((floor($diff / 3600))))
                $diff = $diff % 3600;
            if ($minutes = intval((floor($diff / 60))))
                $diff = $diff % 60;
            $diff = intval($diff);
            $_val = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT);
        } else
            $_val = "";
        return $_val;
    }

    public static function addTime($timeCurrent, $timeNew)
    {
        $_val = $timeCurrent;
        if (preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $timeCurrent)) {
            $hourCurrent = explode(":", $timeCurrent);
            $hourNew = explode(":", $timeNew);
            $hourAdd = (int)$hourCurrent[0] + (int)$hourNew[0];
            $minuteAdd = (int)($hourCurrent[1]) + (int)$hourNew[1];
            if ($minuteAdd >= 60) {
                $minuteAdd = $minuteAdd - 60;
                $hourAdd = $hourAdd + 1;
            }
            $_val = str_pad($hourAdd, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minuteAdd, 2, "0", STR_PAD_LEFT);
        }
        return $_val;
        //return $hourAdd;
    }

    public static function subTime($timeCurrent, $timeNew)
    {
        $_val = $timeCurrent;
        if (preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $timeCurrent)) {
            $hourCurrent = explode(":", $timeCurrent);
            $hourNew = explode(":", $timeNew);
            $hourAdd = (int)$hourCurrent[0] - (int)$hourNew[0];
            $minuteAdd = (int)($hourCurrent[1]) - (int)$hourNew[1];
            if ($minuteAdd >= 60) {
                $minuteAdd = $minuteAdd + 60;
                $hourAdd = $hourAdd - 1;
            }
            $_val = str_pad($hourAdd, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minuteAdd, 2, "0", STR_PAD_LEFT);
        }
        return $_val;
        //return $hourAdd;
    }

    public static function get_time_difference($start, $end)
    {
        $uts['start'] = strtotime($start);
        $uts['end'] = strtotime($end);
        if ($uts['start'] !== -1 && $uts['end'] !== -1) {
            if ($uts['end'] >= $uts['start']) {
                $diff = $uts['end'] - $uts['start'];
                if ($days = intval((floor($diff / 86400))))
                    $diff = $diff % 86400;
                if ($hours = intval((floor($diff / 3600))))
                    $diff = $diff % 3600;
                if ($minutes = intval((floor($diff / 60))))
                    $diff = $diff % 60;
                $diff = intval($diff);
                //return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
                return $hours . ':' . $minutes . ':00';
            } else {
                //trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
                return '00:00:00';
            }
        } else {
            trigger_error("Invalid date/time data detected", E_USER_WARNING);
        }
        return (false);
    }

    public static function sum_the_time($time1, $time2)
    {
        $times = [$time1, $time2];
        $seconds = 0;
        foreach ($times as $time) {
            list($hour, $minute, $second) = explode(':', $time);
            $seconds += $hour * 3600;
            $seconds += $minute * 60;
            $seconds += $second;
        }
        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;
        // return "{$hours}:{$minutes}:{$seconds}";
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
    }

    //http://stackoverflow.com/questions/12444945/cut-the-content-after-10-words	
    public static function shorten_string($oldstring, $wordsreturned, $after = 0,$trail=true)
    {
        $retval = $string = "";
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $oldstring);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);

        if (count($array) <= $wordsreturned) {
            if ($after < $wordsreturned)  {
                $retval = $string;
            } else 
                $retval = '';
        } else {

            if ($after != 0)  {
                $i = 0;
                do {
                    unset($array[$i]);
                    $i++;
                } while ($i < $after);
            }

            array_splice($array, $wordsreturned);
            $xtrail = ($trail) ? " ..." : "";
            $retval = implode(" ", $array) .$xtrail ;
        }
        return $retval;
    }

    //http://www.lateralcode.com/creating-a-random-string-with-php/
    public static function rand_string($length)
    {
        $str = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    //http://sutisna87.wordpress.com/2011/02/13/membuat-fungsi-tanggal-bahasa-indonesia/	
    public static function hari($date = null)
    {
        if (!isset($date)) {
            $hari = date("w");
        } else
            $hari = date("w", strtotime($date));
        switch ($hari) {
            case 0 :
                $hari = "Minggu";
                return $hari;
                break;
            case 1 :
                $hari = "Senin";
                return $hari;
                break;
            case 2 :
                $hari = "Selasa";
                return $hari;
                break;
            case 3 :
                $hari = "Rabu";
                return $hari;
                break;
            case 4 :
                $hari = "Kamis";
                return $hari;
                break;
            case 5 :
                $hari = "Jum'at";
                return $hari;
                break;
            case 6 :
                $hari = "Sabtu";
                return $hari;
                break;
        }
    }

    public static function bulan($date = null)
    {
        if (!isset($date)) {
            $bulan = date("m");
        } else
            $bulan = date("m", strtotime($date));
        switch ($bulan) {
            case 1 :
                $bulan = " Januari";
                return $bulan;
                break;
            case 2 :
                $bulan = " Februari";
                return $bulan;
                break;
            case 3 :
                $bulan = " Maret";
                return $bulan;
                break;
            case 4 :
                $bulan = " April";
                return $bulan;
                break;
            case 5 :
                $bulan = " Mei";
                return $bulan;
                break;
            case 6 :
                $bulan = " Juni";
                return $bulan;
                break;
            case 7 :
                $bulan = " Juli";
                return $bulan;
                break;
            case 8 :
                $bulan = " Agustus";
                return $bulan;
                break;
            case 9 :
                $bulan = " September";
                return $bulan;
                break;
            case 10 :
                $bulan = " Oktober";
                return $bulan;
                break;
            case 11 :
                $bulan = " November";
                return $bulan;
                break;
            case 12 :
                $bulan = " Desember";
                return $bulan;
                break;
        }
    }

    public static function tanggalpenuh($date)
    {
        if (!isset($date)) {
            $full = date("Y-m-d");
        } else
            $full = $date;
        $val = date("d", strtotime($full)) . " " . peterFunc::bulan($full) . " " . date("Y", strtotime($full));
        return $val;
    }

    public static function bulanromawi($date = null)
    {
        if (!isset($date)) {
            $bulan = date("m");
        } else
            $bulan = date("m", strtotime($date));
        switch ($bulan) {
            case 1 :
                $bulan = "I";
                return $bulan;
                break;
            case 2 :
                $bulan = "II";
                return $bulan;
                break;
            case 3 :
                $bulan = "III";
                return $bulan;
                break;
            case 4 :
                $bulan = "IV";
                return $bulan;
                break;
            case 5 :
                $bulan = "V";
                return $bulan;
                break;
            case 6 :
                $bulan = "VI";
                return $bulan;
                break;
            case 7 :
                $bulan = "VII";
                return $bulan;
                break;
            case 8 :
                $bulan = "VIII";
                return $bulan;
                break;
            case 9 :
                $bulan = "IX";
                return $bulan;
                break;
            case 10 :
                $bulan = "X";
                return $bulan;
                break;
            case 11 :
                $bulan = "XI";
                return $bulan;
                break;
            case 12 :
                $bulan = "XII";
                return $bulan;
                break;
        }
    }

    public static function BulanTahun($val)
    {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);
        if ($_bulan == "01")
            $_bulan = "Januari";
        else if ($_bulan == "02")
            $_bulan = "Februari";
        else if ($_bulan == "03")
            $_bulan = "Maret";
        else if ($_bulan == "04")
            $_bulan = "April";
        else if ($_bulan == "05")
            $_bulan = "Mei";
        else if ($_bulan == "06")
            $_bulan = "Juni";
        else if ($_bulan == "07")
            $_bulan = "Juli";
        else if ($_bulan == "08")
            $_bulan = "Agustus";
        else if ($_bulan == "09")
            $_bulan = "September";
        else if ($_bulan == "10")
            $_bulan = "Oktober";
        else if ($_bulan == "11")
            $_bulan = "November";
        else if ($_bulan == "12")
            $_bulan = "Desember";
        $val = $_bulan . " " . $_tahun;
        return $val;
    }

    public static function cBeginDateBefore($val)
    {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);
        if ($_bulan == "01") {
            $_bulan1 = "12";
            $_tahun = ((int)$_tahun) - 1;
        } else if ($_bulan == "02")
            $_bulan1 = "01";
        else if ($_bulan == "03")
            $_bulan1 = "02";
        else if ($_bulan == "04")
            $_bulan1 = "03";
        else if ($_bulan == "05")
            $_bulan1 = "04";
        else if ($_bulan == "06")
            $_bulan1 = "05";
        else if ($_bulan == "07")
            $_bulan1 = "06";
        else if ($_bulan == "08")
            $_bulan1 = "07";
        else if ($_bulan == "09")
            $_bulan1 = "08";
        else if ($_bulan == "10")
            $_bulan1 = "09";
        else if ($_bulan == "11")
            $_bulan1 = "10";
        else if ($_bulan == "12")
            $_bulan1 = "11";
        $val = $_tahun . $_bulan1;
        return $val;
    }

    public static function cBeginDateAfter($val)
    {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);
        if ($_bulan == "01")
            $_bulan1 = "02";
        else if ($_bulan == "02")
            $_bulan1 = "03";
        else if ($_bulan == "03")
            $_bulan1 = "04";
        else if ($_bulan == "04")
            $_bulan1 = "05";
        else if ($_bulan == "05")
            $_bulan1 = "06";
        else if ($_bulan == "06")
            $_bulan1 = "07";
        else if ($_bulan == "07")
            $_bulan1 = "08";
        else if ($_bulan == "08")
            $_bulan1 = "09";
        else if ($_bulan == "09")
            $_bulan1 = "10";
        else if ($_bulan == "10")
            $_bulan1 = "11";
        else if ($_bulan == "11")
            $_bulan1 = "12";
        else if ($_bulan == "12") {
            $_bulan1 = "01";
            $_tahun = ((int)$_tahun) + 1;
        }
        $val = $_tahun . $_bulan1;
        return $val;
    }

    public static function convertHari($val)
    {
        $_hari = "";

        if ($val == 1) {
            $_hari = "Senin";
        } elseif ($val == 2) {
            $_hari = "Selasa";
        } elseif ($val == 3) {
            $_hari = "Rabu";
        } elseif ($val == 4) {
            $_hari = "Kamis";
        } elseif ($val == 5) {
            $_hari = "Jumat";
        } elseif ($val == 6) {
            $_hari = "Sabtu";
        } elseif ($val == 7) {
            $_hari = "Minggu";
        } elseif ($val == 0) {
            $_hari = "Minggu";
        }
        return $_hari;
    }

    public static function stringSplit($word)
    {
        $variable = preg_replace('/(,+)/', "'$1'", "'$word'");
        return $variable;
    }

    public static function checkDateTime($data)
    {
        if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
            return true;
        } else
            return false;
    }

    public static function checkTime($data)
    {
        if (date('H:i', strtotime($data)) == $data) {
            return true;
        } else
            return false;
    }

    public static function terbilang($n)
    {
        $dasar = [1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $angka = [1000000000, 1000000, 1000, 100, 10, 1];
        $satuan = ['milyar', 'juta', 'ribu', 'ratus', 'puluh', ''];

        $i = 0;
        $str = "";
        while ($n != 0) {
            $count = (int)($n / $angka[$i]);
            if ($count >= 10)
                $str .= peterFunc::terbilang($count) . " " . $satuan[$i] . " ";
            else if ($count > 0 && $count < 10)
                $str .= $dasar[$count] . " " . $satuan[$i] . " ";
            $n -= $angka[$i] * $count;
            $i++;
        }
        $str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
        $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "se\\1", $str);
        return str_replace("  ", " ", $str);
    }

    public static function nicetime($date)
    {
        if (empty($date)) {
            return "No date provided";
        }

        //$periods         = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
        $periods = ["seconds", "minutes", "hours", "days", "weeks", "months", "years", "decades"];
        $lengths = ["60", "60", "24", "7", "4.35", "12", "10"];

        $now = time();
        //$unix_date         = strtotime($date);
        $unix_date = $date;

        // check validity of date
        if (empty($unix_date)) {
            return "Wrong Format";
        }

        // is it future date or past date
        if ($now >= $unix_date) {
            $difference = $now - $unix_date;
            //$tense         = "yang lalu";
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            //$tense         = "dari sekarang";
            $tense = "from now";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "";
        }

        return "$difference $periods[$j] {$tense}";
    }

    public static function indoFormat($value, $decimal = 0)
    {
        if ($value === null)
            return null; // new
        if ($value === '')
            return ''; // new
        return number_format($value, $decimal, ',', '.');
    }

}

