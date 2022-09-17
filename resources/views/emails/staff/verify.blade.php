@component('mail::message', ['data' => $data])

<h2>Dear {{ $data['email'] }} You have been added to {{ config('app.name') }}.</h2> 
<p>Please click on the button below to verify your Email address.</p>

<div style="text-align: left;">
	@component('mail::button', ['url' => route('verify.email', ['token' => $data['token']])])
		Click Here
	@endcomponent
</div>

<h3>Use the password below to login. Please reset the password immediately.</h3>
<h1>Password: {{ $data['password'] }}</h1>
<p>Regards {{ config('app.name') }}</p>

@endcomponent
