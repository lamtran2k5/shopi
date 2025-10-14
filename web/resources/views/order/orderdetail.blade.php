@extends('layouts.app')
@section('title', $title)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/orderdetail.css') }}">
@endsection

@section('content')
<div class="order-container">
    <div class="order-title">Chi tiết đơn hàng</div>

    {{-- Thông tin người dùng --}}
    <div class="info-section">
        <h3>Thông tin người mua</h3>
        <div class="info-item">Tên: <span>{{ $user->full_name ?? 'Không xác định' }}</span></div>
        <div class="info-item">Địa chỉ: <span>{{ $user->address ?? 'Không có' }}</span></div>
        <div class="info-item">Sđt: <span>{{ $user->sdt ?? 'Không có' }}</span></div>
    </div>

    {{-- Thông tin sản phẩm --}}
    <div class="info-section">
        <h3>Thông tin sản phẩm</h3>
        <div class="info-item">Tên sản phẩm: <span id="product-name">{{ $product->name }}</span></div>
        <div class="info-item">Giá 1 sản phẩm: 
            <span id="product-price" data-price="{{ $product->price }}">
                {{ number_format($product->price) }} VNĐ
            </span>
        </div>
        @if($product->image)
            <div class="info-item">
                <img src="{{ asset('/img/'.$product->image) }}" 
                     alt="Hình sản phẩm" 
                     style="width:150px; border-radius:10px; margin-top:10px;">
            </div>
        @endif

        {{-- Số lượng sản phẩm --}}
        <div class="info-item">
            <label for="quantity">Số lượng:</label>
            <div class="quantity-control">
                <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">−</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="quantity-input" readonly>
                <button type="button" class="quantity-btn" onclick="changeQuantity(1)">+</button>
            </div>
        </div>

        {{-- Tổng giá --}}
        <div class="info-item">
            Tổng giá: <span id="total-price">{{ number_format($product->price) }}</span> VNĐ
        </div>
    </div>

    {{-- Thông tin shop --}}
    <div class="info-section">
        <h3>Thông tin cửa hàng</h3>
        <div class="info-item">Tên shop: <span>{{ $shop->full_name ?? 'Không xác định' }}</span></div>
        <div class="info-item">Email shop: <span>{{ $shop->email ?? 'Không có' }}</span></div>
        <div class="info-item">Sđt shop: <span>{{ $shop->sdt ?? 'Không có' }}</span></div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị thông báo lỗi --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Nút xác nhận --}}
    <form action="{{ route('order.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <input type="hidden" name="total_price" id="total-hidden" value="{{ $product->price }}">
        <button type="submit" class="confirm-btn">Xác nhận mua</button>
    </form>
</div>

{{-- JavaScript tăng giảm số lượng + tính tổng --}}
<script>
function changeQuantity(change) {
    const input = document.getElementById('quantity');
    const hiddenQuantity = document.getElementById('quantity-hidden');
    const priceElement = document.getElementById('product-price');
    const totalDisplay = document.getElementById('total-price');
    const totalHidden = document.getElementById('total-hidden');

    const unitPrice = parseInt(priceElement.getAttribute('data-price'));
    let quantity = parseInt(input.value) + change;

    if (quantity < 1) quantity = 1;
    input.value = quantity;
    hiddenQuantity.value = quantity;

    const total = unitPrice * quantity;
    totalDisplay.textContent = total.toLocaleString('vi-VN');
    totalHidden.value = total;
}
</script>
@endsection
