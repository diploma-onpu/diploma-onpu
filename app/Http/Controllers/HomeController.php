<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setSystemLanguage(Request $request)
    {
        $language = $request['language'];

        if ($language && in_array($language, ['ua', 'en'])) {
            setcookie("systemLanguage", $language, time()+86400);
            Session::put('locale', $language);
        }

        return redirect()->back();
    }
}
