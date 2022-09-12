<?php

if (! function_exists('TimeWithTimeZone')) {
    function TimeWithTimeZone($currentTime)
    {
        return date(" H:i", strtotime("$currentTime ". session('currentTimeZoneHour') . ' hour '. session('currentTimeMinutes') . ' minutes'));
    }
}
