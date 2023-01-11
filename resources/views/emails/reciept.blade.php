@component('mail::message', ['data' => $data])

    <img class="img-fluid mb-3" src="https://geoprecisegroup.com/images/logo.png" alt="{{ config('app.name') }}" style="width: 50%">
    <h2>Dear {{ $data['email'] }}, you Payment was successful.</h2> 
    <h2>Total Paid: NGN{{ number_format($data['amount']) }}</h2>
    <p>Please note that Survey service fees are non-refundable. Thank you</p>

@endcomponent
