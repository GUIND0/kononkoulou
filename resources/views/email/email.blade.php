@component('mail::message')

{!! $maildata['message'] !!}

{{--@component('mail::button', ['url' => config('app.url'), 'color' => 'primary'])--}}
{{--Accéder à {{ config('app.name') }}--}}
{{--@endcomponent--}}

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
