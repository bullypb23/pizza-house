@component('mail::message')
# Message

You recieved message from customer.<br>
Name: {{ $data['name']}}.<br>
Email: {{ $data['email']}}.<br>
Subject: {{ $data['subject']}}.<br>
Message: {{ $data['message']}}.<br>

All the best,<br>
Your {{ config('app.name') }}
@endcomponent