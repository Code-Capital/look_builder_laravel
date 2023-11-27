<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        return view('admin.pages.orders.all', compact('orders'));
    }
    public function customers()
    {
        try {
            $users = User::role('user')->get();
            return view('admin.pages.customers.all', compact('users'));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'something went wrong'
            ]);
        }
    }
    public function orderDetails($order_uuid)
    {
        try {
            $order = Order::where('uuid', $order_uuid)->first();
            $orderProducts = $order->orderProducts;
            dd($orderProducts);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
