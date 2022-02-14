<?php

use Illuminate\Http\Response;

function customerCreatedResponse($response){
    if($response){
        $data = array (
            'error' => '',
            'message' => 'Data created successfuly',
            'data' => $response
        );
        return response()->json($data)->setStatusCode(Response::HTTP_OK);
    }
    else{
        $data = array (
            'error' => 'Oops, something went wrong!',
            'message' => '',
            'data' => $response
        );
        return response()->json($data)->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}


function purchaseCreatedResponse($response){
    if($response){
        $data = array (
            'error' => '',
            'message' => 'Data purchase created successfuly',
            'data' => $response
        );
        return response()->json($data)->setStatusCode(Response::HTTP_OK);
    }
    else{
        $data = array (
            'error' => 'Oops, something went wrong!',
            'message' => '',
            'data' => $response
        );
        return response()->json($data)->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
