@extends('layouts.app')

@section('title', $category->name . ' - MyShoppi')

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>{{ $category->name }}</h2>
            @if($category->description)
                <p class="text-muted">{{ $category->description }}</p>
            @endif
            <p class="text-muted">Có {{ $products->total() }} sản phẩm</p>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Bộ lọc</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('category', $category->slug) }}" method="GET">
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
                        <a href="{{ route('category', $category->slug) }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-redo"></i> Đặt lại
                        </a>
                    </form>

                    <hr>

                    <!-- All Categories -->
                    <h6>Danh mục khác</h6>
                    <div class="list-group">
                        @foreach($categories as $cat)
                            <a href="{{ route('category', $cat->slug) }}"
                               class="list-group-item list-group-item-action {{ $cat->id == $category->id ? 'active' : '' }}">
                                {{ $cat->name }}
                                <span class="badge bg-secondary float-end">{{ $cat->products->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4 col-sm-6">
                            <div class="card product-card h-100 position-relative">
                                @if($product->has_discount)
                                    <span class="badge badge-sale">-{{ $product->discount_percent }}%</span>
                                @endif

                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $product->name }}</h6>

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
                    <i class="fas fa-info-circle"></i> Không có sản phẩm nào trong danh mục này!
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
