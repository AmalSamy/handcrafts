<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\Common_questionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\AdminsController;

Route::group([
    'middleware'=>['auth', 'verified','web'],
    'as'=>'dashboard.',
    'prefix'=>'dashboard',


],function (){
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class,'index'])->name('dashboard');

    // Route::get('/categories/{category}',[CategoriesController::class,'show'])
    // ->where('category','\d+');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])
    ->name('categories.trash');


    Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore');

    Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
    ->name('categories.force-delete');

    Route::resource('categories',CategoriesController::class);

    Route::get('/products/trash',[ProductsController::class,'trash'])
        ->name('products.trash');

    Route::put('/products/{product}/restore',[ProductsController::class,'restore'])
        ->name('products.restore');

    Route::delete('/products/{product}/force-delete',[ProductsController::class,'forceDelete'])
        ->name('products.force-delete');


    Route::resource('products',ProductsController::class);



    Route::get('/orders/trash',[OrdersController::class,'trash'])
        ->name('orders.trash');

    Route::put('/orders/{order}/restore',[OrdersController::class,'restore'])
        ->name('orders.restore');

    Route::delete('/orders/{order}/force-delete',[OrdersController::class,'forceDelete'])
        ->name('orders.force-delete');

    Route::resource('orders',OrdersController::class);

    Route::get('/settings/trash',[SettingsController::class,'trash'])
        ->name('settings.trash');


    Route::put('/settings/{setting}/restore',[SettingsController::class,'restore'])
        ->name('settings.restore');

    Route::delete('/settings/{setting}/force-delete',[SettingsController::class,'forceDelete'])
        ->name('settings.force-delete');

    Route::resource('settings',SettingsController::class);

    Route::get('/common_questions/trash',[Common_questionsController::class,'trash'])
        ->name('common_questions.trash');


    Route::put('/common_questions/{common_question}/restore',[Common_questionsController::class,'restore'])
        ->name('common_questions.restore');

    Route::delete('/common_questions/{common_question}/force-delete',[Common_questionsController::class,'forceDelete'])
        ->name('common_questions.force-delete');

    Route::resource('common_questions',Common_questionsController::class);

    Route::resource('roles',RolesController::class);
    Route::resource('users',UsersController::class);
    Route::resource('admins',AdminsController::class);



});


// Route::group([
//     'middleware' => ['auth:admin,web'],
//     'as' => 'dashboard.',
//     'prefix' => 'admin/dashboard',
//     //'namespace' => 'App\Http\Controllers\Dashboard',
// ], function () {

//     // Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     // Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

//     Route::get('/', [DashboardController::class, 'index'])
//         ->name('dashboard');



//     // Route::get('/categories/{category}', [CategoriesController::class, 'show'])
//     //     ->name('categories.show')
//     //     ->where('category', '\d+');

//     Route::get('/categories/trash', [CategoriesController::class, 'trash'])
//         ->name('categories.trash');
//     Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
//         ->name('categories.restore');
//     Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
//         ->name('categories.force-delete');

//     //Route::resource('/categories', CategoriesController::class);
//     //Route::resource('/products', ProductsController::class);

//     Route::get('products/import', [ImportProductsController::class, 'create'])
//         ->name('products.import');
//     Route::post('products/import', [ImportProductsController::class, 'store']);

//     Route::resources([
//         'products' => ProductsController::class,
//         'categories' => CategoriesController::class,
//         'roles' => RolesController::class,
//         'users' => UsersController::class,
//         'admins' => AdminsController::class,
//     ]);
// });

// // Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function() {

// // });




