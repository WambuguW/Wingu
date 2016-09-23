<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Examtypes extends Model
{
    protected $table = 'examtypes';
    
    protected $fillable = ['name', 'outof'];
}
