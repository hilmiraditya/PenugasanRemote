<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ChecklistsController extends Controller
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

    public function GetChecklist(Request $request, $id)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function GetListChecklist(Request $request)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function CreateChecklist(Request $request)
    {
        $item = array();
        for($a=0;$a<sizeof($request->items);$a++)
        {
            $temp_item = $request->items;
            array_push($item, $temp_item);
        }

        $params = [
            'data' => [
                'attributes' => [
                    'object_domain' => $request->object_domain,
                    'object_id' => $request->object_id,
                    'due' => $request->due,
                    'urgency' => $request->urgency,
                    'description' => $request->description,
                    'items' => $item,
                    'task_id' => $request->task_id
                ],
            ],
        ];

        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('POST', $url, $params);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function DeleteChecklist(Request $request)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('DELETE', $url);
        $response = $client->send($request);
        return response()->json($response);   
    }
} 
