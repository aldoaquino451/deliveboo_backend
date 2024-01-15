@extends('layouts.guest')

@section('content')
    <div class="py-4 d-flex flex-column align-items-center">
        <h1 class="mb-4">Guest Home</h1>
        <p>Accedi alla Dashboard:</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
@endsection
