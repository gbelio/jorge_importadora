<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use App\Product;
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

        $allCategories = Category::all();
        $subcategories = Subcategory::all();

        $subcategorias = Subcategory::all()->sortByDesc('id'); 

        return view('subcategorias.create')->with('allCategories',$allCategories)
                                        ->with('subcategorias',$subcategorias)
                                        ->with('subcategories',$subcategories);
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
        return view('subcategorias.edit')->with('subcategoria', $subcategoria)
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
        $subcategory=Subcategory::find($id);
        $product = Product::where('subcategory_id', 'LIKE', "%$id%")->get();
        if (count($product) == 0) {
            $subcategory->delete();
        }else{
            return redirect("/subcategorias/cargar");
        }
        return redirect("/subcategorias/cargar");
    }

    public function search(Request $request)
    {
        $clave = $request->clave;
        $allCategories = Category::all();
        $subcategory = Subcategory::where('name', 'LIKE', "%$clave%")->get();
        $subcategory_id = $subcategory[0]->id;
        $productsById = Product::where('subcategory_id', 'LIKE', "%$subcategory_id")->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('subcategorias.results')->with('productsById', $productsById)
                                            ->with('subcategory', $subcategory)
                                            ->with('subcategories', $subcategories)
                                            ->with('categories', $categories)
                                            ->with('allCategories', $allCategories);
    }
}
