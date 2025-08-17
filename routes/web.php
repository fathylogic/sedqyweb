<?php
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SarfController;
use App\Http\Controllers\OhdaController;
use App\Http\Controllers\MaincenterController;

Auth::routes();

Route::get('send-whatsapp', [WhatsappController::class, 'index']);
Route::post('send-whatsapp', [WhatsappController::class, 'sendWhatsappMessage'])->name('send.whatsapp');


Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/home', [HomeController::class, 'index']);

Route::get('dropzone', [DropzoneController::class, 'index']);
Route::post('dropzone/store', [DropzoneController::class, 'store'])->name('dropzone.store');


Route::get('centers', [CenterController::class, 'index'])->name('centers.index');
Route::post('centers/store', [CenterController::class, 'store'])->name('centers.store');
Route::get('centers/show/{id}', [CenterController::class, 'show'])->name('centers.show');
Route::get('centers/edit/{id}', [CenterController::class, 'edit'])->name('centers.edit');
Route::get('centers/destroy/{id}', [CenterController::class, 'destroy'])->name('centers.destroy');
Route::get('centers/create', [CenterController::class, 'create'])->name('centers.create');
Route::post('centers/update/{id}', [CenterController::class, 'update'])->name('centers.update');

Route::get('maincenters', [MaincenterController::class, 'index'])->name('maincenters.index');
Route::post('maincenters/store', [MaincenterController::class, 'store'])->name('maincenters.store');
Route::get('maincenters/show/{id}', [MaincenterController::class, 'show'])->name('maincenters.show');
Route::get('maincenters/edit/{id}', [MaincenterController::class, 'edit'])->name('maincenters.edit');
Route::get('maincenters/destroy/{id}', [MaincenterController::class, 'destroy'])->name('maincenters.destroy');
Route::get('maincenters/create', [MaincenterController::class, 'create'])->name('maincenters.create');
Route::post('maincenters/update/{id}', [MaincenterController::class, 'update'])->name('maincenters.update');

Route::get('renters', [RenterController::class, 'index'])->name('renters.index');
Route::post('renters/store', [RenterController::class, 'store'])->name('renters.store');
Route::get('renters/show/{id}', [RenterController::class, 'show'])->name('renters.show');
Route::get('renters/edit/{id}', [RenterController::class, 'edit'])->name('renters.edit');
Route::get('renters/destroy/{id}', [RenterController::class, 'destroy'])->name('renters.destroy');
Route::get('renters/create', [RenterController::class, 'create'])->name('renters.create');
Route::post('renters/update/{id}', [RenterController::class, 'update'])->name('renters.update');


Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('employees/store', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/show/{id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::post('employees/show/{id}', [EmployeeController::class, 'show']);
Route::get('employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::get('employees/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');


Route::get('payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
Route::post('payrolls/store', [PayrollController::class, 'store'])->name('payrolls.store');
Route::get('payrolls/show/{id}', [PayrollController::class, 'show'])->name('payrolls.show');
Route::post('payrolls/show/{id}', [PayrollController::class, 'show']);
Route::get('payrolls/edit/{id}', [PayrollController::class, 'edit'])->name('payrolls.edit');
Route::get('payrolls/destroy/{id}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');
Route::get('payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
Route::post('payrolls/update/{id}', [PayrollController::class, 'update'])->name('payrolls.update');



Route::get('recipients', [RecipientController::class, 'index'])->name('recipients.index');
Route::post('recipients/store', [RecipientController::class, 'store'])->name('recipients.store');
Route::get('recipients/show/{id}', [RecipientController::class, 'show'])->name('recipients.show');
Route::get('recipients/edit/{id}', [RecipientController::class, 'edit'])->name('recipients.edit');
Route::get('recipients/destroy/{id}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
Route::get('recipients/create', [RecipientController::class, 'create'])->name('recipients.create');
Route::post('recipients/update/{id}', [RecipientController::class, 'update'])->name('recipients.update');


Route::get('units', [UnitController::class, 'index'])->name('units.index');
Route::post('units/store', [UnitController::class, 'store'])->name('units.store');
Route::get('units/show/{id}', [UnitController::class, 'show'])->name('units.show');
Route::post('units/show/{id}', [UnitController::class, 'show']);
Route::get('units/edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
Route::get('units/destroy/{id}', [UnitController::class, 'destroy'])->name('units.destroy');
Route::get('units/create', [UnitController::class, 'create'])->name('units.create');
Route::post('units/update/{id}', [UnitController::class, 'update'])->name('units.update');

Route::get('notes', [NoteController::class, 'index'])->name('notes.index');
Route::post('notes', [NoteController::class, 'index']);
Route::post('notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::get('notes/show/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('notes/edit/{id}', [NoteController::class, 'edit'])->name('notes.edit');
Route::get('notes/destroy/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::get('notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('notes/update/{id}', [NoteController::class, 'update'])->name('notes.update');

Route::get('/salahyat/{id}', [UserController::class, 'salahyat'])->name('salahyat');

Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('notifications', [NotificationController::class, 'index']);
Route::get('notifications/show/{id}', [NotificationController::class, 'show'])->name('notifications.show');

Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('payments', [PaymentController::class, 'index']);
Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');
Route::get('payments/show/{id}', [PaymentController::class, 'show'])->name('payments.show');
Route::post('payments/show/{id}', [PaymentController::class, 'show']);
Route::get('payments/edit/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
Route::get('payments/destroy/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('payments/update/{id}', [PaymentController::class, 'update'])->name('payments.update');

Route::get('sarfs/get_units/{id}', [SarfController::class, 'get_units'])->name('sarfs.get_units');
Route::get('sarfs', [SarfController::class, 'index'])->name('sarfs.index');
Route::post('sarfs', [SarfController::class, 'index']);
Route::post('sarfs/store', [SarfController::class, 'store'])->name('sarfs.store');
Route::get('sarfs/show/{id}', [SarfController::class, 'show'])->name('sarfs.show');
Route::post('sarfs/show/{id}', [SarfController::class, 'show']);
Route::get('sarfs/edit/{id}', [SarfController::class, 'edit'])->name('sarfs.edit');
Route::get('sarfs/destroy/{id}', [SarfController::class, 'destroy'])->name('sarfs.destroy');
Route::get('sarfs/create', [SarfController::class, 'create'])->name('sarfs.create');
Route::post('sarfs/update/{id}', [SarfController::class, 'update'])->name('sarfs.update');

Route::resource('ohdas', OhdaController::class);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});