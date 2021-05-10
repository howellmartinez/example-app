<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesOrderController;

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
    return view('welcome');
});

Route::get('/projects', function () {
    $projects = App\Models\Project::all();
    return view('all_projects', [
        'projects' => $projects
    ]);
});


Route::get('/sales-orders', [SalesOrderController::class, 'index']);
Route::get('/sales-orders/create', [SalesOrderController::class, 'create']);
Route::get('/sales-orders/{salesOrder}/edit', [SalesOrderController::class, 'edit']);
Route::get('/sales-orders/{salesOrder}', [SalesOrderController::class, 'show']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/create', [CustomerController::class, 'create']);
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);

Route::get('/projects/create', function () {
    return view('create_project');
});

Route::post('/projects', function () {
    App\Models\Project::create([
        'name' => request()->input('name'),
        'client' => request()->input('client'),
        'description' => request()->input('description'),
    ]);
    redirect('/projects');
});

Route::get('/projects/{id}', function ($id) {
    $project = App\Models\Project::find($id);
    return view('individual_project', [
        'project' => $project
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
