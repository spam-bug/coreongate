<?php


use App\Mail\ClientMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MembershipController;

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

//ADMIN ROUTES
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/settings', function() {
        return view('admin.settings');
    })->name('settings');
});

Route::middleware(['auth', 'role:Admin'])->prefix('settings')->group(function () {
    Route::get('/plan', [PlanController::class, 'index'])->name('plan.index');
    Route::post('/plan/store', [PlanController::class, 'store'])->name('plan.store');
    Route::get('/plan/edit/{id}', [PlanController::class, 'edit'])->name('plan.edit');
    Route::patch('/plan/update/{id}', [PlanController::class, 'update'])->name('plan.update');
    Route::delete('/plan/delete/{id}', [PlanController::class, 'delete'])->name('plan.delete');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');

    Route::get('/ads', [AdsController::class, 'index'])->name('ads.index');
    Route::post('/ads/store', [AdsController::class, 'store'])->name('ads.store');
    Route::delete('/ads/delete/{id}', [AdsController::class, 'delete'])->name('ads.delete');

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::post('/reports/export', [ReportsController::class, 'export'])->name('reports.export');
    Route::get('/reports/pdf', [ReportsController::class, 'PDF'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportsController::class, 'excel'])->name('reports.excel');
});

//EMPLOYEE ROUTES
Route::group(['middleware' => ['auth', 'role:Admin|Employee']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/top_up', function() {
        return view('employee.topup.index');
    })->name('client.top_up');

    Route::get('/clients', function() {
        return view('employee.clients.index');
    })->name('employee.clients');

    Route::get('/clients/{id}/edit', [EmployeeController::class, 'show_client_edit'])->name('employee.show_client_edit');
    Route::patch('/clients/{id}/update', [EmployeeController::class, 'client_edit_process'])->name('employee.client_edit_process');
});

Route::get('/', function() {
    return redirect('monitoring');
});

Route::get('/monitoring', function() {
    return view('monitoring');
})->name('monitoring');


//CLIENT ROUTES
Route::get('/check_in', [ClientController::class, 'show_check_in_form'])->name('client.show_check_in_form');
Route::post('/check_in', [ClientController::class, 'check_in_process'])->name('client.check_in_process');

Route::get('/check_out', [ClientController::class, 'show_check_out_form'])->name('client.show_check_out_form');
Route::post('/check_out', [ClientController::class, 'check_out_process'])->name('client.check_out_process');

Route::post('/sign_up/store', [ClientController::class, 'sign_up_store'])->name('client.sign_up_store');

Route::get('/forgot_password', [ClientController::class, 'show_send_code_form'])->name('forgot_password.show_send_code_form');
Route::post('/forgot_password', [ClientController::class, 'send_code_process'])->name('forgot_password.send_code_process');
Route::post('/forgot_password/verify_code/{id}', [ClientController::class, 'verify_code_process'])->name('forgot_password.verify_code_process');
Route::get('/forgot_password/reset_password/{id}', [ClientController::class, 'show_reset_password_form'])->name('forgot_password.show_reset_password');
Route::patch('/forgot_password/reset_password/{id}', [ClientController::class, 'reset_password_process'])->name('forgot_password.reset_password_process');


// Route::get('/send-mail', function() {
//     Mail::to('mlimp003@gmail.com')->send(new ForgotPasswordMail);
// });

require __DIR__.'/auth.php';
