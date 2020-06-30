<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FaqController extends Controller {

    public function index(){    

    $wordingsFaq = [

        'servicios' => File::get('wordings/faq/servicios.txt'),
        'intercambio' => File::get('wordings/faq/intercambio.txt'),
        'compraTrueque' => File::get('wordings/faq/compra_trueque.txt'),
        'denuncia' => File::get('wordings/faq/denuncia.txt'),
        'funcionamiento' => File::get('wordings/faq/funcionamiento.txt'),
        'penalidades' => File::get('wordings/faq/penalidades.txt'),
        'restricciones' => File::get('wordings/faq/restricciones.txt'),        
        'usuarioDestacado' => File::get('wordings/faq/usuario_destacado.txt')
        ];
    
    return view('faq.index')->with('wordingsFaq', $wordingsFaq);

    }

}
