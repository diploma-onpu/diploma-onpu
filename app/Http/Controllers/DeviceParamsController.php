<?php
/**
 * Created by PhpStorm.
 * User: ff
 * Date: 12/1/18
 * Time: 3:12 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DeviceParams;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class DeviceParamsController
 * @package App\Http\Controllers
 */
class DeviceParamsController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function saveParams(Request $request)
    {
        $request->validate([
            'params' => 'required|array',
        ]);

        /** @var array $params */
        $params = $request['params'];

        if (empty($params)) {
            return;
        }

        DB::beginTransaction();

        $devParamsObj = new DeviceParams();

        try {
            $devParamsObj->user_id = Auth::user()->id;
            $devParamsObj->os = key_exists('platform', $params)? $params['platform'] : null;
            $devParamsObj->browser_type = key_exists('browser_name', $params) ? $params['browser_name'] : null;
            $devParamsObj->browser_width = key_exists('browser_size', $params) ? $params['browser_size']['real_width'] : null;
            $devParamsObj->browser_height = $params['browser_size']['real_height'];
            $devParamsObj->screen_width = key_exists('screen', $params) ? $params['screen']['screen_width'] : null;
            $devParamsObj->screen_height = $params['screen']['screen_height'];
            $devParamsObj->speed = key_exists('speed', $params)? $params['speed'] : null;

            $devParamsObj->save();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        DB::commit();

        return response()->json([
            'status' => 'success',
            'code' => Response::HTTP_ACCEPTED,
            'data' => [],
            'message' => ''
        ]);
    }
}
