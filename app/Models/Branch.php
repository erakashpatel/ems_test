<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name'];

    public function feecategories()
    {
        return $this->hasMany(Feecategory::class, 'br_id');
    }

    public function feecollectiontypes()
    {
        return $this->hasMany(Feecollectiontype::class, 'br_id');
    }

    public function feetypes()
    {
        return $this->hasMany(Feetypes::class, 'br_id');
    }
}
