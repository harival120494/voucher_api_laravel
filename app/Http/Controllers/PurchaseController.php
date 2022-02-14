<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PurchaseModel;
use Illuminate\Http\Response;
use App\Models\VoucherModel;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $saved = PurchaseModel::create($data);
            return purchaseCreatedResponse($saved);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function check($id){
        $data = PurchaseModel::check($id);
        foreach ($data as $key => $value) {
            if($value->eligible_status == 'Eligible'){
                //check if quota has been exceeded
                $quota = VoucherModel::checkVoucherQuota();
                if($quota[0]->num_quota < 1000){
                    // Check if the user is claimed voucher
                    $check = VoucherModel::where('customer_id', $id)->count();
                    if($check== 0){
                        $voucher = new VoucherModel();
                        $voucher->customer_id   = $id;
                        $voucher->status        = 'Booked';
                        $voucher->voucher_code  = Str::random(10);
                        if($voucher->save()){
                            return response()->json(array("message" => "You get one voucher, Please upload your selfie photo within 10 minutes."))->setStatusCode(Response::HTTP_OK);
                        }
                    }
                    else{
                        return response()->json(array("message" => "you have one voucher booked."))->setStatusCode(Response::HTTP_OK);
                    }
                }
                else{
                    return response()->json(array("message" => "Oops.. The quota is full"))->setStatusCode(Response::HTTP_OK);
                }
            }
            else{
                return response()->json(array("message" => "Your transaction not eligible."))->setStatusCode(Response::HTTP_OK);
            }
        }
    }


    public function upload_photo($id){
        // Check if upload photo selfie in range time
        $check = VoucherModel::timeRangeUpload($id);
        if($check->count() == 0){
            $release = VoucherModel::releaseVoucher($id);
            return response()->json(array("message"=>"you have passed the time limit"))->setStatusCode(Response::HTTP_OK);
        }
        else{
            $voucher = VoucherModel::where('customer_id', $id)->update(['status'=>'Claimed']);
            $voucher_code = VoucherModel::where('customer_id', $id)->get();
            if($voucher > 0){
                $data = array(
                    'message' => 'Your voucher is claimed successfully',
                    'Voucher Code' => $voucher_code[0]->voucher_code
                );
                return response()->json($data)->setStatusCode(Response::HTTP_OK);
            }
        }

    }

}
