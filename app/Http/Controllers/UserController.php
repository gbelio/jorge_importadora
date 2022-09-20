<?php

namespace App\Http\Controllers;

use App\User;
use App\User2;
use App\Category;
use App\Subcategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function store(Request $request)
    {

        User2::create([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('/usuarios/cargar')
        ->with('allCategories', $allCategories)
        ->with('subcategories', $subcategories);
    }

}
