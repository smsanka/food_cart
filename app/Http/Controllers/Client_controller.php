<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TempItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\List_;

class Client_controller extends Controller
{
    public function roleDevider()
    {
    }

    public function index()
    {
        return redirect('login');
    }

    public function clientPage()
    {
        $total = 0.0;
        $items = Item::all();
        $tempTtem =  DB::select('select * from temp_items where user = ?', [Auth::user()->id]);

        $a = array();
        foreach ($tempTtem as $key => $tItem) {
            $itemId = $tItem->item;
            $item = Item::find($itemId);


            $a[$key + 1][0] = $item->name;
            $a[$key + 1][1] = $item->itemimage;
            $a[$key + 1][2] = $item->price;
            $a[$key + 1][3] = $tItem->qty; //qty
            $a[$key + 1][4] = $a[$key + 1][2] * $a[$key + 1][3]; //sub total
            $a[$key + 1][5] = $tItem->id; //qty
            $total += $a[$key + 1][4];
        }



        return view('pages.client.index', compact('items', 'a', 'total'));
    }


    public function deleteItem($id)
    {
        $tempItem = TempItem::find($id);
        $tempItem->delete();

        return redirect()->back();
    }


    public function newOrder($user)
    {
        DB::select('delete from temp_items where user = ?', [$user]);
        return redirect()->back();
    }

    public function placeOrder($user)
    {
        $tempTtem =  DB::select('select * from temp_items where user = ?', [Auth::user()->id]);
        $total = 0;

        foreach ($tempTtem as $key => $value) {
            $total += $value->price;
        }

        Order::create([
            'status' => 'pending',
            'total' => $total,
        ]);

        $last_id = DB::getPdo()->lastInsertId(); //current inserted row id

        foreach ($tempTtem as $key => $value) {
            OrderItem::create([
                'order_id' => $last_id,
                'item_id' => $value->item,
                'qty' => $value->qty,
                'price' => $value->price,
            ]);
        }
        DB::select('delete from temp_items where user = ?', [$user]);
        return redirect()->back();
    }
}
