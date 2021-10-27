<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeneficiarController;
use App\Http\Controllers\QRcodeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\MoneyRequestController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RechargeController;


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


/* Clear cache  */
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });

//User Route
Route::get('/Profile/{id}', [UserController::class, 'myprofile']);
Route::get('/Transaction-History', [UserController::class, 'transactionHistory']);
Route::get('/Trans-History', [UserController::class, "getTransactionHistory"])->name('user.gettranshistory');
Route::get('/Add-Wallet', [UserController::class, 'add_wallet']);
Route::get('/Share-Wallet', [UserController::class, 'share_wallet_form']);
Route::get('/edit_profile/{id}', [UserController::class, 'edit_profile']);
Route::post('/update_user', [UserController::class, 'update_user']);
Route::get('/delete_profile/{id}', [UserController::class, 'delete_profile']);
Route::post('/wallet_trans', [UserController::class, 'wallet_trans']);
Route::get('/mywallet', [UserController::class, 'mywallet']);
Route::get('/generate_pin', [UserController::class, 'generate_pin']);
Route::post('/pin_submit', [UserController::class, 'pin_submit']);
Route::get('/forget_pin', [UserController::class, 'forget_pin']);
Route::get('/change_pin', [UserController::class, 'change_pin']);
Route::post('/cpin_submit', [UserController::class, 'cpin_submit']);
Route::get('/plans', [UserController::class, 'subscribePlans']);
Route::get('/rewards', [UserController::class, 'subscribeRewards']);
//Route::('/forget_pin', [UserController::class, 'forget_pin']);

/* Bank Accounts */
Route::get('/Bank-Accounts', [UserController::class, 'bank_accounts']);
Route::post('/store-bank-accounts', [UserController::class, 'store_bank_accounts']);
Route::get('/destory-bank-account/{id}', [UserController::class, 'destoryBankAccount']);

//Users of Beneficiary
Route::get('/beneficiary-index', [BeneficiarController::class, 'index']);
Route::get('/create-beneficiary', [BeneficiarController::class, 'createBeneficiary']);
Route::post('/check-beneficiary', [BeneficiarController::class, 'checkBeneficiary']);
Route::get('/delete-beneficiary/{id}', [BeneficiarController::class, 'deleteBeneficiary']);
Route::get('/edit-beneficiary/{id}', [BeneficiarController::class, 'editBeneficiary']);
Route::post('/update-beneficiary', [BeneficiarController::class, 'updateBeneficiary']);

/* User Add To Account */
Route::get('/create-account', [UserController::class, 'createAccount']);
Route::post('/account-store', [UserController::class, 'storeAccount']);
Route::get('/remove-account/{id}', [UserController::class, 'removeAccount']);

/* User Debit and Credit to Wallet */
Route::post('/credit-debit', [UserController::class, 'creditDebit']);

/* QR Code */
Route::get('/QRcode-Create', [QRcodeController::class, 'qrCodeCreate']);
Route::get('/QRcode-Download', [QRcodeController::class, 'qrDownload']);
Route::get('/qrcode', [QRcodeController::class, 'qrcode']);

//Rewards
Route::get('/rewards', [RewardsController::class, 'my_rewards']);

//Request Money
Route::get('/req-money', [MoneyRequestController::class, 'req_money']);
Route::post('/req_money_submit', [MoneyRequestController::class, 'req_money_submit']);
Route::get('/req-money-history', [MoneyRequestController::class, 'req_money_history']);
Route::get('/withdraw_money/{status}/{id}', [MoneyRequestController::class, 'withdraw_approval']);

// Login or register redirect
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('is_admin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

//User Login
//Route::view('/login', 'login')-> name("login");
Route::get('/login', [LoginController::class, 'showUserLoginForm'])-> name("login");
Route::get('/register', [LoginController::class, 'showUserRegisterForm'])-> name("register");
//Route::view('/register', 'register');
Route::view('/forget_pwd', 'forget_pwd');

// Main pages
Route::view('/', 'welcome')-> name("welcome");
Route::view('/contact_us', 'contact_us')-> name("contact_us");
Route::view('/sitemap', 'sitemap')-> name("sitemap");
Route::view('/easy_to_manage', 'easy_to_manage')-> name("easy_to_manage");

/* Send SMS */
Route::get('sendSMS', [SMSController::class, 'index']);

//Admin Route
Route::get('admin/profile/{id}', [UserController::class, 'myprofile']);
Route::get('/admin/users', [WalletController::class, 'all_user']);
Route::get('/admin/add_wallet', [WalletController::class, 'add_wallet']);
Route::get('/admin/edit_profile/{id}', [WalletController::class, 'admin_edit_profile']);
Route::post('/admin/update_user', [WalletController::class, 'admin_update_user']);
Route::get('/admin/delete_profile/{id}', [WalletController::class, 'delete_profile']);
Route::view('/admin/add_user', 'admin.add_user');
Route::post('/admin/wallet_submit',[WalletController::class, 'add_wallet_data']);
Route::post('/admin/update_wallet',[WalletController::class, 'update_wallet']);
Route::get('/admin/wallet', [WalletController::class, 'all_wallet']);
Route::get('/admin/edit_wallet/{wallet_id}', [WalletController::class, 'edit_wallet']);
Route::get('/admin/delete_wallet/{wallet_id}', [WalletController::class, 'delete_wallet']);
Route::post('/admin/user_submit', [WalletController::class, 'user_submit']);

/* Admin list of user plans */
Route::get('/admin/subcribe-plans', [AdminController::class, 'user_sub_plans']);

/* Setup Configuration */
Route::get('/admin/config', [AdminController::class, 'configuration']);
Route::post('/admin/store-config', [AdminController::class, 'storeConfig']);
Route::get('/admin/destory-account/{id}', [AdminController::class, 'destoryConfig']);
Route::get('/admin/status/{status}/{id}', [AdminController::class, 'user_status']);
Route::get('/admin/req-money-history', [MoneyRequestController::class, 'req_money_history']);

//admin rewards
Route::get('/admin/rewards', [RewardsController::class, 'my_rewards']);

/* Admin Login */
Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('AdminLoginCheck');
Route::post('/adminLogin', [LoginController::class, 'adminLogin'])->name('adminLogin');
Route::get('/admin/register', [LoginController::class, 'all_user']);

//Rechare
Route::get('/admin/recharge_form', [RechargeController::class, 'recharge_form']);
Route::post('/admin/recharge', [RechargeController::class, 'recharge']);
Route::get('/admin/recharge_history', [RechargeController::class, 'recharge_history']);

