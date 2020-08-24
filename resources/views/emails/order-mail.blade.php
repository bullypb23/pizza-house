@component('mail::message')
# Order

You have successfully completed order.<br>
Name: {{ $data['name']}}.<br>
Phone number: {{ $data['phone']}}.<br>
Address: {{ $data['address']}}.<br>
Thank you for using our services.<br>

All the best,<br>
Your {{ config('app.name') }}
@endcomponent