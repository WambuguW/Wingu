<?php

namespace App\Modules\Core\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';
    
    protected $fillable = ['name', 'display_name', 'description'];
}
