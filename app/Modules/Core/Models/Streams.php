<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Streams extends Model
{
    protected $table = 'streams';
    
    protected $fillable = ['name'];
}
