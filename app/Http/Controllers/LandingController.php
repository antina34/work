<?php

namespace App\Http\Controllers;

use App\Traits\StatsTrait;
use Illuminate\Contracts\Support\Renderable;

class LandingController extends Controller
{
    use StatsTrait;

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $this->populatePredictionHistory(
            $activeProducts,
            $name,
            $recordsToShow,
            $actualData,
            $historicalData
        );

        return view('landing', compact(
            'activeProducts',
            'historicalData',
            'actualData',
            'recordsToShow',
            'name'
        ));
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function privacyPolicy(): Renderable
    {
        return view('landing.privacy-policy');
    }
}
