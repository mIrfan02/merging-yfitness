@extends('emails/layouts/default')

@section('content')
<p>Hello {!! $user->first_name !!},</p>

<p>Welcome to SiteNameHere! Please click on the following link to confirm your SiteNameHere account:</p>

<p><a href="{!! $activationUrl !!}">{!! $activationUrl !!}</a></p>

<p><h1>OR</h1></p>

<p>Your verification code is:</p>

<p><h1>{{ $reminderCode }}</h1></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
