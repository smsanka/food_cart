<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Spatie\Backtrace\File;

class Item_controller extends Parent_controller
{
    public function saveItem(Request $request)
    {
        $request->validate([
            'price' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();


        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'itemImage' => $imageName,
        ]);

        $request->image->move(public_path('images'), $imageName);


        $items =  Item::toBase()->get();

        return view('pages.admin.item', compact('items'));
    }

    public function getItem()
    {
        $items =  Item::toBase()->get();

        return view('pages.admin.item', compact('items'));
    }

    public function findItem($id)
    {
        $items =  Item::find($id);

        return view('pages.admin.updateItem', compact('items'));
    }

    public function deleteItem($id)
    {
        $items =  Item::find($id);

        $filename = 'images/' . $items->itemImage;
        unlink($filename);

        $items->delete();
        $items =  Item::toBase()->get();

        return view('pages.admin.item', compact('items'));
    }

    public function itemUpdater(Request $request, $id)
    {
        $request->validate([
            'price' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $item = Item::find($id);


        $filename = 'images/' . $item->itemImage;
        unlink($filename);


        $item->name = $request->name;
        $item->price = $request->price;
        $item->itemImage = $imageName;
        $item->update();

        $items =  Item::toBase()->get();

        return view('pages.admin.item', compact('items'));
    }
}
