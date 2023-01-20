@component('mail::message', ['data' => $data])

    <h2>Dear {{ $data['email'] }}, your Payment was successful.</h2> 
    <h2>Total Paid: NGN{{ number_format($data['amount']) }}</h2>
    <p>Please note that our fees are non-refundable. Thank you.</p>

@endcomponent
