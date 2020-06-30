<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;
use App\User;
use App\Multimedia;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Category::all();
        return view('categorias.index')
                    ->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
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

        return redirect('/categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria=Category::find($id);
        $productos = Product::where('category_id', $id)->paginate(9);
        $multimedias=Multimedia::all();
        return view('categorias.show')
                ->with('categoria',$categoria)
                ->with('productos',$productos)
                ->with('multimedias',$multimedias);
    }
}
