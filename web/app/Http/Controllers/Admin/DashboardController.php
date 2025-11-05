<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();

        // Pending orders
        $pendingOrders = Order::where('status', 'pending')->count();

        // Low stock products
        $lowStockProducts = Product::where('stock', '<', 10)->count();

        // Recent orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Monthly revenue (last 6 months)
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->where('status', '!=', 'cancelled')
            ->groupBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalUsers',
            'pendingOrders',
            'lowStockProducts',
            'recentOrders',
            'monthlyRevenue'
        ));
    }
}
