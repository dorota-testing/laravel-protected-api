<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    protected $user;
    protected $weather_api_key;
    protected $weather_api_url;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
        $this->weather_api_key = 'youNeedToRegisterToGetTheKey';
        $this->weather_api_url = 'http://api.weatherapi.com/v1/forecast.json';
    }

    public function weather(Request $request)
    {
        // check if location is valid string
        $validator = Validator::make($request->all(), [
            'location' => 'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }

        $arrLocation = request()->only(['location']);
        $location = $arrLocation["location"];
        // test call to open api
        if ($location == 'googlebooks') {
            $test = Http::get('https://www.googleapis.com/books/v1/volumes/kLAoswEACAAJ');
            return $test->json(); 
        }

        $weather = Http::get($this->weather_api_url .'?key='. $this->weather_api_key .'&location='. $location); 

        return $weather->json();
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
