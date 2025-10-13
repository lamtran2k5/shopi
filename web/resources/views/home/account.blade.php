@extends('layouts.app')
@section('title', $title)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="sidebar">
        <a class="{{ request()->routeIs('account.avatar') ? 'active' : '' }}" href="{{ route('account.avatar') }}">Avatar</a>
        <a class="{{ request()->routeIs('account.info') ? 'active' : '' }}" href="{{ route('account.info') }}">Info</a>
        <a class="{{ request()->routeIs('account.wallet') ? 'active' : '' }}" href="{{ route('account.wallet') }}">Wallet</a>
        <a class="{{ request()->routeIs('account.changePasswd') ? 'active' : '' }}" href="{{ route('account.changePasswd') }}">Change Password</a>
        <a class="{{ request()->routeIs('account.paymenthistory') ? 'active' : '' }}" href="{{ route('account.paymenthistory') }}">Payment History</a>
    </div>

    <div class="content">
        @include($contentView)
    </div>
</div>
@endsection

