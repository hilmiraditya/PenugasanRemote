<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function GetListHistory(Request $request)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/histories';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }
    
    public function GetHistoryById(Request $request, $id)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/histories/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }
}
