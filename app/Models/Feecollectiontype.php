<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feecollectiontype extends Model
{
    protected $fillable = ['collectionhead', 'collectiondesc', 'br_id'];
    public $table = 'feecollectiontype';
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'br_id');
    }
}
