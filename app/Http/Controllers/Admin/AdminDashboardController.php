<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\DataTables\TodayOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(TodayOrderDataTable $dataTable) : View|JsonResponse{
        $todayOrder = Order::whereDate('created_at', now()->format('Y-m-d'))->count();
        $todayEarning = Order::whereDate('created_at', now()->format('Y-m-d'))->where('order_status', 'delivered')->sum('grand_total');
        $monthlyOrder = Order::whereMonth('created_at', now()->month)->count();
        $monthlyEarning = Order::whereMonth('created_at', now()->month)->where('order_status', 'delivered')->sum('grand_total');
        $yearlyOrder = Order::whereYear('created_at', now()->year)->count();
        $yearlyEarning = Order::whereYear('created_at', now()->year)->where('order_status', 'delivered')->sum('grand_total');
        $totalOrder = Order::count();
        $totalEarning = Order::where('order_status', 'delivered')->sum('grand_total');
        $totalUser = User::where('role', 'user')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalProduct = Product::count();
        return $dataTable->render('admin.dashboard.index',
            compact([
                'todayOrder',
                'todayEarning',
                'monthlyOrder',
                'monthlyEarning',
                'yearlyOrder',
                'yearlyEarning',
                'totalOrder',
                'totalEarning',
                'totalUser',
                'totalAdmin',
                'totalProduct',
            ])
        );
    }
}
