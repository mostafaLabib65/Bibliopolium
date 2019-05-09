<?php

namespace App\Models;

use App\Models\RoleCredential;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name','guard_name','role_credential_id'
    ];

    public function credential(){
        return $this->belongsTo(RoleCredential::class,'role_credential_id');
    }
}
