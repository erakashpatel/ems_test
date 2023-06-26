<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Feecategory;
use App\Models\Feecollectiontype;

class Feetypes extends Model
{
    protected $fillable = ['fee_category', 'f_name', 'Collection_id', 'br_id', 'Seq_id', 'Fee_type_ledger', 'Fee_headtype'];
     public $table = 'feetypes';
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'br_id');
    }
    public function feecollectiontype()
    {
        return $this->belongsTo(Feecollectiontype::class, 'Collection_id');
    }
    public function feecategory()
    {
        return $this->belongsTo(Feecategory::class, 'fee_category');
    }
}
