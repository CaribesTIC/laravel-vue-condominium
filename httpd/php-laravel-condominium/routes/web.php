<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
  CategoryController,
  DwellingTypeController,
  JournalController,  
  GeneralSettingsController,
  MenuController,
  MyProfileController,
  PostController,
  RoleController,
  TaskController,
  UserController,  
  ZoneController,
  SearchController,
};

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        //'laravelVersion' => Application::VERSION,
        //'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/show', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    
    Route::prefix('journals')->group(function () {
        Route::get('/', [JournalController::class, 'index'])->name('journals.index');
        Route::get('/create', [JournalController::class, 'create'])->name('journals.create');
        Route::post('/', [JournalController::class, 'store'])->name('journals.store');
        Route::get('/{journal}/show', [JournalController::class, 'show'])->name('journals.show');
        Route::get('/{journal}/edit', [JournalController::class, 'edit'])->name('journals.edit');
        Route::put('/{journal}', [JournalController::class, 'update'])->name('journals.update');
        Route::delete('/{journal}', [JournalController::class, 'destroy'])->name('journals.destroy');
    });
     
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus');
        Route::get('/children/{menuId}', [MenuController::class, 'children']);
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');  
        Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/{id}', [MenuController::class,'destroy'])->name('menus.destroy');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}/show', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');  
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');  
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
    });

    Route::prefix('myprofile')->group(function () {
      Route::get('/edit', [MyProfileController::class, 'edit'])->name('myprofile.edit');      
      Route::put('/', [MyProfileController::class, 'update'])->name('myprofile.update');      
      Route::put('/password', [MyProfileController::class, 'updatePassword'])->name('myprofile-password.update');
    });
    
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');        
        Route::post('/', [PostController::class, 'store'])->name('posts.store');        
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{task}/show', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');   
    });
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'edit'])->name('settings.edit');    
        Route::put('/', [GeneralSettingsController::class, 'update'])->name('settings.update');
    });
    
    Route::prefix('users')->middleware(['role:admin'])->group(function () {
    //Route::prefix('users')->middleware(['role:1'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    Route::prefix('zones')->group(function () {
        Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
        Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
        Route::post('/', [ZoneController::class, 'store'])->name('zones.store');
        Route::get('/{zone}/show', [ZoneController::class, 'show'])->name('zones.show');
        Route::get('/{zone}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
        Route::put('/{zone}', [ZoneController::class, 'update'])->name('zones.update');
        Route::delete('/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy');
    });
    
    Route::prefix('dwelling-types')->group(function () {
        Route::get('/', [DwellingTypeController::class, 'index'])->name('dwelling-types.index');
        Route::get('/create', [DwellingTypeController::class, 'create'])->name('dwelling-types.create');
        Route::post('/', [DwellingTypeController::class, 'store'])->name('dwelling-types.store');
        Route::get('/{dwellingType}/show', [DwellingTypeController::class, 'show'])->name('dwelling-types.show');
        Route::get('/{dwellingType}/edit', [DwellingTypeController::class, 'edit'])->name('dwelling-types.edit');
        Route::put('/{dwellingType}', [DwellingTypeController::class, 'update'])->name('dwelling-types.update');
        Route::delete('/{dwellingType}', [DwellingTypeController::class, 'destroy'])->name('dwelling-types.destroy');
    });
    
    /*Route::prefix('dwellings')->group(function () {
        Route::get('/', [DwellingController::class, 'index'])->name('dwellings.index');
        Route::get('/create', [DwellingController::class, 'create'])->name('dwellings.create');
        Route::post('/', [DwellingController::class, 'store'])->name('dwellings.store');
        Route::get('/{dwelling}/show', [DwellingController::class, 'show'])->name('dwellings.show');
        Route::get('/{dwelling}/edit', [DwellingController::class, 'edit'])->name('dwellings.edit');
        Route::put('/{dwelling}', [DwellingController::class, 'update'])->name('dwellings.update');
        Route::delete('/{dwelling}', [DwellingController::class, 'destroy'])->name('dwellings.destroy');
    });*/

    Route::get('search', SearchController::class)->name('search');
    
});
