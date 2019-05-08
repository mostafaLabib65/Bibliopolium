<?php

namespace App\Models;

use App\Models\RoleCredential;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function credential(){
        return $this->belongsTo(RoleCredential::class,'role_credential_id');
    }
}
