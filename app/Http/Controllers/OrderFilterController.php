<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderFilterController extends Controller
{
    public function filter(Request $request)
    {
        if (Auth::user()->ID_User_Role == 1) {
            $query = Order::with(['status', 'equipment', 'breakdown', 'user']);
        } else {
            $query = Order::where('ID_User', Auth::id())
                ->with(['status', 'equipment', 'breakdown']);
        }

        if ($request->filled('status')) {
            $query->where('ID_Status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('Tracking_Number', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $q->orWhere('Order_Number', (int)$search)
                        ->orWhere('ID_Order', (int)$search);
                }

                if (Auth::user()->ID_User_Role == 1) {
                    $q->orWhereHas('user', function($userQuery) use ($search) {
                        $userQuery->where('Login', 'like', "%{$search}%");
                    });
                }
            });
        }

        $sortBy = $request->get('sort', 'date_desc');
        if ($sortBy == 'date_desc') {
            $query->orderBy('Created_at', 'desc');
        } else {
            $query->orderBy('Created_at', 'asc');
        }

        $orders = $query->get();
        $statuses = OrderStatus::all();

        return view('orders.index', compact('orders', 'statuses'));
    }
}
