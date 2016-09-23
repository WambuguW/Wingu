<?php

namespace App\Modules\Core\Models;

//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';
    
    protected $fillable = ['name', 'display_name', 'description'];
}
