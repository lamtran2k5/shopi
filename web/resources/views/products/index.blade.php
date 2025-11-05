@extends('layouts.app')

@section('title', 'Sản phẩm - MyShoppi')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Tất cả sản phẩm</h2>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Bộ lọc</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <!-- Search -->
                        <div class="mb-3">
                            <label class="form-label">Tìm kiếm</label>
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}" placeholder="Tên sản phẩm...">
                        </div>
                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select name="category" class="form-select">
                                <option value="">Tất cả</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort -->
                        <div class="mb-3">
                            <label class="form-label">Sắp xếp</label>
                            <select name="sort" class="form-select">
                                <option value="">Mới nhất</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Giá: Thấp đến cao
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Giá: Cao đến thấp
                                </option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                    Tên A-Z
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Lọc
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-redo"></i> Đặt lại
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted">Hiển thị {{ $products->count() }} / {{ $products->total() }} sản phẩm</p>
            </div>

            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4 col-sm-6">
                            <div class="card product-card h-100 position-relative">
                                @if($product->has_discount)
                                    <span class="badge badge-sale">-{{ $product->discount_percent }}%</span>
                                @endif

                                <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/300x400' }}"
                                     class="card-img-top" alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">

                                <div class="card-body">
                                    <h6 class="card-title">{{ $product->name }}</h6>
                                    <p class="text-muted small">{{ $product->category->name }}</p>

                                    <div class="mb-2">
                                        @if($product->has_discount)
                                            <span class="text-danger fw-bold">{{ number_format($product->sale_price) }}₫</span>
                                            <small class="text-muted text-decoration-line-through d-block">
                                                {{ number_format($product->price) }}₫
                                            </small>
                                        @else
                                            <span class="fw-bold">{{ number_format($product->price) }}₫</span>
                                        @endif
                                    </div>

                                    <small class="text-muted">
                                        <i class="fas fa-box"></i> Còn {{ $product->stock }} sản phẩm
                                    </small>
                                </div>

                                <div class="card-footer bg-white border-0">
                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Không tìm thấy sản phẩm nào!
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
