@extends('layouts.app')
@section('title', $viewData['title'])

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@php
    $activeOption = request()->query('option');
@endphp

@section('content')
    <div class="container">
        <div class="sidebar">
            <a class="{{ $activeOption == 'a' ? 'active' : '' }}" href="{{ route('home.account', ['option' => 'a']) }}">Info</a>
            <a class="{{ $activeOption == 'b' ? 'active' : '' }}" href="{{ route('home.account', ['option' => 'b']) }}">Address</a>
            <a class="{{ $activeOption == 'c' ? 'active' : '' }}" href="{{ route('home.account', ['option' => 'c']) }}">Forget Password</a>
            <a class="{{ $activeOption == 'd' ? 'active' : '' }}" href="{{ route('home.account', ['option' => 'd']) }}">Order History</a>
        </div>

        <div class="content">
            {!! $content !!} <!-- hiển thị nội dung dựa trên option -->
        </div>
    </div>
@endsection
