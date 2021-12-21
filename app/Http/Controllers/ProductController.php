<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Multimedia;
use App\Slider;
use App\OrderDetail;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductController extends Controller
{

    /**
     *
     */
    public function index()
    {
        //
    }

    /**
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function create()
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $productos = Product::query()->orderBy('id', 'desc')->paginate(20);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('productos.create')->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('productos', $productos);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $reglas = [
            'name' => 'required',
            'code' => 'required',
            'resume' => 'required',
            'description' => 'required',
            'cover' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ];

        $mensaje = [
            'El :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);
        $cover = $request->file('cover')->storeAs('covers', $request->file('cover')->getClientOriginalName(), 'public');
        $producto = new Product($request->all());
        $producto->cover = $cover;
        $producto->save();
        return redirect('/productos/cargar');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $allCategories = Category::all();
        $multimedias = Multimedia::all();
        $product = Product::find($id);
        $subcategories = Subcategory::all();
        return view('productos.show')->with('producto', $product)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('multimedias', $multimedias);
    }

    /**
     * @return Application|Factory|View
     */
    public function showAll()
    {
        $orderDetails = OrderDetailController::getOrderDetails();
        if (Auth::check()){
            if ($orderDetails['orderShopping']->first() == null){
                $newAdd = new Order([
                    'user_id' => Auth::user()->id,
                    'status' => 1,
                    'total' => 0
                ]);
                $newAdd->save();
            }
        }
        $sliderstate = 0;
        $multimedias = Multimedia::all();
        $sliders = Slider::all();
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $product_collections = [];

        foreach ($allCategories as $category) {
            $limit = 20;
            $products_per_category = Product::query()
                ->where('category_id', $category->id)
                ->limit($limit)
                ->get();

            array_push($product_collections, $products_per_category);
        }
        //<editor-fold desc="Verifica si hay sliders activos para mostrar">
        foreach ($sliders as $slider) {
            if ($slider->s_estado != 0) {
                $sliderstate = +1;
            }
        }
        //</editor-fold>
        return view('productos.showAll')
            ->with('product_collections', $product_collections)
            ->with('multimedias', $multimedias)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('sliderstate', $sliderstate)
            ->with('sliders', $sliders);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function edit($id)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $productos = Product::paginate(20);
        $producto = Product::find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $multimedias = Multimedia::all();
        return view('productos.editar')->with('producto', $producto)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('multimedias', $multimedias)
            ->with('productos', $productos);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            'name' => 'required',
            'code' => 'required',
            'resume' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $producto = Product::find($id);
        $producto->name = $request->input('name') !== $producto->name ? $request->input('name') : $producto->name;
        $producto->code = $request->input('code') !== $producto->code ? $request->input('code') : $producto->code;
        $producto->amount = $request->input('amount') !== $producto->amount ? $request->input('amount') : $producto->amount;
        $producto->resume = $request->input('resume') !== $producto->resume ? $request->input('resume') : $producto->resume;
        $producto->description = $request->input('description') !== $producto->description ? $request->input('description') : $producto->description;
        $producto->category_id = $request->input('category_id') !== $producto->category_id ? $request->input('category_id') : $producto->category_id;
        $producto->subcategory_id = $request->input('subcategory_id') !== $producto->subcategory_id ? $request->input('subcategory_id') : $producto->subcategory_id;
        if ($request->file('cover') !== null) {
            $cover = $request->file('cover')->storeAs('covers', $request->file('cover')->getClientOriginalName(), 'public');
            $producto->cover = $cover;
        }
        $producto->save();
        if ($request->input('+fotos') != 'Agregar Fotos') {
            return redirect("/productos/cargar");
        } else {
            return redirect("/productos/usuario/cargar_imagen/$producto->id");
        }


    }

    /**
     * @param $id
     * @return Application|\Illuminate\Http\JsonResponse|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $producto = Product::find($id);
        $producto->delete();
        return response()->json(['status' => 'Registro eliminado con éxito']);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $clave = $request->clave;
        $products = Product::where('name', 'LIKE', "%$clave%")->paginate(20)->withQueryString();
        $allProducts = Product::all();
        $allCategories = Category::all();
        $categories = Category::where('name', 'LIKE', "%$clave%")->get();
        $subcategory = Subcategory::where('name', 'LIKE', "%$clave%")->get();
        $subcategories = Subcategory::all();
        $mensaje = 'Encontramos' . " " . count($products) . " " . 'productos para su búsqueda: ' . "'$clave'";
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
