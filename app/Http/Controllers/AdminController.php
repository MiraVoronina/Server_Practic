<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:1']);
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $newOrders = Order::where('ID_Status', 1)->count();
        $inProgressOrders = Order::where('ID_Status', 2)->count();
        $completedOrders = Order::where('ID_Status', 4)->count();
        $totalUsers = User::where('ID_User_Role', 2)->count();

        $recentOrders = Order::with(['user', 'equipment', 'status'])
            ->orderBy('Created_at', 'desc')
            ->limit(10)
            ->get();

        $ordersByStatus = OrderStatus::withCount('orders')
            ->having('orders_count', '>', 0)
            ->get();

        $statuses = OrderStatus::all();

        return view('admin.dashboard', compact(
            'totalOrders',
            'newOrders',
            'inProgressOrders',
            'completedOrders',
            'totalUsers',
            'recentOrders',
            'ordersByStatus',
            'statuses'
        ));
    }

    public function users()
    {
        if (Auth::user()->ID_User_Role != 1) {
            abort(403, 'Доступ запрещен');
        }

        $users = User::with('userInfo')
            ->where('ID_User_Role', 2)
            ->orderBy('ID_User', 'desc')
            ->paginate(20);

        return view('admin.users', compact('users'));
    }
}
