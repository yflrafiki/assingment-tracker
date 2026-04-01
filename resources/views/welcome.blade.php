@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="card-title mb-4">nPunto Activity Tracker</h1>
                    <p class="card-text text-muted mb-4">
                        Track and manage daily activities for your application support team
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
