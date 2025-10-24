<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Equipment;
use App\Models\TypeOfBreakdown;
use App\Models\TypeOfEquipment;
use App\Models\Brand;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        if (Auth::user()->ID_User_Role != 1) {
            abort(403, 'Доступ запрещен');
        }

        $users = User::where('ID_User_Role', 2)
            ->with('userInfo')
            ->orderBy('ID_User', 'desc')
            ->get();

        $equipmentTypes = TypeOfEquipment::all();
        $brands = Brand::all();
        $breakdowns = TypeOfBreakdown::all();

        return view('admin.orders.create', compact('users', 'equipmentTypes', 'brands', 'breakdowns'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->ID_User_Role != 1) {
            abort(403, 'Доступ запрещен');
        }

        $validated = $request->validate([
            'order_type' => 'required|in:existing,guest',
            'user_id' => 'required_if:order_type,existing|nullable|exists:users,ID_User',
            'guest_name' => 'required_if:order_type,guest|nullable|max:255',
            'guest_phone' => 'required_if:order_type,guest|nullable|max:20',
            'guest_email' => 'nullable|email|max:100',
            'equipment_type_id' => 'nullable|exists:type_of_equipment,ID_Equipment',
            'brand_id' => 'nullable|exists:brands,ID_Brand',
            'equipment_name' => 'required|string|max:150',
            'breakdown_id' => 'nullable',
            'description' => 'required',
            'photo' => 'nullable'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadDir = public_path('uploads/equipment');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file->move($uploadDir, $filename);
            $photoPath = $filename;
        }

        $equipment = Equipment::create([
            'ID_Type_Of_Equipment' => $validated['equipment_type_id'] ?? 1,
            'ID_Brand' => $validated['brand_id'] ?? 1,
            'Serial_Number' => 'SN-' . strtoupper(uniqid()),
            'Equipment_Name' => $validated['equipment_name'],
            'Description' => $validated['description'],
        ]);

        $trackingNumber = 'ORD-' . date('Y') . '-' . time() . '-' . rand(100, 999);

        $lastOrder = Order::orderBy('ID_Order', 'desc')->first();
        $orderNumber = $lastOrder ? $lastOrder->Order_Number + 1 : 1;

        $orderData = [
            'ID_Equipment' => $equipment->ID_Equipment,
            'ID_Type_Of_Breakdown' => $validated['breakdown_id'] ?? 1,
            'ID_Status' => 1,
            'Description' => $validated['description'],
            'Created_at' => now(),
            'Equipment_Photo' => $photoPath,
            'Tracking_Number' => $trackingNumber,
            'Order_Number' => $orderNumber
        ];

        if ($validated['order_type'] === 'existing') {
            $orderData['ID_User'] = $validated['user_id'];
        } else {
            $orderData['ID_User'] = null;
            $orderData['Guest_Name'] = $validated['guest_name'];
            $orderData['Guest_Phone'] = $validated['guest_phone'];
            $orderData['Guest_Email'] = $validated['guest_email'] ?? null;
        }

        Order::create($orderData);

        return redirect()->route('admin.dashboard')->with('success', 'Заказ успешно создан!');
    }

    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->ID_User_Role != 1) {
            abort(403, 'Доступ запрещен');
        }

        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|exists:Order_Status,ID_Status'
        ]);

        $order->ID_Status = $validated['status'];
        $order->save();

        return redirect()->back()->with('success', 'Статус заказа обновлен!');
    }
}
