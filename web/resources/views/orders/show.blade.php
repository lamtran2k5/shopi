@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng - MyShoppi')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Success Message -->
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle fa-3x mb-3"></i>
                <h4>Đặt hàng thành công!</h4>
                <p class="mb-0">Cảm ơn bạn đã mua hàng tại MyShoppi</p>
            </div>

            <!-- Order Info -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Mã đơn hàng:</strong> {{ $order->order_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Trạng thái:</strong>
                            <span class="badge bg-{{ $order->status_color }}">
                                {{ trans('orders.status.' . $order->status) ?? ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Thanh toán:</strong>
                            <span class="badge bg-{{ $order->payment_status_color }}">
                                {{ $order->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <strong>Phương thức thanh toán:</strong>
                            @switch($order->payment_method)
                                @case('COD')
                                    Thanh toán khi nhận hàng
                                    @break
                                @case('bank_transfer')
                                    Chuyển khoản ngân hàng
                                    @break
                                @case('momo')
                                    Ví MoMo
                                    @break
                                @case('vnpay')
                                    VNPAY
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin người nhận</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                    <p class="mb-1"><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                    @if($order->customer_email)
                        <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                    @endif
                    <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    @if($order->note)
                        <p class="mb-0"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Sản phẩm đã đặt</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                            {{ $item->product_name }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ number_format($item->price) }}₫</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->total) }}₫</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Tạm tính:</strong></td>
                                <td class="text-end">{{ number_format($order->subtotal) }}₫</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Phí vận chuyển:</strong></td>
                                <td class="text-end">{{ number_format($order->shipping_fee) }}₫</td>
                            </tr>
                            <tr class="table-primary">
                                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td class="text-end"><strong class="text-danger">{{ number_format($order->total_amount) }}₫</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                </a>
                <a href="{{ route('orders.my') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-list"></i> Xem đơn hàng của tôi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
