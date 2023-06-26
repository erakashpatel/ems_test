<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['module', 'ModuleID'];
    public $table = 'modules';
    // public function financialTrans()
    // {
    //     return $this->hasMany(FinancialTrans::class, 'module_id');
    // }
}
