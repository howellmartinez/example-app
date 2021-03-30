<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/projects/{id}', function ($id) {
    $project = App\Models\Project::find($id);
    return view('individual_project', [
        'project' => $project
    ]);
});
