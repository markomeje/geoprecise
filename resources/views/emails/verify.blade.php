@component('mail::message', ['data' => $data])

<h2>Dear {{ $data['email'] }}</h2> 
<p>Please click the link below to verify your Email address.</p>

<p>
    {{ route('signup.verify', ['token' => $data['token']]) }}
</p>
<p>Regards from {{ config('app.name') }}</p>

@endcomponent
