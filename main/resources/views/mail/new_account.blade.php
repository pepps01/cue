@component('mail::message')
# Account creation Notification
<p>Hello {{$name}}</p>

Your account was created successfully, you can now proceed to enjoy premium access on our platform

@component('mail::button', ['url' => ''])
Proceed to Login
@endcomponent

Best Regards,<br>
{{ config('app.name') }}
@endcomponent