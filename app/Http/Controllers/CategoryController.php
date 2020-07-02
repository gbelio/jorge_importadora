<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;
use App\User;
use App\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $categorias = Category::all();
        return view('categorias.index')
                    ->with('categorias',$categorias);
    }

    public function create()
    {
        $categorias = DB::table('categories')->orderBy('id', 'desc')->paginate(15);
        return view('categorias.create')
                    ->with('categorias',$categorias);
    }

    public function store(Request $request)
    {
        $reglas = [
            'name' => 'required'
        ];

        $mensaje =[
            'el ::attribute es obligatorio'
        ];

        $this->validate($request,$reglas,$mensaje);

        $categoria = new Category($request->all());

        $categoria->save();

        return redirect('/categorias/cargar');
    }

    public function show($id)
    {
        $categoria=Category::find($id);
        $productos = Product::where('category_id', $id)->paginate(15);
        $multimedias=Multimedia::all();
        return view('categorias.show')
                ->with('categoria',$categoria)
                ->with('productos',$productos)
                ->with('multimedias',$multimedias);
    }

    public function edit($id)
    {
        $categoria = Category::find($id);
        return view('categorias.edit')
            ->with('categoria', $categoria);
    }

    public function update(Request $request, $id)
    {
        $reglas = [
            'name'=>'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $categoria = Category::find($id);
        $categoria->name = $request->input('name') !== $categoria->name ? $request->input('name') : $categoria->name;
      
        $categoria->save();
        return redirect("/categorias/cargar");
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect("/categorias/cargar");
    }

}
