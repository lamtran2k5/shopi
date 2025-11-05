@extends('layouts.app')

@section('title', 'Thanh toán - MyShoppi')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Thanh toán đơn hàng</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror"
                                   value="{{ old('customer_name', auth()->user()->name) }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror"
                                       value="{{ old('customer_phone', auth()->user()->phone) }}" required>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror"
                                       value="{{ old('customer_email', auth()->user()->email) }}">
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
                                      rows="3" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="2"
                                      placeholder="Ghi chú về đơn hàng (tùy chọn)">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method"
                                   id="cod" value="COD" checked>
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave"></i> Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method"
                                   id="bank" value="bank_transfer">
                            <label class="form-check-label" for="bank">
                                <i class="fas fa-university"></i> Chuyển khoản ngân hàng
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method"
                                   id="momo" value="momo">
                            <label class="form-check-label" for="momo">
                                <i class="fas fa-mobile-alt"></i> Ví MoMo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method"
                                   id="vnpay" value="vnpay">
                            <label class="form-check-label" for="vnpay">
                                <i class="fas fa-credit-card"></i> VNPAY
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-5">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @php
                                use App\Models\Product;

                                // Lấy danh sách sản phẩm từ DB dựa trên key của cart (product_id)
                                $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
                            @endphp

                            @if(!empty($cart))
                                @foreach($cart as $productId => $quantity)
                                    @php
                                        $product = $products[$productId] ?? null;
                                    @endphp

                                    @if($product)
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $product->image ? asset($product->image) : asset('images/default.png') }}"
                                                    alt="{{ $product->name }}"
                                                    class="img-thumbnail me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <strong>{{ $product->name }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ number_format($product->final_price) }}₫ x {{ $quantity }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <strong>{{ number_format($product->final_price * $quantity) }}₫</strong>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted fst-italic">Giỏ hàng trống.</p>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($subtotal) }}₫</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span>{{ number_format($shippingFee) }}₫</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Tổng cộng:</span>
                            <span class="h5 text-danger">{{ number_format($total) }}₫</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="fas fa-check"></i> Đặt hàng
                        </button>

                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
