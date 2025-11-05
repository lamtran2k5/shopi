@extends('layouts.admin')

@section('title', 'Dashboard - Admin MyShoppi')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Tổng đơn hàng</p>
                        <h3 class="mb-0">{{ $totalOrders }}</h3>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Người dùng</p>
                        <h3 class="mb-0">{{ $totalUsers }}</h3>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Thêm hai card bị rớt -->
    <div class="col-md-3">
        <div class="card stat-card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Doanh thu</p>
                        <h3 class="mb-0">{{ number_format($totalRevenue / 1000000, 1) }}M</h3>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-dollar-sign fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Sản phẩm</p>
                        <h3 class="mb-0">{{ $totalProducts }}</h3>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-box fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end .row g-4 -->

<!-- Alerts -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="alert alert-warning">
            <i class="fas fa-clock"></i>
            <strong>{{ $pendingOrders }}</strong> đơn hàng đang chờ xử lý
            <a href="{{ route('admin.orders.index') }}?status=pending" class="alert-link float-end">Xem ngay</a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>{{ $lowStockProducts }}</strong> sản phẩm sắp hết hàng
            <a href="{{ route('admin.products.index') }}" class="alert-link float-end">Kiểm tra</a>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Đơn hàng gần đây</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>
                                        {{ $order->customer_name }}
                                        @if($order->user)
                                            <br><small class="text-muted">{{ $order->user->email }}</small>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ number_format($order->total_amount) }}₫</td>
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
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
