<?php
/**
 * Created by PhpStorm.
 * User: mehmetcanhoroz
 * Date: 25.09.2018
 * Time: 22:06
 */

if (!function_exists("can")) {
    function can($slug)
    {

        $user = auth()->user();
        $role = $user->roleGroup->roles->where("slug", $slug)->first();

        if ($role) {
            return true;
        }
        return false;
    }
}