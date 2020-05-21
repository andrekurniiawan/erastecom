<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        if ($request->ajax()) {
            return datatables()->of($orders)
                ->addColumn('name', function (Order $order) {
                    return $order->products->first()->name;
                })
                ->addColumn('price', function (Order $order) {
                    return $order->products->first()->price;
                })
                ->make(true);
        }
        return view('back.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return redirect()->route('product.show', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $order = new Order;

        $order->fullname = $request->fullname;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->number = time();

        $order->save();

        $order->products()->sync($request->product);

        return redirect()->route('order.show', $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('front.success', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('products')->find($id);
        $product = $order->products->first();
        return view('back.order.edit', compact('order', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrder $request, $id)
    {
        $order = Order::find($id);

        $order->fullname = $request->fullname;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->number = time();

        $order->save();

        $order->products()->sync($request->product);

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back();
    }

    public function trash(Request $request)
    {
        // $this->authorize('viewAny', Order::class);
        $orders = Order::onlyTrashed()->get();
        if ($request->ajax()) {
            return datatables()->of($orders)
                ->addColumn('name', function (Order $order) {
                    return $order->products->first()->name;
                })
                ->addColumn('price', function (Order $order) {
                    return $order->products->first()->price;
                })
                ->make(true);
        }
        return view('back.order.trash');
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->find($id);
        // $this->authorize('restore', $order);
        $order->restore();
        return redirect()->back();
    }

    public function kill($id)
    {
        $order = Order::withTrashed()->find($id);
        // $this->authorize('forceDelete', $order);
        $order->forceDelete();
        return redirect()->back();
    }
}
