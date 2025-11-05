@extends('layouts.admin')

@section('title', 'Chi tiết người dùng - Admin')
@section('page-title', 'Chi tiết người dùng')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- User Info -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thông tin người dùng</h5>
                @if($user->role == 'admin')
                    <span class="badge bg-danger">Admin</span>
                @else
                    <span class="badge bg-primary">User</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>ID:</strong></div>
                    <div class="col-md-9">{{ $user->id }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Họ tên:</strong></div>
                    <div class="col-md-9">{{ $user->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Email:</strong></div>
                    <div class="col-md-9">{{ $user->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Số điện thoại:</strong></div>
                    <div class="col-md-9">{{ $user->phone ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Địa chỉ:</strong></div>
                    <div class="col-md-9">{{ $user->address ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Ngày đăng ký:</strong></div>
                    <div class="col-md-9">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Orders History -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lịch sử đơn hàng ({{ $user->orders->count() }})</h5>
            </div>
            <div class="card-body">
                @if($user->orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td><strong>{{ $order->order_number }}</strong></td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
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
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">Chưa có đơn hàng nào</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Actions -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thao tác</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning w-100 mb-2">
                    <i class="fas fa-edit"></i> Sửa thông tin
                </a>

                @if($user->id != auth()->id())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 mb-2"
                                onclick="return confirm('Xóa người dùng này?')">
                            <i class="fas fa-trash"></i> Xóa người dùng
                        </button>
                    </form>
                @endif

                <hr>

                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Thống kê</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Tổng đơn hàng:</strong>
                    <span class="float-end badge bg-primary">{{ $user->orders->count() }}</span>
                </div>

                <div class="mb-3">
                    <strong>Tổng chi tiêu:</strong>
                    <span class="float-end text-danger fw-bold">
                        {{ number_format($user->orders->sum('total_amount')) }}₫
                    </span>
                </div>

                <div>
                    <strong>Đơn thành công:</strong>
                    <span class="float-end badge bg-success">
                        {{ $user->orders->where('status', 'delivered')->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
