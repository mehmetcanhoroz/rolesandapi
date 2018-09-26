<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = "roles";
    protected $fillable = ["name", "slug"];

    public function rolegroups()
    {
        return $this->hasMany(RoleGroup::class)->withPivot("role_id", "role_group_id");
    }

    //sen ekledin
}
