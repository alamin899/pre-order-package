<!-- resources/views/dashboard.blade.php -->
@extends('preorder::dashboard-layout')

@section('title', 'Dashboard')

@section('page-title', 'Home')

@section('content')
    <div class="card">
        <div class="card-header">
            Dashboard Content
        </div>
        <div class="card-body">
            <h5 class="card-title">Welcome to your dashboard, {{\Illuminate\Support\Facades\Session::get('auth_user')->name}}!</h5>
            <p class="card-text">You are logged in and can access your data here.</p>
        </div>
    </div>
@endsection
