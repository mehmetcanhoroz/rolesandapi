<?php

namespace App\Http\Controllers\Backend\Roles;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleDeleteRequest;
use App\Http\Requests\RoleViewRequest;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderDeleteRequest;
use App\Http\Requests\SliderViewRequest;
use App\Models\Portfolio;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RolesController extends Controller
{
    //
    public function show(RoleViewRequest $request)
    {
        $roles = Role::all();
        return view("backend.role.index", compact("roles"));
    }

    public function create(RoleCreateRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;


        $role->save();
        return redirect()->back();
    }


    public function delete(RoleDeleteRequest $request)
    {
        $role = Role::find($request->id);

        if ($role->delete()) {
            return ["status" => "success", "title" => "Başarılı!", "message" => "Rol silindi!"];
        }
        return ["status" => "error", "title" => "Hata Oluştu!", "message" => "Rol bulunamadı yada silinemez!"];
    }
    /*

*/

}
