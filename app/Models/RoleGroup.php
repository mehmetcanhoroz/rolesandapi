<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model
{
    //
    protected $table = "role_groups";
    protected $fillable = ["name", "slug"];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withPivot("role_id", "role_group_id");
    }
}
