<?php
namespace App\Http\Controllers;

Use App\Slider;
Use App\Category;
Use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function create()
    {
        if(Auth::user() == null){
            return redirect('login');
        }
        $allCategories = Category::all();
        $subcategories = Subcategory::all();
        $sliders = DB::table('sliders')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('slider.create')->with('sliders',$sliders)
                                    ->with('allCategories',$allCategories)
                                    ->with('subcategories',$subcategories);
    }


    public function show($id)
    {
        $sliders = DB::table('sliders')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('slider.create')->with('sliders',$sliders);
    }


    public function store(Request $request)
    {
        $reglas = [
            's_img'=>'required',
            's_estado'=>'required',
        ];

        $mensaje=[
            'el campo :attribute es obligatorio'
        ];

        $this->validate($request, $reglas, $mensaje);
        $slider = $request->file('s_img')->storeAs('sliders', $request->file('s_img')->getClientOriginalName(),'public');
        $sliders = new Slider($request->all());
        $sliders->s_img = $slider;
        $sliders->save();
        return redirect('/slider/cargar');
    }


    public function edit($id)
    {
        $slider = Slider::query()
            ->find($id);
        return view('slider.edit')
            ->with('slider', $slider);
    }


    public function update(Request $request, $id)
    {
        $reglas = [
            's_estado' => 'required'
        ];
        $mensaje = ['required' => 'el campo :attribute es obligatorio'];
        $this->validate($request, $reglas, $mensaje);
        $slider = Slider::query()
            ->find($id);
        $slider->s_estado = $request->input('s_estado') !== $slider->s_estado ? $request->input('s_estado') : $slider->s_estado;
        $slider->s_link = $request->input('s_link') !== $slider->s_link ? $request->input('s_link') : $slider->s_link;
        $slider->save();
        return redirect("/slider/cargar");
    }


    public function destroy($id)
    {
        $slider = Slider::query()
            ->find($id);
        $slider->delete();
        return response()->json(['status'=>'Registro eliminado con éxito']);
    }
}
