@extends('layouts.app')
@section('title', $title)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="sidebar">
            <a class="" href="{{ route('account.avatar') }}">Avatar</a>
            <a class="" href="{{ route('home.account') }}">Info</a>
            <a class="" href="{{ route('home.account') }}">Address</a>
            <a class="" href="{{ route('account.changePasswd') }}">Change Password</a>
            <a class="" href="{{ route('home.account') }}">Order History</a>
        </div>

        <div class="content">
            @include($contentView) <!-- hiển thị nội dung dựa trên option -->
        </div>
    </div>
@endsection
