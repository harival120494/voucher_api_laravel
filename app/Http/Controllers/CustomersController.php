<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CustomersModel;
use Illuminate\Http\Response;

class CustomersController extends Controller
{
    public function index()
    {
        $data = CustomersModel::all();
        return response()->json($data, Response::HTTP_OK);
    }


    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $saved = CustomersModel::create($data);
            return customerCreatedResponse($saved);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getCustomer($id)
    {
        $data = CustomersModel::find($id);
        if($data)
        {
            return response()->json($data, Response::HTTP_OK);
        }
        else{
            $response = array('message' => 'Data with id : '.$id.' Not Found!');
            return response()->json($response, Response::HTTP_OK);
        }
    }
}
