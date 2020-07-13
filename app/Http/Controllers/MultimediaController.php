<?php

namespace App\Http\Controllers;

use App\Multimedia;
use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $producto = Product::find($id);
        $multimedias = Multimedia::all();
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('multimedias.create')->with('producto',$producto)
                                        ->with('multimedias',$multimedias)
                                        ->with('subcategories',$subcategories)
                                        ->with('allCategories',$allCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'multimedia'=>'required'
        ];
        $mensaje = ['required' => 'Necesita seleccionar una imagen :attribute']; 
        $this->validate($request, $reglas, $mensaje);
        foreach ($request->paths as $photo){
            $filename = $photo->store('product','public');
            Multimedia::create([
                'product_id' => $request->product_id,
                'path' => $filename
            ]);
        }
        return redirect ('/productos/usuario/cargar_imagen/' . $request->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedia $multimedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Multimedia $multimedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $multimedia = Multimedia::find($id);
        Multimedia::destroy($id);
        return redirect('/productos/usuario/cargar_imagen/'.$multimedia->product_id);
    }
}