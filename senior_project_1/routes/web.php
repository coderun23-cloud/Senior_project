<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeCOntroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MeterReaderController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/',[HomeCOntroller::class,'home']);
Route::get('/index',[HomeCOntroller::class,'index'])->name('index');
Route::get('/tariff',[SuperAdminController::class,'tariff'])->middleware('superadmin');
Route::post('/tariffs/store', [SuperAdminController::class, 'store'])->name('tariffs.store');
Route::get('/history_tariff',[SuperAdminController::class,'history_tariff'])->middleware('superadmin');
Route::get('/add_user',[SuperAdminController::class,'add_user'])->middleware('superadmin');
Route::post('/user_store', [SuperAdminController::class, 'store_user'])->middleware('superadmin');
Route::get('/Notification',[SuperAdminController::class,'Notification'])->middleware('superadmin');
Route::post('/notifications_store',[SuperAdminController::class,'send_mail'])->middleware('superadmin');
Route::get('/Performance_Tracking',[SuperAdminController::class,'Performance_Tracking'])->middleware('superadmin');
Route::delete('/users/{id}', [SuperAdminController::class, 'destroy'])->name('users.destroy')->middleware('superadmin');
Route::put('/{id}', [SuperAdminController::class, 'update_tariff'])->name('tariffs.update');
Route::get('/search', [SuperAdminController::class, 'search'])->name('search')->middleware('superadmin');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Delete a Tariff (DELETE)
Route::delete('/{id}', [SuperAdminController::class, 'destroy_tariff'])->name('tariffs.destroy'); // This line defines tariffs.destroy
Route::get('/view_reports',[SuperAdminController::class,'view_reports']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*

Admin
*/
Route::get('/customer_status',[AdminController::class,'customer_status'])->middleware('admin');
Route::get('/bill',[AdminController::class,'bill'])->middleware('admin');
Route::get('/complaint',[AdminController::class,'complaint'])->middleware('admin');
Route::get('/message',[AdminController::class,'message'])->middleware('admin');
Route::get('/notification',[AdminController::class,'notification'])->middleware('admin');
Route::get('admin/bill/details/{customerId}', [AdminController::class, 'getBillDetails'])->name('admin.bill.details')->middleware('admin');
Route::get('/reports',[AdminController::class,'reports'])->middleware('admin');
Route::post('/send_notification', [AdminController::class, 'sendNotification'])->middleware('admin');
Route::post('/send_complaint',[AdminController::class,'send_complaint'])->middleware('admin');
Route::post('/generate_bill/{id}',[AdminController::class,'generate_bill'])->middleware('admin');
Route::post('/generate-report', [AdminController::class, 'generateReport'])->name('generate.report');
Route::get('/download-report/{id}', [AdminController::class, 'downloadReport'])->name('download.report');

Route::get('/get_all_bills', [AdminController::class, 'getAllBills'])->middleware('admin');

/*

customer
*/
Route::get('/notifications',[CustomerController::class,'notifications']);
Route::get('/complaint_service',[CustomerController::class,'complaint_service']);
Route::post('/complaints', [CustomerController::class, 'store_complaint'])->name('complaints.store');
Route::get('/register_customer',[CustomerController::class,'register_customer']);
Route::post('/register_form',[CustomerController::class,'register_form'])->name('register_form');
Route::get('/profile_show',[CustomerController::class,'profile_show']);
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('/bill_show',[CustomerController::class,'bill']);
/*

meter reader

*/

Route::get('/readings',[MeterReaderController::class,'readings']);
Route::get('/service_cutoff',[MeterReaderController::class,'service_cutoff']);
Route::post('/manual_reading',[MeterReaderController::class,'manual_reading']);
Route::post('/save-bill-reading', [MeterReaderController::class, 'store'])->name('save.bill');
Route::get('/Messages_reader',[MeterReaderController::class,'notification_reader']);
Route::get('/reports_reader',[MeterReaderController::class,'reports_reader']);
Route::put('/update_report/{id}', [MeterReaderController::class, 'updateReport'])->name('update.report');
Route::delete('/delete_report/{id}', [MeterReaderController::class, 'deleteReport'])->name('delete.report');
Route::post('/generate_report', [MeterReaderController::class, 'generateReportReader'])->name('generate.report');
