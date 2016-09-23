<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Accountdivisions extends Model
{
    //
    protected $table = 'accdivisions';
    
    protected $fillable = ['code', 'name', 'description', 'funds', 'status'];
    
    public function accountfunctions()
    {
        return $this->hasMany('App\Modules\Finance\Models\Accountfunctions');
    }
}
