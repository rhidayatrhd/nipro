<?php

use App\Models\DataPC;
use App\Models\Navigation;
use App\Models\Category;
use App\Models\Department;
use App\Models\Section;

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
        return Category::all();
    }
}

if (!function_exists('getDepartments')) {
    function getDepartments()
    {
        return Department::all();
    }
}

if (!function_exists('getSections')) {
    function getSections()
    {
        return Section::all();
    }
}