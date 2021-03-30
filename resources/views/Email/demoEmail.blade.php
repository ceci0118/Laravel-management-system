@component('mail::message')

<h2>{{ $mailData['title'] }}</h2>

The body of your message.
<h2>{{ $mailData['body'] }}</h2>


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent