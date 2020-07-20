<?php

namespace App\Http\Controllers;

use App\Multimedia;
use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{

    public function index()
    {
        //
    }


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


    public function store(Request $request)
    {
        foreach ($request->paths as $photo){
            $filename = $photo->storeAs('product', $photo->getClientOriginalName(),'public');
            Multimedia::create([
                'product_id' => $request->product_id,
                'path' => $filename
            ]);
        }
        return redirect ('/productos/usuario/cargar_imagen/' . $request->product_id);
    }


    public function create1($id)
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


    public function store1(Request $request)
    {
        foreach ($request->paths as $photo){
            $filename = $photo->store('product','public');
            Multimedia::create([
                'product_id' => $request->product_id,
                'path' => $filename
            ]);
        }
        return redirect ('/productos/editar/' . $request->product_id);
    }


    public function show(Multimedia $multimedia)
    {
        //
    }

    public function edit(Multimedia $multimedia)
    {
        //
    }

    public function update(Request $request, Multimedia $multimedia)
    {
        //
    }


    public function destroy($id)
    {  
        $multimedia = Multimedia::find($id);
        Multimedia::destroy($id);
        return redirect('/productos/usuario/cargar_imagen/'.$multimedia->product_id);
    }


    public function destroy1($id)
    {  
        $multimedia = Multimedia::find($id);
        Multimedia::destroy($id);
        return redirect('/productos/editar/'.$multimedia->product_id);
    }
}
