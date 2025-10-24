<?php

namespace App\Http\Controllers;

use App\Models\OrderComment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderCommentController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);

        if (Auth::user()->ID_User_Role == 2 && $order->ID_User != Auth::id()) {
            return redirect()->back()->with('error', 'У вас нет доступа к этому заказу');
        }

        $comment = new OrderComment();
        $comment->ID_Order = $orderId;
        $comment->ID_User = Auth::id();
        $comment->Comment_Text = $request->comment;
        $comment->Created_at = now();
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий добавлен!');
    }

    public function destroy($commentId)
    {
        $comment = OrderComment::findOrFail($commentId);

        if ($comment->ID_User != Auth::id() && Auth::user()->ID_User_Role != 1) {
            return redirect()->back()->with('error', 'Вы не можете удалить этот комментарий');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Комментарий удалён!');
    }
}
