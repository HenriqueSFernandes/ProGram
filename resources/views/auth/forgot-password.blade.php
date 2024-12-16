@extends('layouts.auth')
@section('title')
    {{ 'Reset Password | ProGram' }}
@endsection
@section('content')
    <main id="reset-password-page" class="grid grid-cols-3 items-center">
        @include('auth.forgot-password-form')
    </main>
@endsection
