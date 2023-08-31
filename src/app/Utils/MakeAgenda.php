<?php

namespace App\Utils;

class MakeAgenda
{
    public static function createDay(
        $startingTime,
        $finishingTime,
        $appointmentDuration,
        $lunchTime = '12:00',
        $lunchDuration = 120
    ) {
        $startingTime = strtotime($startingTime);
        $finishingTime = strtotime($finishingTime);
        $lunchTime = strtotime($lunchTime);
        $appointmentDuration = $appointmentDuration * 60;
        $lunchDuration = $lunchDuration * 60;

        $appointmentTimes = [];
        for ($i = $startingTime; $i < $finishingTime; $i += $appointmentDuration) {
            array_push($appointmentTimes, date('H:i', $i));
        }

        $timesToBeRemoved = [];
        for ($i = $lunchTime; $i < $lunchTime + $lunchDuration; $i += $appointmentDuration) {
            array_push($timesToBeRemoved, date('H:i', $i));
        }

        $appointmentTimes = array_diff($appointmentTimes, $timesToBeRemoved);

        return $appointmentTimes;
    }
}
