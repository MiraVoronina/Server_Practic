<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    public function update(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|exists:Order_Status,ID_Status',
        ]);

        if (Auth::user()->ID_User_Role != 1) {
            return redirect()->back()->with('error', 'У вас нет прав для изменения статуса');
        }

        $order = Order::where('ID_Order', $orderId)->firstOrFail();
        $oldStatus = $order->status->Order_Status_Name;
        $order->ID_Status = $request->status;
        $order->save();

        $newStatus = $order->status->Order_Status_Name;

        if ($order->ID_User) {
            Notification::create([
                'ID_User' => $order->ID_User,
                'ID_Order' => $order->ID_Order,
                'Title' => 'Изменен статус заказа №' . $order->Order_Number,
                'Message' => 'Статус вашего заказа изменен с "' . $oldStatus . '" на "' . $newStatus . '"'
            ]);
        }

        return redirect()->back()->with('success', 'Статус заказа обновлён!');
    }
}
