<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;
use App\User;
use App\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user() == null){
            return redirect('login');
        }
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $categorias = DB::table('categories')->orderBy('id', 'desc')->paginate(15);
        return view('categorias.create')->with('categorias',$categorias)
                                        ->with('subcategories',$subcategories)
                                        ->with('allCategories',$allCategories);
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

    public function search(Request $request)
    {
        $clave = $request->clave;
        $allCategories = Category::all();
        $category = Category::where('name', 'LIKE', "%$clave%")->get();
        $category_id = $category[0]->id;
        $productsById = Product::where('category_id', 'LIKE', "%$category_id")->get();
        $subcategoriesById = Subcategory::where('category_id', 'LIKE', "%$category_id%")->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('categorias.results')->with('category', $category)
                                        ->with('productsById', $productsById)
                                        ->with('subcategoriesById', $subcategoriesById)
                                        ->with('categories', $categories)
                                        ->with('allCategories', $allCategories)
                                        ->with('subcategories',$subcategories);
    }

    public function show($id)
    {
        $categoria=Category::find($id);
        $productos = Product::where('category_id', $id)->paginate(15);
        $multimedias=Multimedia::all();
        $allCategories=Category::all();
        return view('categorias.show')->with('categoria',$categoria)
                                    ->with('productos',$productos)
                                    ->with('allCategories', $allCategories)
                                    ->with('multimedias',$multimedias);
    }

    public function edit($id)
    {
        $categoria = Category::find($id);
        return view('categorias.edit')->with('categoria', $categoria);
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
        $category=Category::find($id);
        $subcategory = Subcategory::where('category_id', 'LIKE', "%$id%")->get();
        $product = Product::where('category_id', 'LIKE', "%$id%")->get();
        if (count($product) == 0 && count($subcategory) == 0) {
            $category->delete();
        }else{
            return redirect()->back()
                            ->withErrors([
                                'No se puede eliminar porque la categoría 
                                se encuentra en uso por un producto o subcategoría.']);
        }
        return response()->json(['status'=>'Registro eliminado con éxito']);
    }
}