<x-mail::message>

Click Here To Verify Your Email 
<a href="{{ url('api/register/verify',  $token ) }}">Verify Email</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
