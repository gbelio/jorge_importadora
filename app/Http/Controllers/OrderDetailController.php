<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use App\OrderDetail;
use App\Order;
use Auth;
use DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    static function getOrderDetails()
    {
        $total = 0;
        $userOrderDetails = [];
        $orderShopping = [];
        $userId = 0;
        if(Auth::check()){
            $userId = Auth::user()->id;
        }
        $orderShopping = Order::where([
            'user_id' => $userId,
            'status' => 'shopping',
        ])->get();
        if(!$orderShopping->isEmpty()){
            $userOrderDetails = OrderDetail::where([
                'order_id' => $orderShopping[0]->id,
            ])->get();
            foreach ($userOrderDetails as $OrderDetail) {
                $total += $OrderDetail->product->amount;
            }
        }
        return ['userOrderDetails' => $userOrderDetails, 'total' => $total, 'orderShopping' => $orderShopping];
    }

    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $orderDetails = $this->getOrderDetails();
        return view('carrito.show')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('userOrderDetails', $orderDetails['userOrderDetails'])
            ->with('orderShopping', $orderDetails['orderShopping'][0]->id)
            ->with('total', $orderDetails['total']);
    }

    public function add($id)
    {
        $product = Product::find($id);
        $orderShopping = Order::where([
            'user_id' => Auth::user()->id,
            'status' => 'shopping'
        ])->get();
        $newAdd = new OrderDetail([
            'order_id' => $orderShopping[0]->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'code' => $product->code,
            'amount' => $product->amount,
            'cover' => $product->cover,
            'quantity' => 1,
        ]);
        $newAdd->save();
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $OrderDetail = OrderDetail::find($request->id);
        $OrderDetail->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = OrderDetail::find($id);
        $item->delete();
        return redirect()->back();
    }
}