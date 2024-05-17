<?php

use App\Http\Controllers\AssignRolePermissionController;
use App\Http\Controllers\AssignUserRoleController;
use App\Models\Role;
use App\Models\DataPC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DataPCController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportPCController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ComputerInfoController;
use App\Http\Controllers\NavigationMenuController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductItemyController;
use App\Http\Requests\DataPCRequest;
use App\Models\PCSpec;

use function PHPUnit\Framework\isEmpty;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
        return view('dashboard', [
            'menu'  => 'Mainmenu',
            'title' => 'Dashboard'
        ]);
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);
Route::get('/productcategories/{$category:slug}', [PostController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/configurations/role', RoleController::class);
    Route::resource('/configurations/permission', PermissionController::class);
    Route::resource('/exportimport/datapc', DataPCController::class);
    Route::resource('/configurations/navigationmenu', NavigationMenuController::class);
    
    Route::resource('/exportimport/datapc-action', ImportPCController::class);
    Route::post('/import/importpc', [ImportPCController::class, 'import_pc'])->name('import_pc');
    Route::resource('/exportimport/importpc', ImportPCController::class)->except('import_pc');

    Route::resource('/informations/computer', ComputerInfoController::class);

    Route::resource('/accessmanagements/assignuserrole', AssignUserRoleController::class);
    Route::resource('/accessmanagements/assignrolepermission', AssignRolePermissionController::class);
    Route::get('get-submenus', [AssignRolePermissionController::class, 'getSubmenus'])->name('getSubmenus');

    // Route::resource('/usermenus/productcategory', AssignRolePermissionController::class);
    Route::resource('/products/productcategories', ProductCategoryController::class);
    Route::get('/products/productcategories/checkSlug',[ProductCategoryController::class, 'checkSlug'])->name('products.productcategory.checkSlug');
    Route::resource('/products/productitems', ProductItemyController::class);

});

require __DIR__ . '/auth.php';
