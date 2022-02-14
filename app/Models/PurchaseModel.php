<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PurchaseModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'total_spent','total_saving'
    ];


    static function check($id){
        return DB::table('purchase_transaction as pt')
                ->selectRaw('COUNT(pt.customer_id) as transaction_complete')
                ->selectRaw('SUM(pt.total_spent) as total_transaction')
                ->selectRaw("CASE WHEN( COUNT(pt.customer_id) >= 3  AND SUM(pt.total_spent) >= 100)
                                THEN 'Eligible'
                                ELSE 'Not Eligible'
                            END as eligible_status")
                ->whereRaw('pt.customer_id = :id', ['id' => $id])
                ->whereRaw('pt.transaction_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)')
                ->groupBy('pt.customer_id')
                ->get();
    }


}
