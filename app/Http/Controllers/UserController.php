<?php

namespace App\Http\Controllers;

use App\User;
use App\User2;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function index()
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        /** @var User $usuarios */
        $usuarios = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('usuarios.index')->with(['usuarios' => $usuarios]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }

        $reglas = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'last_name' => 'sometimes',
            'phone' => 'sometimes',
            'address' => 'sometimes',
            'department' => 'sometimes',
            'zip_code' => 'sometimes',
            'city' => 'sometimes',
            'province' => 'sometimes',
            'business_name' => 'sometimes',
            'cuit' => 'sometimes',
            'dni' => 'sometimes',
            'iva' => 'sometimes',
            'shipment' => 'sometimes',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        /** @var User2|null $usuario */
        $usuario = new User2();
        $usuario->name = $request['name'];
        $usuario->last_name = $request['last_name'] ?? '';
        $usuario->email = $request['email'];
        $usuario->phone = $request['phone'] ?? '';
        $usuario->password = Hash::make($request['password']);
        $usuario->address = $request['address'] ?? '';
        $usuario->department = $request['department'] ?? '';
        $usuario->zip_code = $request['zip_code'] ?? '';
        $usuario->city = $request['city'] ?? '';
        $usuario->province = $request['province'] ?? '';
        $usuario->business_name = $request['business_name'] ?? '';
        $usuario->cuit = $request['cuit'] ?? '';
        $usuario->dni = $request['dni'] ?? '';
        $usuario->iva = $request['iva'] ?? '';
        $usuario->shipment = $request['shipment'] ?? '';

        return redirect('/usuarios/cargar');
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'last_name' => 'sometimes',
            'phone' => 'sometimes',
            'address' => 'sometimes',
            'department' => 'sometimes',
            'zip_code' => 'sometimes',
            'city' => 'sometimes',
            'province' => 'sometimes',
            'business_name' => 'sometimes',
            'cuit' => 'sometimes',
            'dni' => 'sometimes',
            'iva' => 'sometimes',
            'shipment' => 'sometimes',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);

        /** @var User2 $usuario */
        $usuario = User2::query()->find($id);
        $usuario->name = $request->input('name') !== $usuario->name ? $request->input('name') : $usuario->name;
        $usuario->last_name = $request->input('last_name') !== $usuario->last_name ? $request->input('last_name') : $usuario->last_name;
        $usuario->phone = $request->input('phone') !== $usuario->phone ? $request->input('phone') : $usuario->phone;
        $usuario->email = $request->input('email') !== $usuario->email ? $request->input('email') : $usuario->email;
        $usuario->password = $request->input('password') !== $usuario->password ? $request->input('password') : $usuario->password;
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
        $usuario->save();

        return redirect('/usuarios/cargar');

    }

}
