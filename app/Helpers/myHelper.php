<?php

use App\Models\DataPC;
use App\Models\Navigation;
use App\Models\ProductCategory;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->whereNull('main_menu')->get();
    }
} 

if (!function_exists('getHosts')) {
    function getHosts() 
    {
        return DataPC::where('pchost', gethostname())->get();
    }
}

if (!function_exists('getProducts')) {
    function getProducts()
    {
        return ProductCategory::all();
    }
}