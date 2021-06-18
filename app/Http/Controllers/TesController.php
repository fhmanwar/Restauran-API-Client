<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TesController extends Controller
{
    public $rootUri = 'http://localhost:8001/api';
    public function tesApi()
    {
        // $client = new Client(); //GuzzleHttp\Client
        // $url = self::$rootUri.'users/kingsconsult/repos'; //with static variable
        $url = $this->rootUri.'/users'; //without static variable

        // $response = $client->request('GET', $url, [
        //     'verify'  => false,
        // ]);
        // $responseBody = json_decode($response->getBody());

        // $response = Http::get($url, [
        //     // 'apiKey' => 'YOUR_API_KEY_HERE',
        //     // 'limit' => 10,
        // ]);
        $response = Http::get($url);
        $responseBody = json_decode($response->body());

        return print_r($response->json());
    }

    // public function apiWithoutKey()
    // {
    //     $client = new Client(); //GuzzleHttp\Client
    //     $url = $this->rootUri.'users/kingsconsult/repos';


    //     $response = $client->request('GET', $url, [
    //         'verify'  => false,
    //     ]);

    //     $responseBody = json_decode($response->getBody());

    //     return view('projects.apiwithoutkey', compact('responseBody'));
    // }

    // public function apiWithKey()
    // {
    //     $client = new Client();
    //     $url = "https://dev.to/api/articles/me/published";

    //     $params = [
    //         //If you have any Params Pass here
    //     ];

    //     $headers = [
    //         'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
    //     ];

    //     $response = $client->request('GET', $url, [
    //         // 'json' => $params,
    //         'headers' => $headers,
    //         'verify'  => false,
    //     ]);

    //     $responseBody = json_decode($response->getBody());

    //     return view('projects.apiwithkey', compact('responseBody'));
    // }
}
