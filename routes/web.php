<?php

use App\Http\Controllers\CourierController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GoogleMapsController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TariffController;
use App\Mail\ParcelShipped;
use Illuminate\Support\Facades\Mail;
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

Route::get('/dashboard', [ParcelController::class, 'parcelHistory'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/track', [ParcelController::class, 'trackingView'])->name('parcel.trackingView');
Route::post('/track', [ParcelController::class, 'track'])->name('parcel.track');

Route::get('/public-tariffs', [TariffController::class, 'viewPublicTariffs'])->name('tariff.public');

Route::middleware('auth')->group( function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'updateOrCreateDefaultAddress'])->name('profile.updateOrCreateDefaultAddress');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/payment-history', [ParcelController::class, 'paymentHistory'])->name('payment.history');

    Route::get('/create-parcel/cancel', [ParcelController::class, 'cancel'])->name('parcel.cancel');
    Route::get('/create-parcel', [ParcelController::class, 'step1'])->name('parcel.step1');
    Route::post('/create-parcel', [ParcelController::class, 'storeStep1'])->name('parcel.storeStep1');
    Route::get('/create-parcel/contact-sender', [ParcelController::class, 'step2'])->name('parcel.step2');
    Route::post('/create-parcel/contact-sender', [ParcelController::class, 'storeStep2'])->name('parcel.storeStep2');
    Route::get('/create-parcel/contact-receiver', [ParcelController::class, 'step3'])->name('parcel.step3');
    Route::post('/create-parcel/contact-receiver', [ParcelController::class, 'storeStep3'])->name('parcel.storeStep3');
    Route::get('/create-parcel/overview', [ParcelController::class, 'step4'])->name('parcel.step4');
    Route::post('/create-parcel/overview', [ParcelController::class, 'storeAllData'])->name('parcel.storeAllData');

    //Stripe routes
    Route::get('/create-parcel/payment', [StripeController::class, 'payment'])->name('stripe.payment');
    Route::post('/create-parcel/session', [StripeController::class, 'session'])->name('stripe.session');
    Route::get('/create-parcel/success', [StripeController::class, 'success'])->name('stripe.success');

});

Route::middleware("admin")->group( function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // User CRUD routes
    Route::get('/admin/users', [AdminController::class, 'viewAllUsers'])->name('admin.users');

    Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUserForm'])->name('admin.editUserForm');
    Route::put('/admin/edit-user/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::put('/admin/edit-user-password/{user}', [AdminController::class, 'editUserPassword'])->name('admin.editUserPassword');

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

    // Client routes
    Route::get('/admin/clients', [AdminController::class, 'viewAllClients'])->name('admin.clients');

    Route::get('/admin/edit-client/{client}', [AdminController::class, 'editClientForm'])->name('admin.editClientForm');
    Route::put('/admin/edit-client/{client}', [AdminController::class, 'editClient'])->name('admin.editClient');

    Route::delete('/admin/delete-client/{client}', [AdminController::class, 'deleteClient'])->name('admin.deleteClient');

    Route::get('/admin/create-client', [AdminController::class, 'createClientForm'])->name('admin.createClientForm');
    Route::post('/admin/create-client', [AdminController::class, 'createClient'])->name('admin.createClient');

    // Route generation
    Route::get('/generate-route', [AdminController::class, 'viewAllParcels'])->name('admin.generateRouteView');
    Route::post('/generate-route', [GoogleMapsController::class, 'generateOptimizedRoute'])->name('admin.generateRoute');

    // Bulk import
    Route::get('/admin/parcels/import', [ImportController::class, 'showImportForm'])->name('admin.importForm');
    Route::post('/admin/parcels/import', [ImportController::class, 'import'])->name('admin.import');
    Route::get('/admin/download-template', [ImportController::class, 'downloadTemplate'])->name('admin.downloadTemplate');

    // Bulk export
    Route::post('/parcels/export-selected', [ExportController::class, 'exportSelectedParcels'])->name('admin.export');

    Route::get('/admin/parcel-tracking', [AdminController::class, 'parcelTracking'])->name('admin.parcelTracking');
});

Route::middleware('courier')->group(function () {
    Route::get('/courier', [CourierController::class, 'index'])->name('courier.dashboard');
    Route::get('/courier/update-status', [CourierController::class, 'updateStatus'])->name('courier.updateStatus');

    Route::get('/courier/parcels', [CourierController::class, 'viewAllParcels'])->name('courier.parcels');
    Route::get('/courier/edit-parcel/{parcel}', [CourierController::class, 'editParcelForm'])->name('courier.editParcelForm');
    Route::put('/courier/edit-parcel/{parcel}', [CourierController::class, 'editParcel'])->name('courier.editParcel');
});

require __DIR__.'/auth.php';
