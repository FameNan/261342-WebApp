<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary as CloudinaryClient;

class SellerProductController extends Controller
{
    // แสดงเฉพาะสินค้าของ seller คนนั้น
    public function index()
    {
        $products = Auth::user()->sellerProducts;
        return view('seller.index', compact('products'));
    }

    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock_number' => 'required|integer|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new CloudinaryClient(env('CLOUDINARY_URL'));
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
            $validatedData['image'] = $result['secure_url'];
        }

        $product = Product::create($validatedData);

        // เชื่อม seller กับ product
        Auth::user()->sellerProducts()->attach($product->product_id);

        return redirect()->route('seller.index')->with('success', 'Product created successfully.');
    }

    public function edit(string $id)
    {
        // เช็คว่าเป็นสินค้าของ seller คนนี้จริงไหม
        $product = Auth::user()->sellerProducts()->where('products.product_id', $id)->firstOrFail();
        return view('seller.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        // เช็คว่าเป็นสินค้าของ seller คนนี้จริงไหม
        $product = Auth::user()->sellerProducts()->where('products.product_id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock_number' => 'required|integer|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = new CloudinaryClient(env('CLOUDINARY_URL'));
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
            $validatedData['image'] = $result['secure_url'];
        }

        $product->update($validatedData);

        return redirect()->route('seller.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Auth::user()->sellerProducts()->where('products.product_id', $id)->firstOrFail();
        Auth::user()->sellerProducts()->detach($product->product_id);
        $product->delete();

        return redirect()->route('seller.index')->with('success', 'Product deleted successfully.');
    }
}
