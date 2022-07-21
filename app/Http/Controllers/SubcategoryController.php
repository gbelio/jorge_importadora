<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use App\Product;
use App\Http\Controllers\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::all();
    }


    public function create()
    {
        if(Auth::user() == null){
            return redirect('login');
        }
        $subcategorias = Subcategory::query()->orderBy('id', 'desc')->paginate(20);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        return view('subcategorias.create')
            ->with('allCategories',$allCategories)
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
        $subcategoria = Subcategory::query()
            ->find($id);
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
        /** @var Subcategory $subcategoria */
        $subcategoria = Subcategory::query()
            ->find($id);
        $subcategoria->name = $request->input('name') !== $subcategoria->name ? $request->input('name') : $subcategoria->name;
        $subcategoria->category_id = $request->input('category_id') !== $subcategoria->category_id ? $request->input('category_id') : $subcategoria->category_id;
        $subcategoria->save();

        return redirect("/subcategorias/cargar");
    }


    public function destroy($id)
    {
        $subcategory=Subcategory::query()
            ->find($id);
        $product = Product::query()
            ->where('subcategory_id', 'LIKE', "%$id%")->get();
        if (count($product) == 0) {
            $subcategory->delete();
        }else{
            return redirect()->back();
        }
        return response()->json(['status'=>'Registro eliminado con éxito']);
    }


    public function search(Request $request)
    {
        $clave = $request->clave;

        $orderDetails = app(OrderDetailController::class)->getOrderDetails();
        $allCategories = Category::all();
        $subcategory = Subcategory::query()
            ->where('name', 'LIKE', "%$clave%")->get();
        $subcategory_id = $subcategory[0]->id;
        $productsById = Product::query()
            ->where('subcategory_id', $subcategory_id)
            ->paginate(20)
            ->withQueryString();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('subcategorias.results')->with('productsById', $productsById)
                                            ->with('subcategory', $subcategory)
                                            ->with('subcategories', $subcategories)
                                            ->with('categories', $categories)
                                            ->with('userOrderDetails', $orderDetails['userOrderDetails'])
                                            ->with('allCategories', $allCategories);
    }

    public function getSubcategories(Request $request){
        if ($request->ajax()) {
            $subcategories = Subcategory::query()
                ->where('category_id', $request->category_id)
                ->get();
            foreach ($subcategories as $subcategory){
                $subcatsArr[$subcategory->id] = $subcategory->name;
            }
            return response()->json($subcatsArr);
        }
    }
}
