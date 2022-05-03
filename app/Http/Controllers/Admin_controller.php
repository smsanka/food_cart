<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin_controller extends controller
{
    public function index()
    {
        if (Auth::user()->role == 'waiter') {
            $total = 0.0;
            $items = Item::all();
            $tempTtem =  DB::select('select * from temp_items where user = ?', [Auth::user()->id]);

            $a = array();
            foreach ($tempTtem as $key => $tItem) {
                $itemId = $tItem->item;
                $item = Item::find($itemId);


                $a[$key + 1][0] = $item->name;
                $a[$key + 1][1] = $item->itemImage;
                $a[$key + 1][2] = $item->price;
                $a[$key + 1][3] = $tItem->qty; //qty
                $a[$key + 1][4] = $a[$key + 1][2] * $a[$key + 1][3]; //sub total
                $a[$key + 1][5] = $tItem->id; //qty
                $total += $a[$key + 1][4];
            }



            return view('pages.client.index', compact('items', 'a', 'total'));
        }

        $orders = Order::orderBy('id', 'DESC')->get();
        return view('pages.admin.index', compact('orders'));
    }

    public function item()
    {
        $items =  Item::toBase()->get();

        return view('pages.admin.item', compact('items'));
    }

    public function profile()
    {
        $user =  User::toBase()->get();
        return view('pages.admin.profile', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        $user =  User::toBase()->get();
        return view('pages.admin.profile', compact('user'));
    }

    public function updateUser($id)
    {
        $user = User::find($id);
        return view('pages.admin.updateUser', compact('user'));
    }
    public function updaterUser(request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $hashPass = Hash::make($request->password);

        if ($request->password != "") {
            $user->password = $hashPass;
        }

        $user->update();

        $user =  User::toBase()->get();
        return view('pages.admin.profile', compact('user'));
    }

    public function orderConfirm($order)
    {
        $orderId = $order;
        $orderItem =  DB::select('select * from order_items where order_id = ?', [$order]); //get all order item according to order_id
        $total = 0;
        $a = array();
        foreach ($orderItem as $key => $tItem) {
            $itemId = $tItem->item_id;
            $item = Item::find($itemId);


            $a[$key + 1][0] = $item->name; //ITEM
            $a[$key + 1][1] = $item->itemimage; //IMAGE
            $a[$key + 1][2] = $item->price; //PRICE
            $a[$key + 1][3] = $tItem->qty; //qty
            $a[$key + 1][4] = $a[$key + 1][2] * $a[$key + 1][3]; //sub total
            $total += $a[$key + 1][4];
        }


        return view('pages.admin.orderConfirm', compact('a', 'total', 'orderId'));
    }

    public function orderDelete($order)
    {
        $o = Order::find($order);
        $o->delete();
        DB::select('delete from order_items where order_id = ?', [$order]);
        return redirect()->back();
    }
    public function orderComplete($order)
    {
        $order = Order::find($order);
        $order->status = 'complete';

        $order->update();
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('pages.admin.index', compact('orders'));
    }
}
