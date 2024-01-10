@extends('layouts.guest')

@section('content')
    <div>
        <p>home guest</p>

        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
@endsection
