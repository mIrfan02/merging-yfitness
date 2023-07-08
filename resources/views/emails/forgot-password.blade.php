@extends('emails/layouts/default')

@section('content')
<p>Hello {!! $user->first_name !!} {!! $user->last_name !!},</p>

<p>Your verification code is:</p>

<p><h1>{{ $reminderCode }}</h1></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
