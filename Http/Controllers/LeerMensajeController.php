<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeerMensajeController extends Controller
{
    public function leer()
    {
        return view('mensajes',[
            'data' => $this->obtenerDAtos(),
        ]);
    }


    private function obtenerDatos(){
        $file = 'mensajes.json';

        if (Storage::exists($file)) {
            $json = Storage::get($file);

            $mensajes = json_decode($json, true);

            return is_array($mensajes) ? $mensajes : [];
        }

        return [];
    }

}
