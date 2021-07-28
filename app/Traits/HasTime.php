<?php

namespace App\Traits;

use App\Models\Invoice;

trait HasTime
{
    /**
     * Formats the time
     * @param $string
     *
     * @return false|string
     */
    public function formatDate($string)
    {
        return date(Invoice::DATE_FORMAT, $string);
    }

    /**
     * Formats the time
     * @param $string
     *
     * @return false|string
     */
    public function formatDateTime($string)
    {
        return date(Invoice::DATE_TIME_FORMAT, $string);
    }

    /**
     * Formats the time
     * @param $string
     *
     * @return false|string
     */
    public function formatTime($string)
    {
        return date(Invoice::TIME_FORMAT, $string);
    }
}
