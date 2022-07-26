<?php

namespace App\Http\Controllers;

use App\Colour;
use App\OrderDetail;
use App\ProductColour;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
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
use App\Order;
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
        $productos = Product::query()
            ->orderBy('id', 'desc')
            ->paginate(20);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $colores = Colour::all();
        return view('productos.create')->with(['allCategories' => $allCategories,
            'subcategories' => $subcategories,
            'productos' => $productos,
            'colores' => $colores]);
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
            'colours' => 'sometimes',
        ];

        $mensaje = [
            'El :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);
        $cover = $request->file('cover')->storeAs('covers', $request->file('cover')->getClientOriginalName(), 'public');

        $producto = new Product($request->except('colours'));
        $producto->cover = $cover;
        $producto->active = 1;
        $producto->save();

        $colours = $request->colours;
        if ($colours) {
            foreach ($colours as $colour) {
                $new_color = new ProductColour();
                $new_color->product_id = $producto->id;
                $new_color->colour_id = $colour;
                $new_color->available = 1;
                $new_color->save();
            }
        }

        return redirect('/productos/cargar');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $orderDetails = app(OrderDetailController::class)->getOrderDetails();
        $allCategories = Category::all();
        $multimedias = Multimedia::all();
        $product_colours = ProductColour::query()
            ->with('product')
            ->where('product_id', $id)
            ->get();
        $rest_of_colours = Colour::query()
            ->get();
        $colours = [];

        foreach ($rest_of_colours as $colour) {
            foreach ($product_colours as $product_colour) {
                if ($colour->id == $product_colour->colour_id) {
                    array_push($colours, $colour);
                }
            }
        }

        $product = Product::query()
            ->find($id);
        $subcategories = Subcategory::all();
        return view('productos.show')->with('producto', $product)
            ->with('allCategories', $allCategories)
            ->with('userOrderDetails', $orderDetails['userOrderDetails'])
            ->with('subcategories', $subcategories)
            ->with('product_colours', $colours)
            ->with('multimedias', $multimedias);
    }

    /**
     * @return Application|Factory|View
     */
    public function showAll()
    {
        $orderDetails = OrderDetailController::getOrderDetails();
        if (Auth::check()) {
            if ($orderDetails['orderShopping']->first() == null) {
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
        $sliders = Slider::query()->where('s_estado', '=', 1)->get();
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $product_collections = [];

        // Cart
        $userOrderDetails = [];
        $userId = 0;
        if(Auth::check()){
            $userId = Auth::user()->id;
        }
        $orderShopping = Order::query()
            ->where([
                'user_id' => $userId,
                'status' => 'shopping',
            ])->get();
        if(!$orderShopping->isEmpty()){
            $userOrderDetails = OrderDetail::query()->where(['order_id' => $orderShopping[0]->id,])->get();
        }
        // End cart

        $product_colours = ProductColour::all();

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
            ->with('sliders', $sliders)
            ->with('userOrderDetails', $userOrderDetails)
            ->with('product_colours', $product_colours);
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
        $productos = Product::query()
            ->paginate(20);
        $producto = Product::query()
            ->find($id);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $multimedias = Multimedia::all();

        //Colores del producto
        $product_colours = ProductColour::query()
            ->with('product')
            ->where('product_id', $id)
            ->get();

        $colour_ids = ProductColour::query()
            ->select('colour_id')
            ->where('product_id', $id)
            ->get();

        //Colores SIN los colores del producto
        $rest_of_colours = Colour::query()
            ->whereNotIn('id', $colour_ids)
            ->get();


        return view('productos.editar')->with('producto', $producto)
            ->with('allCategories', $allCategories)
            ->with('subcategories', $subcategories)
            ->with('multimedias', $multimedias)
            ->with('rest_of_colours', $rest_of_colours)
            ->with('product_colours', $product_colours)
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
            'active' => 'sometimes',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        /** @var Product $producto */
        $producto = Product::query()
            ->find($id);
        $producto->name = $request->input('name') !== $producto->name ? $request->input('name') : $producto->name;
        $producto->code = $request->input('code') !== $producto->code ? $request->input('code') : $producto->code;
        $producto->amount = $request->input('amount') !== $producto->amount ? $request->input('amount') : $producto->amount;
        $producto->resume = $request->input('resume') !== $producto->resume ? $request->input('resume') : $producto->resume;
        $producto->description = $request->input('description') !== $producto->description ? $request->input('description') : $producto->description;
        $producto->category_id = $request->input('category_id') !== $producto->category_id ? $request->input('category_id') : $producto->category_id;
        $producto->subcategory_id = $request->input('subcategory_id') !== $producto->subcategory_id ? $request->input('subcategory_id') : $producto->subcategory_id;
        $producto->active = $request->input('active') !== $producto->active ? $request->input('active') : $producto->active;
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
     * @return Application|JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $producto = Product::query()
            ->find($id);
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
        $orderDetails = app(OrderDetailController::class)->getOrderDetails();
        $products = Product::query()
            ->where('name', 'LIKE', "%$clave%")
            ->where('active', 1)
            ->paginate(20)
            ->withQueryString();
        $allProducts = Product::all();
        $allCategories = Category::all();
        $categories = Category::query()
            ->where('name', 'LIKE', "%$clave%")
            ->get();
        $subcategory = Subcategory::query()
            ->where('name', 'LIKE', "%$clave%")
            ->get();

        $results = [];
        foreach ($subcategory as $each) {
            if ($each !== null) {
                array_push($results, $each);
            }
        }
        foreach ($categories as $category) {
            if ($category !== null) {
                array_push($results, $category);
            }
        }

        $subcategories = Subcategory::all();
        $mensaje = 'Encontramos' . " " . count($products) . " " . 'productos para su búsqueda: ' . "'$clave'";
        return view('productos.results')->with('products', $products)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('subcategory', $subcategory)
            ->with('allProducts', $allProducts)
            ->with('clave', $clave)
            ->with('allCategories', $allCategories)
            ->with('mensaje', $mensaje)
            ->with('results', $results)
            ->with('userOrderDetails', $orderDetails['userOrderDetails']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function editColour(Request $request, $id)
    {
        $attributes = $request->all();

        $colours = $attributes['colours'];
        foreach ($colours as $colour) {
            $productColour = new ProductColour();
            $productColour->product_id = $id;
            $productColour->colour_id = $colour;
            $productColour->available = 1;
            $productColour->save();
        }

        return redirect('/productos/editar/' . $id);
    }

    public function deleteColour(Request $request, $id)
    {
        $attributes = $request->all();

        $productColour = ProductColour::query()
            ->find($attributes['product_colour_id']);

        $productColour->delete();
        return redirect('/productos/editar/' . $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function deactivate(Request $request, $id){
        $reglas = [
            'active' => 'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];

        $this->validate($request, $reglas, $mensaje);
        /** @var Product $producto */
        $producto = Product::query()
            ->find($id);
        $producto->active = $request->input('active') !== $producto->active ? $request->input('active') : $producto->active;
        $producto->save();

        return redirect()->back();
    }
}
