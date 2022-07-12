<?php

namespace App\Http\Controllers;

use App\Colour;
use App\ProductColour;
use App\Category;
use App\Subcategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ColourController extends Controller
{
    public function create()
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        $colores = DB::table('colours')
            ->orderBy('id', 'desc')
            ->paginate(15);
        $allCategories = Category::all();
        $subcategories = Subcategory::all();

        return view('colores.create')->with('colores', $colores)
                                     ->with('allCategories', $allCategories)
                                     ->with('subcategories', $subcategories);
    }


    public function show($id)
    {
        //
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
            'hex' => 'required',
        ];

        $mensaje = [
            'el campo :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);
        $colour = new Colour($request->all());
        $colour->save();
        return redirect('/colores/cargar');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $color = Colour::query()
            ->find($id);
        return view('colores.edit')->with('color', $color);
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
            'name'=>'required',
            'hex'=>'required',
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);

        /** @var Colour $color */
        $color = Colour::query()
            ->find($id);
        $color->name = $request->input('name') !== $color->name ? $request->input('name') : $color->name;
        $color->hex = $request->input('hex') !== $color->hex ? $request->input('hex') : $color->hex;
        $color->save();
        return redirect("/colores/cargar");
    }

    /**
     * @param $id
     * @return false|JsonResponse
     * @throws Exception
     */
    public function  destroy($id)
    {
        $isUsed = ProductColour::query()
            ->where('colour_id', '=', $id)
            ->first();

        if (!$isUsed){
            $color = Colour::query()
                ->find($id);
            $color->delete();
        }else{
            return false;
        }

        return response()->json(['status' => 'Registro eliminado con éxito']);
    }
}

