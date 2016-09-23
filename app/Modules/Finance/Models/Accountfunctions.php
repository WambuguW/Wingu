<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Accountfunctions extends Model
{
    //
    protected $table = 'accfunctions';
    
    protected $fillable = ['name', 'code', 'division_id'];
    
    public function acccountdivisions()
    {
        return $this->belongsTo('App\Modules\Finance\Models\Accountdivisions');
    }
    
    public function accounttypes()
    {
        return $this->hasMany('App\Modules\Finance\Models\Accounttypes');
    }
}
