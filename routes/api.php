<?php

use Illuminate\Support\Facades\Route;
use Modules\Ifillable\Http\Controllers\Api\FieldApiController;
use Modules\Ifillable\Http\Controllers\Api\ModelFillableApiController;
// add-use-controller


Route::prefix('/ifillable/v1')->group(function () {
    Route::apiCrud([
      'module' => 'ifillable',
      'prefix' => 'fields',
      'controller' => FieldApiController::class,
      'permission' => 'ifillable.fields',
      //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
      // 'customRoutes' => [ // Include custom routes if needed
      //  [
      //    'method' => 'post', // get,post,put....
      //    'path' => '/some-path', // Route Path
      //    'uses' => 'ControllerMethodName', //Name of the controller method to use
      //    'middleware' => [] // if not set up middleware, auth:api will be the default
      //  ]
      // ]
    ]);
    Route::apiCrud([
        'module' => 'ifillable',
        'prefix' => 'model-fillables',
        'controller' => ModelFillableApiController::class,
        'permission' => 'ifillable.modelFillables',
        //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
        // 'customRoutes' => [ // Include custom routes if needed
        //  [
        //    'method' => 'post', // get,post,put....
        //    'path' => '/some-path', // Route Path
        //    'uses' => 'ControllerMethodName', //Name of the controller method to use
        //    'middleware' => [] // if not set up middleware, auth:api will be the default
        //  ]
        // ]
    ]);
// append

});
