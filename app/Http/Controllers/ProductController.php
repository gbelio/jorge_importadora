<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
Use App\Category; //recordemos son solo 4, hot stuff es por hits.
Use App\Subcategory;
Use App\Multimedia;
Use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
        $productos = DB::table('products')->orderBy('id', 'desc')->paginate(15);
        $categorias=Category::all();
        $subcategorias=Subcategory::all();
        return view('productos.create')
                ->with('categorias',$categorias)
                ->with('subcategorias',$subcategorias)
                ->with('productos',$productos);
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
        $cover = $request->file('cover')->store('covers','public');
        $producto = new Product($request->all());
        $producto->cover = $cover;
        $producto->save();
        return redirect('/productos/cargar');
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $multimedias = Multimedia::all();
        $product = Product::find($id);
        return view('productos.show')
        ->with('producto', $product)
        ->with('multimedias',$multimedias);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {   
        $multimedias = Multimedia::all();
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $sliders = Slider::all();
        return view('productos.showAll')
        ->with('products', $products)
        ->with('multimedias',$multimedias)
        ->with('categories',$categories)
        ->with('subcategories',$subcategories)
        ->with('sliders',$sliders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $producto = Product::find($id);
            $categorias = Category::all();
            $subcategorias = Subcategory::all();
            $photos = Multimedia::all();
            return view('productos.editar')
                ->with('producto', $producto)
                ->with('categorias', $categorias)
                ->with('subcategorias', $subcategorias)
                ->with('photos', $photos);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
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
        $cover = $request->file('cover')->store('covers','public');
        $producto->cover = $cover;
        }        
        $producto->save();
        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   {
       $producto=Product::find($id);
       $producto->delete();
       return redirect("/productos/cargar");
   }

   public function search(Request $request)
   {
       $clave = $request->clave;
       $products = Product::where('name', 'LIKE', "%$clave%")->get();
       $allProducts = Product::all();
       $categories = Category::where('name', 'LIKE', "%$clave%")->get();
       $subcategories = Subcategory::where('name', 'LIKE', "%$clave%")->get();
       $mensaje = 'Encontramos'." ".count($products)." ".'resultados para tu busqueda';
       return view('productos.results')->with('products', $products)
                                        ->with('categories', $categories)
                                        ->with('subcategories', $subcategories)
                                        ->with('allProducts', $allProducts)
                                        ->with('clave', $clave)
                                        ->with('mensaje', $mensaje);
   }
}