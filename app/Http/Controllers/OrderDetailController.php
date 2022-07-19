<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use App\OrderDetail;
use App\Order;
use App\Colour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    /**
     * @return array
     */
    static function getOrderDetails(): array
    {
        $total = 0;
        $userOrderDetails = [];
        $orderShopping = [];
        $userId = 0;
        if(Auth::check()){
            $userId = Auth::user()->id;
        }
        $orderShopping = Order::query()
            ->where([
            'user_id' => $userId,
            'status' => 'shopping',
        ])->get();
        if(!$orderShopping->isEmpty()){
            $userOrderDetails = OrderDetail::query()
                ->where([
                'order_id' => $orderShopping[0]->id,
            ])->get();
            foreach ($userOrderDetails as $OrderDetail) {
                $total += $OrderDetail->product->amount*$OrderDetail->quantity;
            }
        }
        return ['userOrderDetails' => $userOrderDetails, 'total' => $total, 'orderShopping' => $orderShopping];
    }

    public function index()
    {
        $products = Product::all();
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $orderDetails = $this->getOrderDetails();
        $rest_of_colours = Colour::query()
        ->get();
        return view('carrito.show')
            ->with('products', $products)
            ->with('allCategories', $allCategories)
            ->with('userOrderDetails', $orderDetails['userOrderDetails'])
            ->with('orderShopping', $orderDetails['orderShopping'][0]->id)
            ->with('total', $orderDetails['total'])
            ->with('subcategories', $subcategories)
            ->with('rest_of_colours',$rest_of_colours);
    }

    /**
     * @return RedirectResponse
     */
    public function add(): RedirectResponse
    {

        $user=Auth::user();

        $orderShopping = Order::query()
        ->where([
            'user_id' => $user->id,
            'status' => 'shopping'
        ])->get();
        $newAdd = new OrderDetail([
            'order_id' => $orderShopping[0]->id,
            'product_id' => $_POST['product_id'],
            'colour_id' => $_POST['colour_id'],
            'name' => $_POST['name'],
            'code' => $_POST['code'],
            'amount' => $_POST['amount'],
            'cover' => $_POST['cover'],
            'quantity' => $_POST['quantity'],
        ]);
        $newAdd->save();
        /* return redirect()->back(); */
        return redirect('/cart');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $OrderDetail = OrderDetail::query()
            ->find($request->id);
        $OrderDetail->save();
        return redirect()->back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($id): RedirectResponse
    {
        $item = OrderDetail::query()
            ->find($id);
        $item->delete();
        return redirect()->back();
    }
}
