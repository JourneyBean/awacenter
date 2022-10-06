<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\Admin\OAuthManagement\OAuthClientsController;
use App\Http\Controllers\Admin\UserManagement\UsersController;

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

Route::get('/', function() {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'auth.enabled',
])->group(function () {
    Route::get('/dashboard', function (Request $request) {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware([    
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'auth.admin',
    'auth.enabled',
])->group(function() {

    // Render
    Route::get('/dashboard/admin', function (Request $request, Team $team) { // TODO Admin team members
        return Inertia::render('Admin/Overview', [
            'clients' => OAuthClientsController::getClients(), // TODO Pagination 
            'users' => UsersController::getUsers(),
        ]);
    })->name('dashboard_admin');

    Route::get('/dashboard/admin/oauth', function (Request $request) {
        return Inertia::render('Admin/OAuthManagement/Show', [
            'clients' => OAuthClientsController::getClients(),
        ]);
    })->name('dashboard_admin_oauth');

    Route::get('/dashboard/admin/user', function (Request $request) {
        return Inertia::render('Admin/UserManagement/Show', [
            'users' => UsersController::getUsers(),
        ]);
    })->name('dashboard_admin_users');

    // OAuth Clients CRUD
    Route::post('/dashboard/admin/oauth/client/add/common', [OAuthClientsController::class, 'createAuthCodeClient'])
        ->name('dashboard_client_add_common');
    Route::post('/dashboard/admin/oauth/client/add/public', [OAuthClientsController::class, 'createPublicAuthCodeClient'])
        ->name('dashboard_client_add_public');
    Route::post('/dashboard/admin/oauth/client/add/password', [OAuthClientsController::class, 'createPasswordClient'])
        ->name('dashboard_client_add_password');
    Route::post('/dashboard/admin/oauth/client/add/personal', [OAuthClientsController::class, 'createPersonalClient'])
        ->name('dashboard_client_add_personal');
    Route::post('/dashboard/admin/oauth/client/add/clientcredential', [OAuthClientsController::class, 'createClientCredentialsClient'])
        ->name('dashboard_client_add_clientcredential');
    Route::post('/dashboard/admin/oauth/client/delete', [OAuthClientsController::class, 'deleteClient'])
        ->name('dashboard_client_delete');        
    Route::post('/dashboard/admin/oauth/client/revoke', [OAuthClientsController::class, 'toggleRevokeClient'])
        ->name('dashboard_client_revoke');

    // Users CRUD
    Route::post('/dashboard/user/add', [UsersController::class, 'createUser'])
        ->name('dashboard_user_add');
    Route::post('/dashboard/user/update', [UsersController::class, 'updateUser'])
        ->name('dashboard_user_update');
    Route::post('/dashboard/user/delete', [UsersController::class, 'deleteUser'])
        ->name('dashboard_user_delete');
});