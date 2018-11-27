<?php

namespace App\Http\Controllers;

use App\Models\DeviceParams;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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
        return view('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function params(Request $request)
    {
        $request->validate([
            'device' => 'required|string|min:2',
        ]);

        $device = \json_decode($request->device, true);
        $device['user_id'] = \Auth::user()->id;

        return response()->json([
            'status' => 'success',
            'code' => Response::HTTP_ACCEPTED,
            'data' => $device,
            'message' => ''
        ]);
    }
}
