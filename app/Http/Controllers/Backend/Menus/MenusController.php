<?php

namespace App\Http\Controllers\Backend\Menus;

use App\Http\Requests\MenuCreateRequest;
use App\Http\Requests\MenuDeleteRequest;
use App\Http\Requests\MenuViewRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    //

    public function show(MenuViewRequest $request)
    {
        $menus = Menu::all()->sortBy("created_at");
        return view("backend.home.menus", compact("menus"));
    }


    public function delete(MenuDeleteRequest $request)
    {
        $setting = Menu::find($request->id)->delete();

        if ($setting) {
            return ["status" => "success", "title" => "Başarılı!", "message" => "Menü silindi!"];
        }
        return ["status" => "error", "title" => "Hata Oluştu!", "message" => "Menü bulunamadı yada silinemez!"];
    }

    public function create(MenuCreateRequest $request)
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->link = str_slug($request->link);

        if ($menu->save()) {
            return ["status" => "success", "title" => "Başarılı!", "message" => "Yeni ayar kaydedildi!"];
        }
        return ["status" => "error", "title" => "Hata Oluştu!", "message" => "Ayar kaydedilemedi, aynısı olabilir!"];
    }
}
