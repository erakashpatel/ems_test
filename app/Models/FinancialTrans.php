<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTrans extends Model
{
    use HasFactory;
    protected $table = 'financial_trans';
    protected $primaryKey = 'id';
    public $timestamps = false;
   protected $fillable = ['module_id','tranid','admno','amount','crdr','tranDate','acadYear',
                            'entrymode_id','voucherno','br_id','type_of_concession'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function entryMode()
    {
        return $this->belongsTo(EntryMode::class, 'entrymode_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'br_id');
    }

    public function financialTransDetails()
    {
        return $this->hasMany(FinancialTransDetail::class, 'financialTranId');
    }
}
