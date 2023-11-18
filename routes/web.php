<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParcelController;

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
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group( function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/parcel-history', [ParcelController::class, 'parcelHistory'])->name('parcel.history');

    Route::get('/create-parcel', [ParcelController::class, 'step1'])->name('parcel.step1');
    Route::post('/create-parcel', [ParcelController::class, 'storeStep1'])->name('parcel.storeStep1');
    Route::get('/create-parcel/contact-sender', [ParcelController::class, 'step2'])->name('parcel.step2');
    Route::post('/create-parcel/contact-sender', [ParcelController::class, 'storeStep2'])->name('parcel.storeStep2');
    Route::get('/create-parcel/contact-receiver', [ParcelController::class, 'step3'])->name('parcel.step3');
    Route::post('/create-parcel/contact-receiver', [ParcelController::class, 'storeStep3'])->name('parcel.storeStep3');
    Route::get('/create-parcel/overview', [ParcelController::class, 'step4'])->name('parcel.step4');
    Route::post('/create-parcel/overview', [ParcelController::class, 'storeAllData'])->name('parcel.storeAllData');

    //Stripe routes
    Route::get('/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::post('/session', [StripeController::class, 'session'])->name('stripe.session');
    Route::get('/success', [StripeController::class, 'success'])->name('stripe.success');

});

Route::middleware("admin")->group( function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // User CRUD routes
    Route::get('/admin/users', [AdminController::class, 'viewAllUsers'])->name('admin.users');

    Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUserForm'])->name('admin.editUserForm');
    Route::put('/admin/edit-user/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');

    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])->name('admin.createUserForm');
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');

    // Parcel CRUD routes
    Route::get('/admin/parcels', [AdminController::class, 'viewAllParcels'])->name('admin.parcels');

    Route::get('/admin/edit-parcel/{parcel}', [AdminController::class, 'editParcelForm'])->name('admin.editParcelForm');
    Route::put('/admin/edit-parcel/{parcel}', [AdminController::class, 'editParcel'])->name('admin.editParcel');

    Route::delete('/admin/delete-parcel/{parcel}', [AdminController::class, 'deleteParcel'])->name('admin.deleteParcel');

    Route::get('/admin/create-parcel', [AdminController::class, 'createParcelForm'])->name('admin.createParcelForm');
    Route::post('/admin/create-parcel', [AdminController::class, 'createParcel'])->name('admin.createParcel');

    // Vehicle routes
    Route::get('/admin/vehicles', [AdminController::class, 'viewAllVehicles'])->name('admin.vehicles');

    Route::get('/admin/edit-vehicle/{vehicle}', [AdminController::class, 'editVehicleForm'])->name('admin.editVehicleForm');
    Route::put('/admin/edit-vehicle/{vehicle}', [AdminController::class, 'editVehicle'])->name('admin.editVehicle');

    Route::delete('/admin/delete-vehicle/{vehicle}', [AdminController::class, 'deleteVehicle'])->name('admin.deleteVehicle');

    Route::get('/admin/create-vehicle', [AdminController::class, 'createVehicleForm'])->name('admin.createVehicleForm');
    Route::post('/admin/create-vehicle', [AdminController::class, 'createVehicle'])->name('admin.createVehicle');

    // Tariff routes
    Route::get('/admin/tariffs', [AdminController::class, 'viewAllTariffs'])->name('admin.tariffs');

    Route::get('/admin/edit-tariff/{tariff}', [AdminController::class, 'editTariffForm'])->name('admin.editTariffForm');
    Route::put('/admin/edit-tariff/{tariff}', [AdminController::class, 'editTariff'])->name('admin.editTariff');

    Route::delete('/admin/delete-tariff/{tariff}', [AdminController::class, 'deleteTariff'])->name('admin.deleteTariff');

    Route::get('/admin/create-tariff', [AdminController::class, 'createTariffForm'])->name('admin.createTariffForm');
    Route::post('/admin/create-tariff', [AdminController::class, 'createTariff'])->name('admin.createTariff');

    // Address routes
    Route::get('/admin/addresses', [AdminController::class, 'viewAllAddresses'])->name('admin.addresses');

    Route::get('/admin/edit-address/{address}', [AdminController::class, 'editAddressForm'])->name('admin.editAddressForm');
    Route::put('/admin/edit-address/{address}', [AdminController::class, 'editAddress'])->name('admin.editAddress');

    Route::delete('/admin/delete-address/{address}', [AdminController::class, 'deleteAddress'])->name('admin.deleteAddress');

    Route::get('/admin/create-address', [AdminController::class, 'createAddressForm'])->name('admin.createAddressForm');
    Route::post('/admin/create-address', [AdminController::class, 'createAddress'])->name('admin.createAddress');
});

require __DIR__.'/auth.php';
