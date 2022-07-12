<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\User;
use App\OrderDetail;
use App\Category;
use App\Subcategory;
use App\Colour;
use Illuminate\Http\Request;
use App\Mail\AlertsMailable;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailerController;
class OrderController extends Controller
{
    public function index()
    {
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $user = Auth::user();
        $orders = Order::query()
            ->whereNotIn('status', ['shopping'])
            ->where('user_id', '=', $user->id)
            ->Paginate(15);
        $user_id = Auth::user()->id;
        $orderDetails = OrderDetailController::getOrderDetails();
        $orderShopping = Order::query()
            ->where([
                'user_id' => $user_id,
                'status' => 'shopping',
            ])->get();
        $userOrderDetails = OrderDetail::query()
            ->where([
                'order_id' => $orderShopping[0]->id,
            ])->get();
        return view('compras.show')
                ->with('userOrderDetails', $userOrderDetails)
                ->with('total', $orderDetails['total'])
                ->with('orders', $orders)
                ->with('allCategories', $allCategories)
                ->with('subcategories', $subcategories);
    }

    public function search(Request $request)
    {
        $user = User::query()
            ->where('email', 'like', '%'.$request->clave.'%')
            ->take(1)
            ->get();
        if (count($user) != 0){
            $response = 'El resultado de la busqueda "'.$request->clave.'" es:';
            $orders = Order::query()
                ->whereNotIn('status', ['shopping'])
                ->where('user_id', '=', $user[0]->id)
                ->Paginate(15);
        }else{
            $response = 'No se ha encontrado el usuario con el email "'.$request->clave.'"';
            $orders = Order::query()
                ->whereNotIn('status', ['shopping'])
                ->Paginate(15);
        }
        return view('compras.showAll')
            ->with('response', $response)
            ->with('orders', $orders);
    }

    public function show($id)
    {
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $orderDetails = OrderDetailController::getOrderDetails();
        $order = Order::query()
            ->find($id);
        $rest_of_colours = Colour::query()
        ->get();
        $orderDetail = OrderDetail::query()
            ->with('colour')
            ->where([
                'order_id' => $id
            ])->get();
        return view('compras.detail')
            ->with('orderDetail', $orderDetail)
            ->with('order', $order)
            ->with('total', $orderDetails['total'])
            ->with('userOrderDetails', $orderDetails['userOrderDetails'])
            ->with('rest_of_colours',$rest_of_colours)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories);
    }

    public function showAll()
    {
        $orders = Order::query()->whereNotIn('status', ['shopping'])->Paginate(20);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('compras.showAll')
                    ->with('orders', $orders)
                    ->with('allCategories', $allCategories)
                    ->with('subcategories', $subcategories);
    }

    public function update(Request $request)
    {
        if($request->order_total == 0){
            return redirect()->back();
        }

        /** @var Order $order */
        $order = Order::query()->find($request->order_id);
        $order->date = date("Y-m-d H:i:s");
        $order->total = $request->order_total;
        $order->status = 6;
        $order->save();
        $newAdd = new Order([
            'user_id' => $order->user_id,
            'status' => 1,
            'total' => 0,
        ]);
        $newAdd->save();
        MailerController::userOrderConfirmation($order);
        MailerController::adminOrderReception($order);
/*         Mail::to('gastonb.bkp@gmail.com')->send(new AlertsMailable($order));
        Mail::to($order->user->email)->send(new AlertsMailable($order)); */
        return view('comprobantes.show');
    }

    public function updateStatus(Request $request)
    {
        /** @var Order $order */
        $order = Order::query()
            ->find($request->id);
        $order->status = $request->status;
        $order->save();
        if ($order->status == 3){
            MailerController::userOrderReady($order);
            /* Mail::to($order->user->email)->send(new AlertsMailable($order)); */
        }
        if ($order->status == 5){
            MailerController::userOrderCancelation($order);
            /* Mail::to($order->user->email)->send(new AlertsMailable($order)); */
        }
        return redirect('/compras/usuarios');
    }
}
