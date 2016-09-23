<?php
namespace App\Modules\Core\Helpers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * @author  Wambugu Wilson <wambuguw.wilson@gmail.com>
 */

class UserAccounts
{
    public static function audit_trail()
    {
        $sys_audit = \App\Modules\Core\Models\Audit::all();
        return view('core::audit', ['sys_audit' => $sys_audit]);
    }
    
    /**
     * Record user actions that affect the database
     * 
     * @param type $userid
     * @param type $action
     */
    public static function system_audit($userid, $action)
    {
        $audit = \App\Modules\Core\Models\Audit::create(['userid' => $userid, 'action' => $action, 'date' => date("Y-m-d H:i:s")]);
    }
}

