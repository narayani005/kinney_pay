<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\BeneficiarController;
use App\Http\Controllers\API\CreditDebitController;
use App\Http\Controllers\API\AddAccountController;
use App\Http\Controllers\API\RewardsController;
use App\Http\Controllers\API\MoneyRequestController;
use App\Http\Controllers\API\RedeemController;
use App\Http\Controllers\API\BalanceAlertController;
use App\Http\Controllers\API\BankAccountController;
use App\Http\Controllers\API\PersonalExpenseCotroller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    //user
    Route::get('/users', [ UserController::class , 'user_list' ]);
    Route::get('/users/{id}', [ UserController::class , 'edit_user' ]);
    Route::post('/add_user', [ UserController::class , 'add_user' ]);
    Route::put('/update_user/{id}', [ UserController::class , 'update_user' ]);
    Route::delete('/delete_user/{id}', [ UserController::class , 'delete_user' ]);
    Route::post('/change_pwd', [ UserController::class , 'change_pwd' ]);
    //Route::post('/forget_pwd', [ UserController::class , 'forget_pwd' ]);
    Route::post('/update_avatar', [ UserController::class , 'update_avatar' ]);
    //Route::post('/resend', [ UserController::class , 'resend' ]);
    Route::get('/get_user', [ UserController::class , 'get_user' ]);
    Route::post('/create_uid', [ UserController::class , 'create_uid' ]);
    Route::put('/update_uid/{id}', [ UserController::class , 'update_uid' ]);
    Route::put('/forget_uid/{id}', [ UserController::class , 'forget_uid' ]);
    Route::put('/user/status/{id}', [UserController::class, 'user_status']);
    //Route::put('/update_addr/{id}', [ UserController::class , 'update_addr' ]);

    //Add Account
    Route::post('/add_account', [ AddAccountController::class , 'add_account' ]);
    Route::delete('/del_account/{acc_pid}', [ AddAccountController::class , 'del_account' ]);
    Route::get('/get_account/{ref_id}', [ AddAccountController::class , 'get_account' ]);
    Route::get('/get_acc_amt/{unique_id}', [ AddAccountController::class , 'get_acc_amt' ]);
    //Route::get('/acc_uid/{unique_id}', [ AddAccountController::class , 'acc_uid' ]);
    Route::put('/acc_uid_create/{unique_id}', [ AddAccountController::class , 'acc_uid_create' ]);
    Route::post('/acc_uid_change', [ AddAccountController::class , 'acc_uid_change' ]);
    Route::put('/account/status/{id}', [AddAccountController::class, 'account_status']);

    //wallet
    Route::get('/wallet', [ WalletController::class , 'all_wallet' ]);
    Route::put('/update_wallet', [ WalletController::class , 'update_wallet' ]);
    Route::post('/wallet_trans', [ WalletController::class , 'wallet_trans' ]);
    Route::delete('/delete_wallet/{wallet_id}', [ WalletController::class , 'delete_wallet' ]);

    //transaction transaction
    Route::post('/transaction', [ WalletController::class , 'transaction' ]);
    Route::get('/wallet/{user_id}', [ WalletController::class , 'user_wallet' ]);
    Route::get('/fav_wallet/{user_id}', [ WalletController::class , 'fav_wallet' ]);
    Route::post('/add_beneficiar', [ BeneficiarController::class , 'add_beneficiar' ]);
    Route::get('/beneficiar/{user_id}', [ BeneficiarController::class , 'get_beneficiar' ]);
    Route::get('/delete_benefi/{id}', [ BeneficiarController::class , 'delete_benefi' ]);

    //Request money
    Route::post('/req_money', [ MoneyRequestController::class , 'req_money' ]);
    Route::get('/req_money_history/{user_id}', [ MoneyRequestController::class , 'req_money_history' ]);

    //Reward
    Route::get('/get_rewards/{user_id}', [ RewardsController::class , 'get_rewards' ]);
    Route::get('/total_reward/{user_id}', [ RewardsController::class , 'total_reward' ]);

    //Redeem
    Route::get('/redeem/{country_code}',[RedeemController::class,'get_redeem']);
    Route::post('/redeem/{user_id}',[RedeemController::class,'redeem']);

    //minimum balance alert
    Route::put('/balance_alert/{user_id}',[BalanceAlertController::class,'balance_alert']);

    //add bank account
    Route::post('/add_bank_acc/{user_id}',[BankAccountController::class,'add_bank_acc']);
    Route::get('/get_bank_acc/{user_id}',[BankAccountController::class,'get_bank_acc']);
    Route::put('/edit_bank_acc/{id}',[BankAccountController::class,'edit_bank_acc']);
    Route::delete('/del_bank_acc/{id}',[BankAccountController::class,'del_bank_acc']);

    //Personal Expenses
    Route::get('/personal_expense/{user_id}', [PersonalExpenseCotroller::class, 'personal_expense']);

    /* Credit and Debit for Kinney Pay Wallet */
    Route::post('/self/credit-debit', [CreditDebitController::class , 'creditDebit' ]);
    });
    //Route::post('/self/credit-debit', [CreditDebitController::class , 'creditDebit' ]);
Route::get('/qrcode/{id}', [UserController::class , 'qrcode' ]);

Route::post('/index',[UserController::class,'index']);
Route::post('/login',[UserController::class,'login']);

Route::post('/otp_check', [UserController::class, 'otp_check']);
Route::post('/resend', [ UserController::class , 'resend' ]);
