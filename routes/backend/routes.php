<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/admin/login", "Auth\LoginController@showLoginForm")->name("backend.login");
Route::post("/admin/login", "Auth\LoginController@login");
Route::get("/admin/logout", "Auth\LoginController@logout")->name("backend.logout");


Route::group(["prefix" => "admin", "as" => "backend", "namespace" => "Backend", "middleware" => "backend.login.check"], function () {

    Route::get("/", function () {
        //dd(can());
        return view("backend.home.index");
    })->name(".index");


    Route::group(["prefix" => "menus", "as" => ".menus", "namespace" => "Menus"], function () {
        Route::get("/", "MenusController@show")->name(".show");
        Route::post("/delete", "MenusController@delete")->name(".delete");
        Route::post("/create", "MenusController@create")->name(".create");
        /*      Route::post("/update", "MenusController@update")->name(".update");*/
    });

    Route::group(["prefix" => "portfolios", "as" => ".portfolios", "namespace" => "Portfolios"], function () {
        Route::get("/", "PortfoliosController@show")->name(".show");
        Route::post("/create", "PortfoliosController@create")->name(".create");
        Route::post("/delete", "PortfoliosController@delete")->name(".delete");
//      Route::post("/delete", "BlogCommentController@delete")->name(".delete");
    });

    Route::group(["prefix" => "roles", "as" => ".roles", "namespace" => "Roles"], function () {
        Route::get("/", "RolesController@show")->name(".show");
        Route::post("/create", "RolesController@create")->name(".create");
        Route::post("/delete", "RolesController@delete")->name(".delete");
        /*
        Route::post("/delete", "PortfoliosController@delete")->name(".delete");*/
//      Route::post("/delete", "BlogCommentController@delete")->name(".delete");
    });

    Route::group(["prefix" => "rolegroups", "as" => ".rolegroups", "namespace" => "RoleGroups"], function () {
        Route::get("/", "RoleGroupsController@show")->name(".show");
        Route::get("/edit/{id}", "RoleGroupsController@editShow")->name(".editShow");
        Route::post("/edit", "RoleGroupsController@edit")->name(".edit");
        Route::post("/create", "RoleGroupsController@create")->name(".create");
        Route::get("/create", "RoleGroupsController@createShow")->name(".createShow");
        Route::post("/delete", "RoleGroupsController@delete")->name(".delete");
        /*Route::post("/create", "PortfoliosController@create")->name(".create");
        Route::post("/delete", "PortfoliosController@delete")->name(".delete");*/
//      Route::post("/delete", "BlogCommentController@delete")->name(".delete");
    });

});


