<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Foundation\Auth\User;
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
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('perfil.show')->with("user", User::find($id))
                                ->with('allCategories',$allCategories)
                                ->with('subcategories',$subcategories);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}