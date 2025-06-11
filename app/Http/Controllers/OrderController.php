<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Show the order form.
     */
    public function showOrderForm()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.orders')->with('error', 'Администраторы не могут создавать заявки');
        }
        
        $furnitures = Furniture::all();
        return view('orders.create', compact('furnitures'));
    }

    /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.orders')->with('error', 'Администраторы не могут создавать заявки');
        }
        
        $validator = Validator::make($request->all(), [
            'furniture_id' => 'required|exists:furnitures,id',
            'count' => 'required|integer|min:1|max:10',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'payment' => 'required|in:cash,card,bank_transfer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $furniture = Furniture::findOrFail($request->furniture_id);

        $order = Order::create([
            'furniture_id' => $request->furniture_id,
            'count' => $request->count,
            'date' => $request->date,
            'time' => $request->time,
            'payment' => $request->payment,
            'type' => $furniture->title,
            'user_id' => Auth::id(),
        ]);

        $totalPrice = $order->getTotalPrice();

        return redirect()->route('orders.success', ['order' => $order->id])
            ->with('success', "Ваша заявка принята! Вы выбрали ремонт {$furniture->title} в количестве {$request->count} на общую сумму {$totalPrice} рублей");
    }

    /**
     * Show the order success page.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    /**
     * Show user's orders.
     */
    public function userOrders()
    {
        $orders = Auth::user()->orders()->with('furniture')->latest()->get();
        return view('orders.user', compact('orders'));
    }

    /**
     * Show all orders (admin only).
     */
    public function adminOrders()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $orders = Order::with(['user', 'furniture'])->latest()->get();
        return view('orders.admin', compact('orders'));
    }
}
