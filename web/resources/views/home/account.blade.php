@extends('layouts.app')
@section('title', $title)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@php
    $activeOption = request()->query('option');
@endphp

@section('content')
    <div class="container">
        <div class="sidebar">
            <a class="{{ $activeOption == '1' ? 'active' : '' }}" href="{{ route('home.account', ['option' => '1']) }}">Account</a>
            <a class="{{ $activeOption == '2' ? 'active' : '' }}" href="{{ route('home.account', ['option' => '2']) }}">Info</a>
            <a class="{{ $activeOption == '3' ? 'active' : '' }}" href="{{ route('home.account', ['option' => '3']) }}">Address</a>
            <a class="{{ $activeOption == '4' ? 'active' : '' }}" href="{{ route('home.account', ['option' => '4']) }}">Forget Password</a>
            <a class="{{ $activeOption == '5' ? 'active' : '' }}" href="{{ route('home.account', ['option' => '5']) }}">Order History</a>
        </div>

        <div class="content">
            @include($contentView) <!-- hiển thị nội dung dựa trên option -->
        </div>
    </div>
@endsection
