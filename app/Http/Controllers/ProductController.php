<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected function saveRequest(StoreProduct $request, $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();
        if ($request->ajax()) {
            return datatables()->of($products)->make(true);
        }
        return view('back.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $product = new Product;
        $this->saveRequest($request, $product);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('front.order', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('back.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, $id)
    {
        $product = Product::find($id);
        $this->saveRequest($request, $product);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }

    public function trash(Request $request)
    {
        // $this->authorize('viewAny', Product::class);
        $products = Product::onlyTrashed()->get();
        if ($request->ajax()) {
            return datatables()->of($products)->make(true);
        }
        return view('back.product.trash');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        // $this->authorize('restore', $product);
        $product->restore();
        return redirect()->back();
    }

    public function kill($id)
    {
        $product = Product::withTrashed()->find($id);
        // $this->authorize('forceDelete', $product);
        $product->forceDelete();
        return redirect()->back();
    }
}
