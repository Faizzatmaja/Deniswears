<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalRevenue = Order::where('status', '!=', 'dibatalkan')->sum('total');
        
        // Orders this month
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)->count();
        $ordersToday = Order::whereDate('created_at', today())->count();
        
        // All Orders dengan pagination
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'ordersThisMonth',
            'ordersToday',
            'orders'
        ));
    }
}