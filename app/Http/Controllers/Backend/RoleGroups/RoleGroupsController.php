<?php

namespace App\Http\Controllers\Backend\RoleGroups;

use App\Http\Requests\RoleGroupCreateRequest;
use App\Http\Requests\RoleGroupDeleteRequest;
use App\Http\Requests\RoleGroupViewRequest;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderDeleteRequest;
use App\Http\Requests\SliderViewRequest;
use App\Models\Portfolio;
use App\Models\Role;
use App\Models\RoleGroup;
use App\Models\RoleRoleGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RoleGroupsController extends Controller
{
    //
    public function show(RoleGroupViewRequest $request)
    {
        $rolegroups = RoleGroup::all();
        return view("backend.rolegroup.index", compact("rolegroups"));
    }

    public function delete(RoleGroupDeleteRequest $request)
    {
        $rolegroup = RoleGroup::find($request->id);

        if ($rolegroup->delete()) {
            RoleRoleGroup::where("role_group_id", $rolegroup->id)->delete();
            User::where("role_group_id", $request->id)->update([
                "role_group_id" => 0
            ]);
            return ["status" => "success", "title" => "Başarılı!", "message" => "Rol Grubu silindi!"];
        }
        return ["status" => "error", "title" => "Hata Oluştu!", "message" => "Rol Grubu bulunamadı yada silinemez!"];
    }

    public function editShow(RoleGroupCreateRequest $request)
    {
        $roles = Role::all();
        $rolegroup = RoleGroup::where("id", $request->id)->first();
        return view("backend.rolegroup.edit", compact("roles", "rolegroup"));
    }


    public function edit(Request $request)
    {
        $group = RoleGroup::findOrFail($request->id);
        $group->name = $request->name;
        $group->slug = $request->slug;
        $res = $group->save();

        /*foreach ($request->roles as $role) {
            $roleRoleGroup = new RoleRoleGroup();
            $roleRoleGroup->role_id = $role;
            $roleRoleGroup->role_group_id = $group->id;
            $roleRoleGroup->save();
        }*/

        RoleRoleGroup::where("role_group_id", $request->id)->delete();

        $insert = [];

        if ($request->roles) {
            foreach ($request->roles as $role) {
                RoleRoleGroup::insert(["role_id" => $role, "role_group_id" => $group->id]);
            }
        }
        RoleRoleGroup::insert($insert);

        if ($res)
            return ["status" => "success", "title" => "Başarılı!", "message" => "İşlem başarılı!"];
        return ["status" => "error", "title" => "Başarısız!", "message" => "İşlem başarısız!"];
    }


    public function create(Request $request)
    {
        $group = new RoleGroup();
        $group->name = $request->name;
        $group->slug = $request->slug;
        $res = $group->save();

        /*foreach ($request->roles as $role) {
            $roleRoleGroup = new RoleRoleGroup();
            $roleRoleGroup->role_id = $role;
            $roleRoleGroup->role_group_id = $group->id;
            $roleRoleGroup->save();
        }*/


        $insert = [];

        foreach ($request->roles as $role) {
            RoleRoleGroup::insert(["role_id" => $role, "role_group_id" => $group->id]);
        }
        RoleRoleGroup::insert($insert);

        if ($res)
            return ["status" => "success", "title" => "Başarılı!", "message" => "İşlem başarılı!"];
        return ["status" => "error", "title" => "Başarısız!", "message" => "İşlem başarısız!"];
    }

    public function createShow(RoleGroupCreateRequest $request)
    {
        $roles = Role::all();
        return view("backend.rolegroup.create", compact("roles"));
    }


    /*
*/

}
