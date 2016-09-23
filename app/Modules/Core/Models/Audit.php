<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    
    protected $fillable = ['userid', 'action', 'date'];
}
