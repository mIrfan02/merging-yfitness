@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Home
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!-- CSS Part Here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@stop

{{-- Page content --}}
@section('content')

    <div class="container">
            <h3>Terms and Conditions</h3>
            <div class="prize-description">
                <p>About text here</p>
            </div>
        </div>
@stop


{{-- page level scripts --}}
@section('footer_scripts')

@stop