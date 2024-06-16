<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buy Product</title>
</head>
<body>
    <h1>I am Buying {{$product->name}}</h1>
    <p>Price {{$product->price}}</p>

    <button id="rzp-button1">Pay</button>

    <form name="razorpayform" action="{{route('payment.verify')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">

    </form>
</body>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = @json($data);

    options.handler = function (response){
        console.log('response' ,response);
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
        document.razorpayform.submit();
    }

    var rzp = new Razorpay(options);

    document.getElementById('rzp-button1').onclick =function (e){
        rzp.open();
        e.preventDefault();
    }

</script>
</html>
