<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if(Auth::user() == null){
            return redirect('login');
        }
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.index')->with('user', Auth::user())
                                ->with('allCategories',$allCategories)
                                ->with('subcategories',$subcategories);
    }

    public function show($id)
    {
        $orderDetails = app(OrderDetailController::class)->getOrderDetails();
        $profile = User::query()->find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.show')->with('profile', $profile)
                                  ->with('allCategories',$allCategories)
                                  ->with('subcategories',$subcategories)
                                ->with('userOrderDetails', $orderDetails['userOrderDetails']);
    }

    public function edit(int $id)
    {

        if(Auth::user() == null){
            return redirect('login');
        }

        $usuario = User::query()->where('id',  $id)->first();

        return view('perfil.edit')->with('usuario', $usuario);
    }

    public function update(Request $request, int $id)
    {
        $reglas = [
            'name'=>'required',
            'last_name'=>'sometimes',
            'phone'=>'sometimes',
            'email'=>'sometimes',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);

        $user = User::query()->where('id',  $id)->first();

        $user->name = $request->input('name') !== $user->name ? $request->input('name') : $user->name;
        $user->last_name = $request->input('last_name') !== $user->last_name ? $request->input('last_name') : $user->last_name;
        $user->phone = $request->input('phone') !== $user->phone ? $request->input('phone') : $user->phone;
        if ($request->input('password') == $request->input('password_confirmation') && strlen($request->input('password')) > 7){
            $user->password = Hash::make($request->input('password'));
            $length = strlen($request->input('password'));
        }elseif ($request->input('password') !== null){
            $error="El password debe tener más de 7 caracteres y coincidir en ambos casilleros";
            return view('perfil.edit')->with('error', $error);
        }
        $user->save();
        return redirect("/usuarios/cargar");

    }

    public function destroy($id)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $usuario = User::query()
            ->find($id);
        if ($usuario->role != 9){
            $usuario->delete();
            return response()->json(['status' => 'Registro eliminado con éxito']);
        }

        return response()->json(['status' => 'No se puede eliminar la cuenta Admin.']);

    }
}
