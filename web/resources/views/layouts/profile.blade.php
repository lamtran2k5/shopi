@extends('layouts.app')
@section('title', $title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')
<div class="containerprofile">
    <div class="sidebar">
        <a class="{{ request()->routeIs('profile.avatar') ? 'active' : '' }}" href="{{ route('profile.avatar') }}">Avatar</a>
        <a class="{{ request()->routeIs('profile.changePasswd') ? 'active' : '' }}" href="{{ route('profile.changePasswd') }}">Change Password</a>
        <a class="{{ request()->routeIs('profile.info') ? 'active' : '' }}" href="{{ route('profile.info') }}">Info</a>
    </div>

    <div class="content">
        @include($contentView)
    </div>
</div>
@endsection

