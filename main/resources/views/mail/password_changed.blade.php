@component('mail::message')
# Password Changed Notification
<p>Hello {{$name}}</p>

You are receiving this notification because of your recent password change activity

@component('mail::button', ['url' => ''])
Proceed to Login
@endcomponent

Best Regards,<br>
{{ config('app.name') }}
@endcomponent