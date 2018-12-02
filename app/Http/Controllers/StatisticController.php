<?php

namespace App\Http\Controllers;

use App\Models\DeviceParams;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class StatisticController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statistic', [
            'averageArray' => $this->prepareData(),
            'data' => DeviceParams::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    /**
     * @return array
     */
    public function prepareData()
    {
        $model = new DeviceParams();

        $allData = $model->all();
        $count = $allData->count();
        
        $averageArray = [];

        $averageArray['average_speed'] = (int)($model->sum('speed') / $count);

        $averageArray['average_browser_width'] = (int)($model->sum('browser_width'));
        $averageArray['average_browser_height'] = (int)($model->sum('browser_height'));

        $averageArray['average_screen_width'] = (int)($model->sum('screen_width'));
        $averageArray['average_screen_height'] = (int)($model->sum('screen_height'));

        return $averageArray;
    }
}
