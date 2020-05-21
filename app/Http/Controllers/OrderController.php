<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected function saveRequest(StoreOrder $request, $order)
    {
        $order->fullname = $request->fullname;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->number = time();

        $order->save();

        $order->products()->sync($request->product);
    }

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
                    if (isset($order->products->first()->name)) {
                        return $order->products->first()->name;
                    } else {
                        return "Product deleted";
                    }
                })
                ->addColumn('price', function (Order $order) {
                    if (isset($order->products->first()->price)) {
                        return $order->products->first()->price;
                    } else {
                        return "Product deleted";
                    }
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
        DB::beginTransaction();
        try {
            $order = new Order;
            $this->saveRequest($request, $order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('order.show', $order->id)->with('success', 'Order created.');
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
        DB::beginTransaction();
        try {
            $order = Order::find($id);
            $this->saveRequest($request, $order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('order.show', $order->id)->with('success', 'Order edited.');
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
        return redirect()->back()->with('success', 'Order deleted.');
    }

    public function trash(Request $request)
    {
        // $this->authorize('viewAny', Order::class);
        $orders = Order::onlyTrashed()->get();
        if ($request->ajax()) {
            return datatables()->of($orders)
                ->addColumn('name', function (Order $order) {
                    if (isset($order->products->first()->name)) {
                        return $order->products->first()->name;
                    } else {
                        return "Product deleted";
                    }
                })
                ->addColumn('price', function (Order $order) {
                    if (isset($order->products->first()->price)) {
                        return $order->products->first()->price;
                    } else {
                        return "Product deleted";
                    }
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
        return redirect()->back()->with('success', 'Order restored.');
    }

    public function kill($id)
    {
        $order = Order::withTrashed()->find($id);
        // $this->authorize('forceDelete', $order);
        $order->forceDelete();
        return redirect()->back()->with('success', 'Order permanently deleted.');
    }
}
