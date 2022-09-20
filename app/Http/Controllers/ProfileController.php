<?php

namespace App\Http\Controllers;

use App\User2;
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
        if (Auth::user() == null) {
            return redirect('login');
        }
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.index')->with('user', Auth::user())
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories);
    }

    public function show($id)
    {
        $orderDetails = app(OrderDetailController::class)->getOrderDetails();
        $profile = User::query()->find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.show')->with('profile', $profile)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('userOrderDetails', $orderDetails['userOrderDetails']);
    }

    public function edit(int $id)
    {

        if (Auth::user() == null) {
            return redirect('login');
        }

        $usuario = User::query()->where('id', $id)->first();

        return view('perfil.edit')->with('usuario', $usuario);
    }

    public function update(Request $request, int $id)
    {
        $reglas = [
            'name' => 'required',
            'last_name' => 'sometimes',
            'phone' => 'sometimes',
            'email' => 'sometimes',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);

        /** @var User2 $usuario */
        $usuario = User2::query()->where('id', $id)->first();

        $usuario->name = $request->input('name') !== $usuario->name ? $request->input('name') : $usuario->name;
        $usuario->last_name = $request->input('last_name') !== $usuario->last_name ? $request->input('last_name') : $usuario->last_name;
        $usuario->phone = $request->input('phone') !== $usuario->phone ? $request->input('phone') : $usuario->phone;
        $usuario->address = $request->input('address') !== $usuario->address ? $request->input('address') : $usuario->address;
        $usuario->department = $request->input('department') !== $usuario->department ? $request->input('department') : $usuario->department;
        $usuario->zip_code = $request->input('zip_code') !== $usuario->zip_code ? $request->input('zip_code') : $usuario->zip_code;
        $usuario->city = $request->input('city') !== $usuario->city ? $request->input('city') : $usuario->city;
        $usuario->province = $request->input('province') !== $usuario->province ? $request->input('province') : $usuario->province;
        $usuario->business_name = $request->input('business_name') !== $usuario->business_name ? $request->input('business_name') : $usuario->business_name;
        $usuario->cuit = $request->input('cuit') !== $usuario->cuit ? $request->input('cuit') : $usuario->cuit;
        $usuario->dni = $request->input('dni') !== $usuario->dni ? $request->input('dni') : $usuario->dni;
        $usuario->iva = $request->input('iva') !== $usuario->iva ? $request->input('iva') : $usuario->iva;
        $usuario->shipment = $request->input('shipment') !== $usuario->shipment ? $request->input('shipment') : $usuario->shipment;
        if ($request->input('password') == $request->input('password_confirmation') && strlen($request->input('password')) > 7) {
            $usuario->password = Hash::make($request->input('password'));
            $length = strlen($request->input('password'));
        } elseif ($request->input('password') !== null) {
            $error = "El password debe tener más de 7 caracteres y coincidir en ambos casilleros";
            return view('perfil.edit')->with('error', $error);
        }
        $usuario->save();
        return redirect("/usuarios/cargar");
    }

    public function destroy($id)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $usuario = User::query()
            ->find($id);
        if ($usuario->role != 9) {
            $usuario->delete();
            return response()->json(['status' => 'Registro eliminado con éxito']);
        }

        return response()->json(['status' => 'No se puede eliminar la cuenta Admin.']);

    }
}
