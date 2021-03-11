<?php
class Utils
{
    /**
     * 時刻の整形
     *
     * @param   array $hour
     * @param   array $minute
     * @return  string 00:00
     */
    public function formatHourMinute($hour, $minute)
    {
        if (!$hour && !$minute) {
            $format_time = 'null';
        } elseif (!$hour) {
            $format_time = '00:' . $minute;
        } elseif (!$minute) {
            $format_time = $hour . ':00';
        } else {
            $format_time = $hour . ':' . $minute;
        }

        return $format_time;
    }
}
