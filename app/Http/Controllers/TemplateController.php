<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class TemplateController extends Controller
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

    public function ListChecklistTemplates(Request $request)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return json($response);
    }

    public function GetChecklistTemplates(Request $request, $id)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return json($response);
    }

    public function CreateChecklistTemplate(Request $request)
    {
        $url = 'https://kong.command-api.kw.com/checklists/templates';
        $client = new Client;
        $request = $client->createRequest('POST', $url);
        $request->addHeader('Content-Type', 'application/json');
        $request->addHeader('authorization', '{$$.env.authorization}');
        $response = $client->send($request);
        return json($response);
    }
}
