<?php

namespace App\Helpers;

class Helper {

    /**
     * timeToDecimalSeconds
     *
     * @param  mixed $time
     * @return float
     */
    public static function timeToDecimalSeconds($time)
    {
        $time = date('H:i:s', strtotime($time));
        $timeArray = explode(':', $time);

        return ($timeArray[0] * 3600) + ($timeArray[1] * 60) + $timeArray[2];
    }

    /**
     * DecimalSecondsToTime
     *
     * @param  mixed $decimalSeconds
     * @return string
     */
    public static function DecimalSecondsToTime($decimalSeconds)
    {
        //hours
        $toTime = $decimalSeconds / 3600;
        $toTimeArray = explode('.', $toTime);
        $hours = $toTimeArray[0];

        //minutes
        $toTime = $toTime - $toTimeArray[0];
        $toTime = $toTime * 60;
        $toTimeArray = explode('.', $toTime);
        $minutes = $toTimeArray[0];

        //seconds
        $toTime = $toTime - $toTimeArray[0];
        $toTime = $toTime * 60;
        $seconds = round($toTime);


        return [
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds
        ];
    }

    public static function generateCode() {
        return strtoupper(substr(sha1(time()), 0, 6));
    }
}
