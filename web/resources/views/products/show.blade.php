@extends('layouts.app')

@section('title', $product->name . ' - MyShoppi')

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category', $product->category->slug) }}">
                {{ $product->category->name }}
            </a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card">
                <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/500x600' }}"
                     class="card-img-top" alt="{{ $product->name }}">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">SKU: {{ $product->sku }}</p>

            <div class="mb-3">
                <span class="badge bg-secondary">{{ $product->category->name }}</span>
                @if($product->is_featured)
                    <span class="badge bg-warning">Nổi bật</span>
                @endif
            </div>

            <!-- Price -->
            <div class="mb-4">
                @if($product->has_discount)
                    <h3 class="text-danger">{{ number_format($product->sale_price) }}₫</h3>
                    <p class="text-muted text-decoration-line-through">{{ number_format($product->price) }}₫</p>
                    <span class="badge bg-danger">Giảm {{ $product->discount_percent }}%</span>
                @else
                    <h3 class="text-primary">{{ number_format($product->price) }}₫</h3>
                @endif
            </div>

            <!-- Stock -->
            <div class="mb-3">
                @if($product->isInStock())
                    <p class="text-success">
                        <i class="fas fa-check-circle"></i> Còn hàng ({{ $product->stock }} sản phẩm)
                    </p>
                @else
                    <p class="text-danger">
                        <i class="fas fa-times-circle"></i> Hết hàng
                    </p>
                @endif
            </div>

            <!-- Description -->
            <div class="mb-4">
                <h5>Mô tả sản phẩm</h5>
                <p>{{ $product->description ?? 'Chưa có mô tả' }}</p>
            </div>

            <!-- Add to Cart Form -->
            @if($product->isInStock())
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control"
                                   value="1" min="1" max="{{ $product->stock }}">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Tiếp tục mua
                        </a>
                    </div>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-times"></i> Hết hàng
                </button>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4">Sản phẩm liên quan</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="card product-card h-100 position-relative">
                            @if($relatedProduct->has_discount)
                                <span class="badge badge-sale">-{{ $relatedProduct->discount_percent }}%</span>
                            @endif

                            <img src="{{ $relatedProduct->image ? asset($relatedProduct->image) : 'https://via.placeholder.com/300x400' }}"
                                 class="card-img-top" alt="{{ $relatedProduct->name }}"
                                 style="height: 250px; object-fit: cover;">

                            <div class="card-body">
                                <h6 class="card-title">{{ $relatedProduct->name }}</h6>

                                <div>
                                    @if($relatedProduct->has_discount)
                                        <span class="text-danger fw-bold">{{ number_format($relatedProduct->sale_price) }}₫</span>
                                    @else
                                        <span class="fw-bold">{{ number_format($relatedProduct->price) }}₫</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
