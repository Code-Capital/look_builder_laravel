<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LookBuilderProduct;
use App\Models\Order;
use App\Models\Suit;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        return view('admin.pages.orders.all', compact('orders'));
    }
    public function landing()
    {
        try {
            $orders = Order::all()->count();
            $customers = User::role('user')->get()->count();
            $lookBuilderProducts = LookBuilderProduct::all()->count();
            $suits = Suit::all()->count();

            return view('admin.pages.index', compact('orders', 'customers', 'lookBuilderProducts', 'suits'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
            return view('admin.pages.orders.details', compact('orderProducts', 'order'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function markAsDelivered($order_uuid)
    {
        try {
            DB::beginTransaction();
            $order = Order::where('uuid', $order_uuid)->first();
            $order->update([
                'id' => $order->id,
                'isDelivered' => 1,
            ]);
            DB::commit();
            return redirect(route('orders'))->with(['status' => true, 'message' => 'Mark as delivered']);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return redirect(route('orders'))->with(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with(['status' => true, 'message' => 'Logged out successfully']);
    }
}
