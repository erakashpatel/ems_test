<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransDetail extends Model
{
    use HasFactory;
     protected $table = 'financial_trans_details';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['financial_tran_id','module_id','amount','head_id','crdr','br_id','head_name'];
    public function financialTrans()
    {
        return $this->belongsTo(FinancialTrans::class, 'financialTranId');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }



    public function branch()
    {
        return $this->belongsTo(Branch::class, 'br_id');
    }
}
