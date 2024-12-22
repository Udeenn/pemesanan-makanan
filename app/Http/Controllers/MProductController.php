<?php

namespace App\Http\Controllers;

use App\Models\M_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MProductController extends Controller
{

    public function index(){
        $products = M_Product::all();
        return view('admin.index', compact('products'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'product_name'=>'required',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $room = M_Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.index')->with('produk sukses ditambahkan');
    }

    public function edit($id){
        $products = M_Product::findOrFail($id);
        return view('admin.edit', compact('products'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_name'=>'required',
            'product_description'=>'required',
            'product_price'=>'required|numeric'
        ]);

        $product = M_Product::findOrFail($id);
        $imageName = $product->image;

        // if ($request->hasFile('image')) {
        //     if ($imageName && file_exists(public_path('images/' . $imageName))) {
        //         unlink(public_path('images/' . $imageName));
        //     }

        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        // }

        $product->update([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price
        ]);

        return redirect()->route('admin.index')->with('produk berhasil diedit');
    }

    public function destroy($id){
        $product = M_Product::where('id_product', $id)->firstOrFail();
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin.index')->with('produk berhasil dihapus');
    }
}
