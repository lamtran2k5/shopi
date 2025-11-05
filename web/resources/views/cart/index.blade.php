@extends('layouts.app')

@section('title', 'Giỏ hàng - MyShoppi')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    @if(empty($cart) || count($cart) == 0)
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h4>Giỏ hàng trống</h4>
            <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Mua sắm ngay
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    @php
                                        $quantity = $cart[$product->id];
                                        $subtotal = $product->final_price * $quantity;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $product->image ? asset($product->image) : asset('images/default.png') }}"
                                                    alt="{{ $product->name }}"
                                                    class="img-thumbnail me-3"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                                    <a href="{{ route('products.show', $product->slug) }}" class="small text-primary">
                                                        Xem sản phẩm
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            {{ number_format($product->final_price) }}₫
                                        </td>

                                        <td class="align-middle">
                                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group" style="width: 120px;">
                                                    <input type="number" name="quantity" class="form-control form-control-sm"
                                                        value="{{ $quantity }}" min="1" max="100">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>

                                        <td class="align-middle fw-bold">
                                            {{ number_format($subtotal) }}₫
                                        </td>

                                        <td class="align-middle">
                                            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Xóa sản phẩm này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Tiếp tục mua
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Xóa toàn bộ giỏ hàng?')">
                                    <i class="fas fa-trash"></i> Xóa giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tổng đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span class="fw-bold">{{ number_format($total) }}₫</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span>30,000₫</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Tổng cộng:</span>
                            <span class="h5 text-danger">{{ number_format($total + 30000) }}₫</span>
                        </div>

                        @auth
                            <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg">
                                <i class="fas fa-credit-card"></i> Thanh toán
                            </a>
                        @else
                            <p class="text-muted small mb-2">Vui lòng đăng nhập để thanh toán</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6><i class="fas fa-shield-alt text-success"></i> Cam kết</h6>
                        <ul class="list-unstyled small mb-0">
                            <li><i class="fas fa-check text-success"></i> Hàng chính hãng 100%</li>
                            <li><i class="fas fa-check text-success"></i> Đổi trả trong 7 ngày</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
