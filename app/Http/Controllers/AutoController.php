<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Auto;
class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return response()->json([
            'success' => true,
            'message' => 'Autos obtenidos correctamente',
            'data' => Auto::orderBy('anio','asc')->with('marca','marca.modelos')->get()
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'anio'     => 'required|integer',
            'patente'  => 'required|string' ,
            'marca_id' => 'required|integer' ,
            'color_id' => 'required|integer' ,
            'modelo_id'=> 'required|integer'  
            ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'created' => false,
                'errors'  => $validator->errors()->all()
            ],500);
        }
//antes de guardar validar si existen los id marca,modelo y color
        try {
            DB::beginTransaction();
            $nuevo_auto = new Auto();
            $nuevo_auto->patente = $request->patente;
            $nuevo_auto->anio = $request->anio;
            $nuevo_auto->marca_id = $request->marca_id;
            $nuevo_auto->modelo_id = $request->modelo_id;
            $nuevo_auto->color_id = $request->color_id;
            $nuevo_auto->save();
            DB::commit();
            Log::info('Se guardo el auto ');
            return response()->json([
                'success' => true,
                'message' => "Se registro el auto correctamente",
            ], 200);
        } catch (\PDOException $e) {
            DB::rollBack();
            Log::error('Error al almacenar el auto' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
