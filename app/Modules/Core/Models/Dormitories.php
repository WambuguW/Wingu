<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Dormitories extends Model
{
    protected $table = 'dormitories';
    
    protected $fillable = ['name', 'capacity', 'sex'];
    
    public function students()
    {
        return $this->hasMany('App\Modules\Core\Models\Studentdetails');
    }
}
