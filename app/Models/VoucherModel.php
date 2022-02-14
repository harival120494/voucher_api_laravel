<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VoucherModel extends Model
{
    protected $table = 'vouchers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'status','voucher_code'
    ];

    static function checkVoucherQuota(){
        return DB::table('vouchers')
                ->selectRaw('count(id) as num_quota')
                ->where('status','!=','Claimed')
                ->get();
    }

    static function timeRangeUpload($id){
        return DB::table('vouchers')
                ->select('*')
                ->whereRaw('TIME(created_at) >= NOW() - INTERVAL 10 MINUTE')
                ->whereRaw('customer_id = :id', ['id' => $id])
                ->get();
    }

    static function releaseVoucher($id){
        DB::table('vouchers')->whereRaw('customer_id = :id', ['id' => $id])->delete();
        return true;
    }

}
