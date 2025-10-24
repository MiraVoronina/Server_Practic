<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Equipment;
use App\Models\Brand;
use App\Models\TypeOfEquipment;
use App\Models\TypeOfBreakdown;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('ID_User', Auth::id())
            ->with(['status', 'equipment', 'breakdown']);

        if ($request->filled('tracking_number')) {
            $query->where('Tracking_Number', 'like', '%' . $request->tracking_number . '%');
        }

        if ($request->filled('status')) {
            $query->where('ID_Status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('Created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('Created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('Created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $equipmentTypes = TypeOfEquipment::all();
        $brands = Brand::all();
        $breakdowns = TypeOfBreakdown::all();

        return view('orders.create', compact('equipmentTypes', 'brands', 'breakdowns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_type_id' => 'required|integer|min:1',
            'brand_id' => 'required|integer|min:1',
            'equipment_name' => 'required|string|min:3|max:150|regex:/^[а-яА-ЯёЁa-zA-Z0-9\s\-_.]+$/u',
            'breakdown_id' => 'required|integer|min:1',
            'description' => 'required|string|min:10|max:1000',
            'photo' => 'nullable|max:5120',
        ], [
            'equipment_type_id.required' => 'Выберите тип оборудования',
            'equipment_type_id.integer' => 'Выберите корректный тип оборудования',
            'equipment_type_id.min' => 'Выберите корректный тип оборудования',

            'brand_id.required' => 'Выберите бренд',
            'brand_id.integer' => 'Выберите корректный бренд',
            'brand_id.min' => 'Выберите корректный бренд',

            'equipment_name.required' => 'Название оборудования обязательно',
            'equipment_name.min' => 'Название должно содержать минимум 3 символа',
            'equipment_name.max' => 'Название не может превышать 150 символов',
            'equipment_name.regex' => 'Название может содержать буквы, цифры, пробелы и символы: - _ .',

            'breakdown_id.required' => 'Выберите тип поломки',
            'breakdown_id.integer' => 'Выберите корректный тип поломки',
            'breakdown_id.min' => 'Выберите корректный тип поломки',

            'description.required' => 'Описание проблемы обязательно',
            'description.min' => 'Описание должно содержать минимум 10 символов',
            'description.max' => 'Описание не может превышать 1000 символов',

            'photo.max' => 'Размер файла не должен превышать 5 МБ',
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
            'ID_Type_Of_Equipment' => $request->equipment_type_id,
            'ID_Brand' => $request->brand_id,
            'Serial_Number' => 'SN-' . strtoupper(uniqid()),
            'Equipment_Name' => $request->equipment_name,
            'Description' => $request->description,
        ]);

        $maxOrderNumber = Order::where('ID_User', Auth::id())->max('Order_Number');
        $orderNumber = ($maxOrderNumber ?? 0) + 1;
        $trackingNumber = 'ORD-' . date('Y') . '-' . Auth::id() . '-' . time() . '-' . rand(100, 999);

        Order::create([
            'ID_User' => Auth::id(),
            'ID_Equipment' => $equipment->ID_Equipment,
            'ID_Type_Of_Breakdown' => $request->breakdown_id,
            'ID_Status' => 1,
            'Description' => $request->description,
            'Tracking_Number' => $trackingNumber,
            'Order_Number' => $orderNumber,
            'Equipment_Photo' => $photoPath,
        ]);

        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан!');
    }

    public function show($id)
    {
        if (Auth::user()->ID_User_Role == 1) {
            $order = Order::where('ID_Order', $id)
                ->with(['status', 'equipment', 'breakdown', 'user'])
                ->firstOrFail();
        } else {
            $order = Order::where('ID_User', Auth::id())
                ->where('ID_Order', $id)
                ->with(['status', 'equipment', 'breakdown'])
                ->firstOrFail();
        }

        $statuses = OrderStatus::all();

        return view('orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if (Auth::user()->ID_User_Role != 1) {
            abort(403, 'Доступ запрещен');
        }

        $validated = $request->validate([
            'status' => 'required|exists:order_status,ID_Status'
        ]);

        $order->ID_Status = $validated['status'];
        $order->save();

        return redirect()->back()->with('success', 'Статус заказа обновлен!');
    }

    public function destroy($id)
    {
        if (Auth::user()->ID_User_Role == 1) {
            $order = Order::where('ID_Order', $id)->firstOrFail();
        } else {
            $order = Order::where('ID_User', Auth::id())
                ->where('ID_Order', $id)
                ->firstOrFail();
        }

        if ($order->Equipment_Photo) {
            $photoPath = public_path('uploads/equipment/' . $order->Equipment_Photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно удалён!');
    }
}
