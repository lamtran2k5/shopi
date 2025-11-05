@extends('layouts.app')

@section('title', 'MyShoppi - Trang chủ')

@section('content')
<!-- Hero Banner -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">Chào mừng đến MyShoppi</h1>
                <p class="lead">Khám phá bộ sưu tập thời trang mới nhất với giá tốt nhất</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Mua sắm ngay</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('/coverimg/desktop-banner-web-fall-25-01-png-n7s2.webp') }}" alt="Shopping" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Categories -->
<div class="container my-5">
    <h2 class="text-center mb-4">Danh mục sản phẩm</h2>
    <div class="row g-3">
        @foreach($categories as $category)
            <div class="col-md-3 col-6">
                <a href="{{ route('category', $category->slug) }}" class="text-decoration-none">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 120px; object-fit: cover;">
                            <h5 class="card-title">{{ $category->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div class="container my-5">
    <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
    <div class="row g-4">
        @foreach($featuredProducts as $product)
            <div class="col-md-3 col-sm-6">
                <div class="card product-card h-100 position-relative">
                    @if($product->has_discount)
                        <span class="badge badge-sale">-{{ $product->discount_percent }}%</span>
                    @endif

                    <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/300x400' }}"
                         class="card-img-top" alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">

                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted small">{{ $product->category->name }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($product->has_discount)
                                    <span class="text-danger fw-bold">{{ number_format($product->sale_price) }}₫</span>
                                    <small class="text-muted text-decoration-line-through d-block">{{ number_format($product->price) }}₫</small>
                                @else
                                    <span class="fw-bold">{{ number_format($product->price) }}₫</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fas fa-eye"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Latest Products -->
<div class="container my-5">
    <h2 class="text-center mb-4">Sản phẩm mới nhất</h2>
    <div class="row g-4">
        @foreach($latestProducts as $product)
            <div class="col-md-3 col-sm-6">
                <div class="card product-card h-100 position-relative">
                    @if($product->has_discount)
                        <span class="badge badge-sale">-{{ $product->discount_percent }}%</span>
                    @endif

                    <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/300x400' }}"
                         class="card-img-top" alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">

                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted small">{{ $product->category->name }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($product->has_discount)
                                    <span class="text-danger fw-bold">{{ number_format($product->sale_price) }}₫</span>
                                    <small class="text-muted text-decoration-line-through d-block">{{ number_format($product->price) }}₫</small>
                                @else
                                    <span class="fw-bold">{{ number_format($product->price) }}₫</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fas fa-eye"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Xem tất cả sản phẩm</a>
    </div>
</div>
@endsection
