<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('category');
        if ($request->has('search')) {
            $products->orWhere('description', 'LIKE', "%{$request->search}%");
            $products->orWhere('name', 'LIKE', "%{$request->search}%");
        }
        $products = $products->paginate(12);
        return view('product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('product-add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5'],
            'description' => ['required', 'string', 'min:15', 'max:500'],
            'price' => ['required', 'numeric', 'min:1000', 'max:10000000'],
            'stock' => ['required', 'numeric', 'min:1', 'max:10000'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg']
        ]);
        $new_product = new Product();
        $new_product->name = $request->name;
        $new_product->description = $request->description;
        $new_product->stock = $request->stock;
        $new_product->category_id = $request->category_id;
        $new_product->price = $request->price;
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $new_product->image = $fileName;
        $new_product->save();
        return redirect()->route('product')->with('success', 'Add Product Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        return view('product-detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->find($id);
        $categories = Category::get();
        return view('product-edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => ['required', 'string', 'min:15', 'max:500'],
            'price' => ['required', 'numeric', 'min:1000', 'max:10000000'],
            'stock' => ['required', 'numeric', 'min:1', 'max:10000'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg']
        ]);
        $product = Product::with('category')->find($id);
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);

        $product->image = $fileName;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('product')->with('success', 'Edit Product Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required']);
        Product::where('id', $request->id)->delete();
        return response()->json(['message' => 'Product Deleted']);
    }
}
