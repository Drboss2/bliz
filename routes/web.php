<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\GiftcardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KycController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\CryptoassetsController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\UsersController;

// super admin
Route::middleware(['isCeo'])->group(function () {
    Route::post('/admin/add/admin/',[AdminController::class,'addAdmin']);
    Route::post('/admin/add/remove/',[AdminController::class,'removeAdmin']);
    Route::get('/admin/add',[AdminController::class,'superAdmin']);

    //admin crypto
    Route::post('/admin/delete',[CryptoassetsController::class,'deleteCrypto']);
    Route::post('/admin/crypto/edit/single_crypto_details',[CryptoassetsController::class,'editCryptoDetailsById']);
    Route::get('/admin/crypto/single_crypto_details/{id}',[CryptoassetsController::class,'getCryptoDetailsById']);
    Route::get('/admin/crypto/crypto_details/{id}/{name}',[CryptoassetsController::class,'cryptoCardDetails']);
    Route::post('/admin/crypto/details',[CryptoassetsController::class,'storeCryptoDetails']);
    Route::post('/admin/crypto/delete/{id}',[CryptoassetsController::class,'delete']);
    Route::post('/admin/crypto/store',[CryptoassetsController::class,'store']);
    Route::post('/admin/crypto/address',[CryptoassetsController::class,'editAdress']);
    Route::get('/admin/crypto/{id}',[CryptoassetsController::class,'getAdress']);
    Route::get('/admin/crypto',[CryptoassetsController::class,'index']);
});
// admin uses
Route::get('/admin/pin/{email}',[UsersController::class,'getUserPin']);
Route::get('/admin/pin',[UsersController::class,'checkforPin']);
Route::get('/admin/user',[UsersController::class,'index']);

//admin gift route
Route::post('/admin/gift/edit/single_card_details/{id}',[GiftController::class,'editGiftCardDetailsById']);
Route::get('/admin/gift/single_card_details/{id}',[GiftController::class,'getGiftCardDetailsById']);
Route::get('/admin/gift/card_details/{id}/{name}',[GiftController::class,'giftCardDetails']);
Route::post('/admin/gift/details',[GiftController::class,'storeGiftCardDetails']);
Route::get('/admin/gift/name/{id}',[GiftController::class,'nameByCardId']);
Route::post('/admin/gift/delete/{id}',[GiftController::class,'delete']);
Route::post('/admin/gift/store',[GiftController::class,'store']);
Route::get('/admin/gift',[GiftController::class,'index']);

//admin add bank
Route::post('/admin/bank/delete/{id}',[BankController::class,'delete']);
Route::post('/admin/bank/store',[BankController::class,'store']);
Route::get('/admin/bank',[BankController::class,'index']);


//admin withdrawal request
Route::get('/admin/withdraw/fail',[WithdrawalController::class,'allDeclinedWithdrawalRequest']);
Route::get('/admin/withdraw/paid',[WithdrawalController::class,'allPaidWithdrawalRequest']);
Route::post('/admin/withdraw/yes',[WithdrawalController::class,'approveWithdrawalRequest']);
Route::post('/admin/withdraw/no',[WithdrawalController::class,'declinedWithdrawalRequest']);
Route::get('/admin/withdraw',[WithdrawalController::class,'index']);

// admin trade routes
Route::get('/admin/download/{id}',[TradeController::class,'downloadFile'])->name('download');
Route::get('/admin/image',[TradeController::class,'allPaidTrade']);
Route::get('/admin/trade/paid',[TradeController::class,'allPaidTrade']);
Route::post('/admin/trade/success/{id}',[TradeController::class,'approveTrade']);
Route::get('/admin/trade/failed',[TradeController::class,'allDeclinedTrade']);
Route::post('/admin/trade/failed/{id}',[TradeController::class,'declinedTrade'])->name('admin.trade.failed');
Route::get('/admin/trade',[TradeController::class,'index'])->name('admin.trade');
Route::get('/admin',[AdminController::class,'index']);



// kyc
Route::get('/kyc',[KycController::class,'index']);
Route::post('/kyc/create',[KycController::class,'create'])->name('kyc.create');


