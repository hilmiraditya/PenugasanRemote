<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/ListChecklist', 'TemplateController@ListChecklistTemplates');
$router->get('/GetChecklist/{id}', 'TemplateController@GetChecklistTemplates');
$router->post('/CreateChecklistTemplate', 'TemplateController@CreateChecklistTemplate');
$router->post('/AssignBulkChecklist/{id}', 'TemplateController@AssignBulkChecklistTemplates');
$router->get('/DeleteChecklist/{id}', 'TemplateController@DeleteChecklistsTemplates');

$router->get('/GetHistory', 'HistoryController@GetListHistory');
$router->get('/GetHistory/{id}', 'HistoryController@GetHistoryById');

$router->get('/GetChecklist/{id}', 'ChecklistsController@GetChecklist');
$router->get('/GetListChecklist', 'ChecklistsController@GetListChecklist');
$router->post('/CreateChecklist', 'ChecklistsController@CreateChecklistTemplate');
$router->get('/DeleteChecklist/{id}', 'ChecklistsController@DeleteChecklist');


