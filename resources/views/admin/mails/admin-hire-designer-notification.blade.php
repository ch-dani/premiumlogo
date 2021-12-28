You got message from {{ $message_data['name'] }}
<br>
Email address: <a href="mailto:{{ $message_data['email'] }}">{{ $message_data['email'] }}</a>
<br>
Message:
<br>
{!! $message_data['message'] !!}