// get pin
Route::get('/pin',[WalletController::class,'getPin']);

// settings route
Route::post('/settings/user_pin',[SettingController::class,'updatePin']);
Route::post('/settings/user_password',[SettingController::class,'updatePasword']);
Route::post('/settings/user_update',[SettingController::class,'updateUser']);
Route::get('/settings',[SettingController::class,'index'])->name('index');

//crypto assets route
Route::get('/crypto/{id}/{name}',[CryptoController::class,'getSingelCrypto']);
Route::post('crypto/sell',[CryptoController::class,'sellCryptoRequest'])->name('sell.crypto');
Route::get('crypto/{id}',[CryptoController::class,'getCrpto']);
Route::get('cryptos/{id}',[CryptoController::class,'getSingelCryptoAddress']);
Route::get('crypto',[CryptoController::class,'index'])->name('crypto.index');

//giftcard routes
Route::post('giftcard/confirmsell',[GiftcardController::class,'confirmCardRequest'])->name('confirmgift');
Route::post('giftcard/sellgiftcard',[GiftcardController::class,'sellCardRequest'])->name('sellgift');
Route::get('/giftcard/{id}',[GiftcardController::class,'getcardDetails']);
Route::get('/giftcard/{id}/{name}',[GiftcardController::class,'getSingleGiftcard']);
Route::get('/giftcard',[GiftcardController::class,'index'])->name('giftcard');

//rates route
Route::get('/getcamount/{id}',[RatesController::class,'getCrytoAmount']);
Route::get('/getamount/{id}',[RatesController::class,'getRateAmount']);
Route::get('/gettype/{id}',[RatesController::class,'getRateType']);
Route::get('/rates',[RatesController::class,'index'])->name('rates');

Route::get('/transaction',[TransactionController::class,'index'])->name('trans');

//route to fund naira wallet
Route::post('/pay',[PaymentController::class,'redirectToGateway'])->name('pay');
Route::get('/payment/callback',[PaymentController::class,'handleGatewayCallback']);

//withdrawal route
Route::post('/paywallet',[WalletController::class,'confirmAndPaid'])->name('paywith');
Route::post('/wallet',[WalletController::class,'withdrawalRequest'])->name('with');
Route::get('/wallet',[WalletController::class,'index'])->name('wallet');

Route::get('/wallet',[WalletController::class,'pag'])->name('wallet');
Route::get('/pagination/fetch_data',[WalletController::class,'pag_ajax']);

Route::get('logout',[DashboardController::class,'logOut'])->name('logout');
Route::get('/dashboard',[DashboardController::class,'index'])->name('user.dashboard');

//pin
Route::post('/pin/create',[PinController::class,'createPin']);
Route::get('/pin/index',[PinController::class,'index']);

// rate
Route::get('/rate',[DashboardController::class,'rateIndex']);

// sign up route
Route::post('/register',[UserController::class,'signUp'])->name('user.register');

// login/register route
Route::post('/login',[UserController::class,'login'])->name('user.login');
Route::get('/login',[UserController::class,'index']);
Route::get('/register',[UserController::class,'indexs']);
Route::get('/verified',[UserController::class,'verified']);
Route::get('/isverified',[PinController::class,'verifyUsers'])->name('user.isverified');
Route::post('/re_verified',[PinController::class,'resendMail']);


Route::get('/forgetpassword',[PasswordResetController::class,'passIndex']);
Route::post('/password',[PasswordResetController::class,'sendPassLink']);
Route::get('/password/index/{email}',[PasswordResetController::class,'passIndexChange'])->name('pass.change');
Route::post('/password/index/pass',[PasswordResetController::class,'changePass']);


// home link
Route::get('/', [IndexController::class,'index']);
Route::post('/subscribe', [IndexController::class,'newsLetters']);

// return csrf_token
Route::get('/refresh',function(){
    return csrf_token();
});

Route::get('up', function (){
    \Illuminate\Support\Facades\Artisan::call('up');
    echo 'ok';
});
Route::get('down', function (){
    \Illuminate\Support\Facades\Artisan::call('down');
    echo 'ok';
});
Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

