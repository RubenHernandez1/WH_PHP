<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMessageRequest;

class GuardarMensajeController extends Controller
{
    public function guardar(StoreMessageRequest $request)
    {
        
        $this->guardarArchivo($request->validated());

        return response()->json([
            'nombre' => $request->name,
            'email' => $request->email,
            'mensaje' => $request->message,
        ]);
    }


    private function guardarArchivo($request){
        $file = 'mensajes.json';

        if (Storage::exists($file)) {
            $existingData = json_decode(Storage::get($file), true);
        } else {
            $existingData = [];
        }

        $existingData[] = $request;

        Storage::put($file, json_encode($existingData, JSON_PRETTY_PRINT));
    }
}
