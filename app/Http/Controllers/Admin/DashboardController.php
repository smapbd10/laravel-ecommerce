<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin_only');
    }

    public function index()
    {
        $stats = [
            'total_revenue' => Order::sum('total_amount'),
            'total_orders' => Order::count(),
            'total_customers' => User::where('type', 'customer')->count(),
            'total_products' => Product::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_products' => Product::whereRaw('stock <= low_stock_threshold')->count(),
        ];

        $recent_orders = Order::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
