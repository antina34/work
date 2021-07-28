<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait TimeTrait
{
    /**
     * Get next UTC hour from now
     */
    public function getNextUtcHour()
    {
        return Carbon::now()->addHour()->hour < 10 ? 0 . Carbon::now()->addHour()->hour : Carbon::now()->addHour()->hour;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    private function getScopeLastWeek(Builder $query): Builder
    {
        $currentDate = Carbon::now();
        $agoDateFrom = $currentDate->subWeek()->startOfWeek();
        $agoDateTo = $agoDateFrom->endOfWeek();

        return $query->whereBetween('created_at', [$agoDateFrom, $agoDateTo]);
    }
}
