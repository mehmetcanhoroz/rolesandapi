<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRoleGroup extends Model
{
    //
    protected $table = "role_role_group";

    protected $fillable = ["role_id", "role_group_id"];
    public $incrementing = false;
    protected $primaryKey = false;
}
