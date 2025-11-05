@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng - Admin')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Order Info -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Đơn hàng #{{ $order->order_number }}</h5>
                <span class="badge bg-{{ $order->status_color }}">
                    @switch($order->status)
                        @case('pending') Chờ xử lý @break
                        @case('processing') Đang xử lý @break
                        @case('shipped') Đang giao @break
                        @case('delivered') Đã giao @break
                        @case('cancelled') Đã hủy @break
                    @endswitch
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Phương thức thanh toán:</strong>
                            @switch($order->payment_method)
                                @case('COD') Thanh toán khi nhận hàng @break
                                @case('bank_transfer') Chuyển khoản ngân hàng @break
                                @case('momo') Ví MoMo @break
                                @case('vnpay') VNPAY @break
                            @endswitch
                        </p>
                    </div>
                </div>

                @if($order->note)
                    <div class="alert alert-info">
                        <strong>Ghi chú:</strong> {{ $order->note }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Thông tin khách hàng</h5>
            </div>
            <div class="card-body">
                <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                @if($order->customer_email)
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                @endif
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>

                @if($order->user)
                    <hr>
                    <p class="mb-0">
                        <strong>Tài khoản:</strong>
                        <a href="{{ route('admin.users.show', $order->user->id) }}">
                            {{ $order->user->email }}
                        </a>
                    </p>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Sản phẩm đã đặt</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center" style="width: 120px;">Đơn giá</th>
                            <th class="text-center" style="width: 100px;">Số lượng</th>
                            <th class="text-end" style="width: 120px;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $item->product->slug) }}" target="_blank">
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
                            <td class="text-end">
                                <strong class="text-danger fs-5">{{ number_format($order->total_amount) }}₫</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions Sidebar -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cập nhật trạng thái</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Trạng thái đơn hàng</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                Chờ xử lý
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                Đang xử lý
                            </option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                Đang giao hàng
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                Đã giao hàng
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                Đã hủy
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Cập nhật trạng thái
                    </button>
                </form>

                <hr>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Lịch sử đơn hàng</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <i class="fas fa-check-circle text-success"></i>
                        <div>
                            <strong>Đơn hàng đã tạo</strong>
                            <br>
                            <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>

                    @if($order->status != 'pending')
                        <div class="timeline-item">
                            <i class="fas fa-clock text-info"></i>
                            <div>
                                <strong>Đang xử lý</strong>
                            </div>
                        </div>
                    @endif

                    @if(in_array($order->status, ['shipped', 'delivered']))
                        <div class="timeline-item">
                            <i class="fas fa-shipping-fast text-primary"></i>
                            <div>
                                <strong>Đang giao hàng</strong>
                            </div>
                        </div>
                    @endif

                    @if($order->status == 'delivered')
                        <div class="timeline-item">
                            <i class="fas fa-check-double text-success"></i>
                            <div>
                                <strong>Đã giao hàng</strong>
                            </div>
                        </div>
                    @endif

                    @if($order->status == 'cancelled')
                        <div class="timeline-item">
                            <i class="fas fa-times-circle text-danger"></i>
                            <div>
                                <strong>Đơn hàng đã hủy</strong>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: -22px;
        top: 20px;
        width: 2px;
        height: calc(100% - 20px);
        background: #dee2e6;
    }

    .timeline-item i {
        position: absolute;
        left: -30px;
        top: 2px;
        font-size: 1.2rem;
    }
</style>
@endpush
@endsection
