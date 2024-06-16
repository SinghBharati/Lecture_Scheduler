<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Models\Products;
use App\Models\Orders;
use App\Models\RazorpayCredentials;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


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

Route::get('/', [InstructorController::class, 'index']);

Route::get('/add_course', [CourseController::class , 'index'])->name('addcourse');
Route::post('/add_course', [CourseController::class , 'store']);

Route::get('/add_batch/{id}', [BatchController::class , 'index'])->name('addbatch');
Route::post('/add_batch/{id}', [BatchController::class , 'store']);

//Route::view('/instructiorpanel', 'instructorpanel');
Route::get('/instructiorpanel/{id}', [InstructorController::class, 'show']);

Route::get('/products', function (){
     $products = Products::all();
    return view('list')->with('products' , $products);
});


Route::get('/products/buy/{product}', function (Products $product){
     $razorpay_cred = RazorpayCredentials::first();

    $api = new Api($razorpay_cred->key_id,$razorpay_cred->key_secret);
    $order =$api->order->create([
        'receipt' => '123',
        'amount' => $product->price * 100,
        'currency' => 'INR'
    ]);

    $data = [
        "key"               => $razorpay_cred->key_id, // Enter the Key ID generated from the Dashboard
        "amount"            => $order['amount'],
        "name"              => "Acme Corp",
        "currency"          => $order['currency'],
        "image"             => "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
    "prefill"           => [
        "name"              => "Gaurav Kumar",
        "email"             => "gaurav.kumar@example.com",
        "contact"           => "9000090000",
    ],
    "notes"             => [
        "address"           => "Razorpay Corporate Office",
        "merchant_order_id" => "12312321",
    ],
    "theme"             => [
        "color"             => "#3399cc"
    ],
    "order_id"          => $order['id'],
    ];

    Orders::create([
        'user_id' => 1,
        'product_id' => $product->id,
        'order_id' => $order['id'],
        'amount' => $order['amount'],
        'status' => $order['status']
    ]);


    return view('buy')
        ->with('data', $data)
        ->with('product' , $product);
})->name('product.buy');


Route::post('payment-verify', function (Request $request){
    $razorpay_cred = RazorpayCredentials::first();
    $api = new Api($razorpay_cred->key_id,$razorpay_cred->key_secret);

    $attributes = [
        'razorpay_order_id' => $request->input('razorpay_order_id'),
        'razorpay_signature' => $request->input('razorpay_signature'),
        'razorpay_payment_id' => $request->input('razorpay_payment_id'),
    ];

    try{
        $api->utility->verifyPaymentSignature($attributes);
        Orders::where('order_id', $request->input('razorpay_order_id'))->update([
            'razorpay_payment_id' => $request->input('razorpay_payment_id'),
            'razorpay_signature' => $request->input('razorpay_signature'),
            'status' =>  'paid',
        ]);
        return  response(['message' => 'Verification Success'], 200);
    } catch(SignatureVerificationError $e){
          return  response(['message' => 'Verification Failed'], 400);
    }
    return $request->all();

})->name('payment.verify');


