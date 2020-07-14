<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\User;
Use App\Category;
Use App\Subcategory;
Use App\Multimedia;
Use App\Slider;


class ProductController extends Controller
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
    public function create()
    {   
        if(Auth::user() == null){
            return redirect('login');
        }
        $productos = Product::all()->sortByDesc('id');
        $allCategories=Category::all();
        $subcategories=Subcategory::all();
        return view('productos.create')->with('allCategories',$allCategories)
                                    ->with('subcategories',$subcategories)
                                    ->with('productos',$productos);
    }

    public function relacion1()
    {
 
        /* if(Auth::user() == null){
            return redirect('login');
        } */
        $category_id = Input::get('category_id');
        $subcategories = Subcategory::where('category_id', '=', $category_id)->get();
        
        return response()->json($subcategories);
    }


    public function store(Request $request)
    {
        $reglas = [
            'name'=>'required',
            'code'=>'required',
            'resume'=>'required',
            'description'=>'required',
            'cover'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
        ];

        $mensaje=[
            'El :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);
        $cover = $request->file('cover')->storeAs('covers', $request->file('cover')->getClientOriginalName(),'public');
        $producto = new Product($request->all());
        $producto->cover = $cover;
        $producto->save();
        return redirect('/productos/cargar');
    }    


    public function show($id)
    {   
        $allCategories = Category::all();
        $multimedias = Multimedia::all();
        $product = Product::find($id);
        $subcategories = Subcategory::all();
        return view('productos.show')->with('producto', $product)
                                    ->with('allCategories',$allCategories)
                                    ->with('subcategories',$subcategories)
                                    ->with('multimedias',$multimedias);
    }


    public function showAll()
    {
        $sliderstate = 0;
        $multimedias = Multimedia::all();
        $products = Product::all()->sortByDesc('id');
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $sliders = Slider::all();
        //verifica si hay sliders activos para mostrar//
        foreach ($sliders as $slider) {
            if ($slider->s_estado != 0){
                $sliderstate =+ 1;
            }
        }
        //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^//
        return view('productos.showAll')->with('products', $products)
                                        ->with('multimedias',$multimedias)
                                        ->with('allCategories',$allCategories)
                                        ->with('subcategories',$subcategories)
                                        ->with('sliderstate', $sliderstate)
                                        ->with('sliders',$sliders);
    }


    public function edit($id)
    {
        $productos = Product::all()->sortByDesc('id');
        $producto = Product::find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $multimedias = Multimedia::all();
        return view('productos.editar')->with('producto', $producto)
                                        ->with('allCategories', $allCategories)
                                        ->with('subcategories', $subcategories)
                                        ->with('multimedias', $multimedias)
                                        ->with('productos',$productos);
    }


    public function update(Request $request, $id)
    {
        $reglas = [
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'subcategory_id' => 'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $producto = Product::find($id);
        $producto->name = $request->input('name') !== $producto->name ? $request->input('name') : $producto->name;
        $producto->description = $request->input('description') !== $producto->description ? $request->input('description') : $producto->description;
        $producto->category_id = $request->input('category_id') !== $producto->category_id ? $request->input('category_id') : $producto->category_id;
        $producto->subcategory_id = $request->input('subcategory_id') !== $producto->subcategory_id ? $request->input('subcategory_id') : $producto->subcategory_id;        
        if($request->file('cover') !== null){
        $cover = $request->file('cover')->storeAs('covers', $request->file('cover')->getClientOriginalName(),'public');
        $producto->cover = $cover;
        }
        $producto->save();
        return redirect("/productos/cargar");
    }


   public function destroy($id)
   {
       $producto=Product::find($id);
       $producto->delete();
       return response()->json(['status'=>'Registro eliminado con éxito']);
   }

   
   public function search(Request $request)
   {
       $clave = $request->clave;
       $products = Product::where('name', 'LIKE', "%$clave%")->get();
       $allProducts = Product::all();
       $allCategories = Category::all();
       $categories = Category::where('name', 'LIKE', "%$clave%")->get();
       $subcategory = Subcategory::where('name', 'LIKE', "%$clave%")->get();
       $subcategories = Subcategory::all();
       $mensaje = 'Encontramos'." ".count($products)." ".'resultados para tu busqueda';
       return view('productos.results')->with('products', $products)
                                        ->with('categories', $categories)
                                        ->with('subcategories', $subcategories)
                                        ->with('subcategory', $subcategory)
                                        ->with('allProducts', $allProducts)
                                        ->with('clave', $clave)
                                        ->with('allCategories', $allCategories)
                                        ->with('mensaje', $mensaje);
   }
}