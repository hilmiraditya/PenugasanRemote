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

    }

    public function ListChecklistTemplates(Request $request)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function GetChecklistTemplates(Request $request, $id)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('GET', $url);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function CreateChecklistTemplate(Request $request)
    {
        /* 
            Nama Parameter untuk di body :
                FORMAT : 
                nama parameter => nama untuk di body 
                
                name => name
                description => description
                due_interval => due_interval
                due_unit => due_unit
                items => items

                untuk yang array[object]
                description => description_items
                urgency => urgency_items
                due_interval => due_interval_items
                due_unit => due_unit_items
        */

        $item = array();
        for($a=0;$a<sizeof($request->description_items);$a++)
        {
            $temp_item = [
                'description' => $request->description_items[$a],
                'urgency' => $request->urgency_items[$a],
                'due_interval' => $request->due_interval_items[$a],
                'due_unit' => $request->due_unit_items[$a],
            ];
            array_push($item, $temp_item);
        }
        $params = [
            'data' => [
                'name' => $request->name,
                'checklist' => [
                    'description' => $request->description,
                    'due_interval' => $request->due_interval,
                    'due_unit' => $request->due_unit
                ],
                'items' => $items,
            ],
        ];

        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('POST', $url, $params);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function AssignBulkChecklistTemplates(Request $request, $id)
    {
        /* 
            Nama Parameter untuk di body :
                FORMAT : 
                nama parameter => nama untuk di body 

                untuk yang array[object]
                object_id => object_id
                object_domain => object_domain
        */

        $item = array();
        for($a=0;$a<sizeof($request->object_id);$a++)
        {
            $temp_item = [
                'attributes' => [
                    'object_id' => $request->object_id[$a],
                    'object_domain' => $request->object_domain[$a],
                ],
            ];
            array_push($item, $temp_item);
        }
        $params = [
            'data' => [
                $temp_item
            ],
        ];

        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates/'.$id.'/assigns';

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);

        $request = $client->createRequest('POST', $url, $params);
        $response = $client->send($request);
        return response()->json($response);
    }

    public function DeleteChecklistsTemplates(Request $request, $id)
    {
        $authorization = $request->header('authorization');
        $url = 'https://kong.command-api.kw.com/checklists/templates/'.$id;

        $client = new Client;
        $client->setDefaultOption('headers/authorization', $authorization);
        
        $request = $client->createRequest('DELETE', $url);
        $response = $client->send($request);
        return response()->json($response);     
    }
}
