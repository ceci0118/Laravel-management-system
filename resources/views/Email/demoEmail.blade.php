@component('mail::message')

{{-- title line --}}
<h2>{{ $mailData['title'] }}</h2>
<br>

{{-- custom name --}}
<p>Dear applicant {{ $mailData['name'] }}</p>
<br>

{{-- email body --}}
<p>{{ $mailData['body'] }}</p>


@if ($mailData['url'] && $mailData['btnText'])
@component('mail::button', ['url' => $mailData['url'], 'color' => 'success'])
{{ $mailData['btnText'] }}
@endcomponent
@endif


Thanks,<br>
Hockey Eastern Ontario
@endcomponent