<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        if(Auth::user() == null){
            return redirect('login');
        }
    
        $subcategorias = DB::table('subcategories')->orderBy('id', 'desc')->paginate(15);
        $categorias = Category::all();
        return view('subcategorias.create')->with('categorias',$categorias)
                                            ->with('subcategorias',$subcategorias);
    }

    public function store(Request $request)
    {
        $reglas = [
            'name'=>'required',
            'category_id' => 'required'
        ];

        $mensaje=[
            'el campo :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);

        $subcategoria = new Subcategory($request->all());

        $subcategoria->save();

        return redirect('/subcategorias/cargar');
    }


    public function show(Subcategory $subcategory)
    {
        //
    }


    public function edit($id)
    {
        $categorias = Category::all();
        $subcategoria = Subcategory::find($id);
        return view('subcategorias.edit')
            ->with('subcategoria', $subcategoria)
            ->with('categorias', $categorias);
    }


    public function update(Request $request, $id)
    {
        $reglas = [
            'name'=>'required',
            'category_id' => 'required'
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $subcategoria = Subcategory::find($id);
        $subcategoria->name = $request->input('name') !== $subcategoria->name ? $request->input('name') : $subcategoria->name;
        $subcategoria->category_id = $request->input('category_id') !== $subcategoria->category_id ? $request->input('category_id') : $subcategoria->category_id;
      
        $subcategoria->save();
        return redirect("/subcategorias/cargar");
    }


    public function destroy($id)
    {
        Subcategory::find($id)->delete();
        return redirect("/subcategorias/cargar");
    }
}
