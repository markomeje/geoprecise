@component('mail::message', ['data' => $data])

    <h2>Dear {{ $data['email'] }}</h2> 
    <h2>Total: NGN{{ number_format($data['amount']) }}</h2>
    <p>Please note that Survey service fees are non-refundable. Thank you</p>

<p>Regards from {{ config('app.name') }}</p>

@endcomponent
