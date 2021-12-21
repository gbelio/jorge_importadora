<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\User;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\AlertsMailable;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::whereNotIn('status', ['shopping'])->where('user_id', '=', $user->id)->Paginate(15);
        $user_id = Auth::user()->id;
        $orderDetails = OrderDetailController::getOrderDetails();
        $orderShopping = Order::where([
            'user_id' => $user_id,
            'status' => 'shopping',
        ])->get();
        $userOrderDetails = OrderDetail::where([
            'order_id' => $orderShopping[0]->id,
        ])->get();
        return view('compras.show')
                ->with('userOrderDetails', $userOrderDetails)
                ->with('total', $orderDetails['total'])
                ->with('orders', $orders);
    }

     public function search(Request $request)
    {
        $user = User::where('email', 'like', '%'.$request->clave.'%')->take(1)->get();
        if (count($user) != 0){
            $response = 'El resultado de la busqueda "'.$request->clave.'" es:';
            $orders = Order::whereNotIn('status', ['shopping'])->where('user_id', '=', $user[0]->id)->Paginate(15);
        }else{
            $response = 'No se ha encontrado el usuario con el email "'.$request->clave.'"';
            $orders = Order::whereNotIn('status', ['shopping'])->Paginate(15);
        }
        return view('compras.showAll')
            ->with('response', $response)
            ->with('orders', $orders);
    }


    public function show($id)
    {
        $orderDetails = OrderDetailController::getOrderDetails();
        $order = Order::find($id);
        $orderDetail = OrderDetail::where([
            'order_id' => $id
        ])->get();
        return view('compras.detail')
            ->with('orderDetail', $orderDetail)
            ->with('order', $order)
            ->with('total', $orderDetails['total'])
            ->with('userOrderDetails', $orderDetails['userOrderDetails']);
    }


    public function showAll()
    {
        $orders = Order::whereNotIn('status', ['shopping'])->Paginate(20);
        return view('compras.showAll')
                    ->with('orders', $orders);
    }


    public function update(Request $request)
    {
        if($request->order_total == 0){
            return redirect()->back();
        }
        $order = Order::find($request->order_id);
        $order->date = date("Y-m-d H:i:s");
        $order->total = $request->order_total;
        $order->status = 2;
        $order->save();
        $newAdd = new Order([
            'user_id' => $order->user_id,
            'status' => 1,
            'total' => 0,
        ]);
        $newAdd->save();
        return view('comprobantes.show');
    }


    public function updateStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();
        return redirect('/compras/usuarios');
    }
}