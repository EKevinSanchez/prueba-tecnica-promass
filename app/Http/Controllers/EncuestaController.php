<?php

namespace App\Http\Controllers;

use App\Models\CatPregunta;
use App\Models\Encuesta;
use App\Models\FolioPremio;
use App\Models\RespuestasPreguntasPremio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EncuestaController extends Controller
{
    //

    public function encuesta(Request $request){
        try {
            $numPregunta = 0;
            $cliente = $request->id_cliente;
            $encuesta = Encuesta::create([
                'id_cliente' => $cliente,
                'fecha_encuesta' => date('Y-m-d'),
                'resultado' => 0,
                'id_folio_premio' => null
            ]);
            do {
                $numPregunta++;
                $pregunta = CatPregunta::where('id', $numPregunta)->first();
                $respuesta = $request->{"pregunta_".$numPregunta};
                $validacion = $this->validacionRespuesta($pregunta->id, $respuesta, $encuesta->id);
                if($validacion){
                    $encuesta->resultado = $encuesta->resultado + 1;
                }
                $encuesta->save();
            } while ($numPregunta < 7);
            if($encuesta->resultado == 7){
                $folio = FolioPremio::where('estatus', true)->first();
                $folio->estatus = false;
                $folio->save();
                $encuesta->id_folio_premio = $folio->id;
                $encuesta->save();
            }
            return response()->json([
                'encuesta' => $encuesta
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function validacionRespuesta($pregunta, $respuesta, $id_encuesta){
        try {
            $pregunta = CatPregunta::where('id', $pregunta)->first();
            $registroRespuesta = RespuestasPreguntasPremio::create([
                'id_encuesta' => $id_encuesta,
                'id_pregunta' => $pregunta->id,
                'respuesta' => $pregunta->respuesta_correcta == $respuesta ? true : false
            ]);
            return $pregunta->respuesta_correcta == $respuesta ? true : false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}
