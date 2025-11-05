@extends('layouts.app')

@section('title', 'Đơn hàng của tôi - MyShoppi')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Đơn hàng của tôi</h2>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->order_number }}</strong>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold text-danger">{{ number_format($order->total_amount) }}₫</td>
                            <td>
                                <span class="badge bg-{{ $order->status_color }}">
                                    @switch($order->status)
                                        @case('pending') Chờ xử lý @break
                                        @case('processing') Đang xử lý @break
                                        @case('shipped') Đang giao @break
                                        @case('delivered') Đã giao @break
                                        @case('cancelled') Đã hủy @break
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
            <h4>Chưa có đơn hàng nào</h4>
            <p class="text-muted">Hãy mua sắm và tạo đơn hàng đầu tiên của bạn!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Mua sắm ngay
            </a>
        </div>
    @endif
</div>
@endsection
