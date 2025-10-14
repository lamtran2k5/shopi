@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="row g-0">
    <div class="col-md-4">
        <img src="{{ asset('/img/'.$product->image) }}" class="img-fluid rounded-start" id="product-img">
    </div>

    <div class="col-md-8 d-flex flex-column justify-content-end">
        {{-- Thông tin sản phẩm --}}
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }} ({{ $product->price }})</h5>
            <p class="card-text">{{ $product->description }}</p>
        </div>

        {{-- 2 nút bấm --}}
        <div class="d-flex gap-3 mt-auto ms-3">
            <a href="{{ route('order.orderdetail', ['product' => $product->id]) }}" 
            class="btn btn-success">
                Add Cart
            </a>
            <a href="{{ route('order.orderdetail', ['product' => $product->id]) }}" 
            class="btn btn-success">
                Buy Now
            </a>
        </div>
    </div>
</div>

{{-- Thông tin shop ở dưới --}}
<div class="mt-3 p-3 bg-light d-flex align-items-center rounded">
    <img src="{{ asset($shop->background_image) }}" alt="Shop Avatar" class="rounded-circle me-2" width="50" height="50">
    <a href="#" 
    class="fw-bold text-dark text-decoration-none">
        {{ $shop->full_name }}
    </a>
</div>
@endsection
