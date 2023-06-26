<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feecategory extends Model
{
    protected $fillable = ['fee_category', 'br_id'];
     public $table = 'feecategory';
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'br_id');
    }
}
