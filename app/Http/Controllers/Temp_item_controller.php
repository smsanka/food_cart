<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TempItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Temp_item_controller extends Controller
{
    public function findItem(Request $request, $id)
    {
        $item = Item::find($id);

        TempItem::create([
            'user' => Auth::user()->id,
            'item' => $id,
            'qty' => $request->qty,
            'price' =>  $item->price,
        ]);

        return redirect()->back();
    }
}
