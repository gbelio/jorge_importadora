<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Auth;

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
        $profile = User::query()->find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.show')->with('profile', $profile)
                                  ->with('allCategories',$allCategories)
                                  ->with('subcategories',$subcategories);
    }

    public function edit()
    {
        if(Auth::user() == null){
            return redirect('login');
        }
        return view('perfil.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $reglas = [
            'name'=>'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $user = Auth::user();
        $user->name = $request->input('name') !== $user->name ? $request->input('name') : $user->name;
        if ($request->input('password') == $request->input('password_confirmation') && strlen($request->input('password')) > 7){
            $user->password = Hash::make($request->input('password'));
            $length = strlen($request->input('password'));
        }elseif ($request->input('password') !== null){
            $error="El password debe tener más de 7 caracteres y coincidir en ambos casilleros";
            return view('perfil.edit')->with('error', $error);
        }
        $user->save();
        return redirect('/perfil');
    }

    public function destroy($id)
    {
        //
    }
}
