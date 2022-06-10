<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Auto;
use App\Propietario;
use App\AutoVenta;
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
            'data' => Propietario::orderBy('id','asc')->with('autos')->get()
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
            'modelo_id'=> 'required|integer' ,
            'propietario_id'=> 'required|integer'  
            ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'created' => false,
                'errors'  => $validator->errors()->all()
            ],500);
        }

        try {
            DB::beginTransaction();
            $nuevo_auto = new Auto();
            $nuevo_auto->patente = $request->patente;
            $nuevo_auto->anio = $request->anio;
            $nuevo_auto->marca_id = $request->marca_id;
            $nuevo_auto->modelo_id = $request->modelo_id;
            $nuevo_auto->color_id = $request->color_id;
            $nuevo_auto->save();
            $nuevo_auto->propietarios()->attach($request->propietario_id);
            DB::commit();
            Log::info('Se guardo el auto ');
            return response()->json([
                'success' => true,
                'message' => "Se registro el auto correctamente",
            ], 201);
        } catch (\PDOException $e) {
            DB::rollBack();
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 500);
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
        try{
            $auto = Auto::findOrFail($id)->with('modelo.marca','modelo','color')->get();
            return response()->json([
                'success' => true,
                'message' => 'Auto encontrado Correctamente',
                'data' => $auto
            ], 200);
            Log::emergency('Se edito el auto: ' . $id);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'success' => true,
                'message' => 'No se encontro el auto '.$exception->getMessage()
            ]);
            Log::error('No se encontro el auto ,'.$exception->getMessage());
        }
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
        try{
            $auto = Auto::findOrFail($id);
            $auto->anio = $request->anio;
            $auto->patente = $request->patente;
            $auto->marca_id = $request->marca_id;
            $auto->modelo_id = $request->modelo_id;
            $auto->color_id = $request->color_id;
            $auto->save();
            return response()->json([
                'success' => true,
                'message' => 'Auto editado Correctamente',
            ], 200);
            Log::emergency('Se edito el auto: ' . $id);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'success' => true,
                'message' => 'No se encontro el auto '.$exception->getMessage()
            ]);
            Log::error('No se encontro el auto ,'.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $auto = Auto::findOrFail($id);
            $auto->delete();
            return response()->json([
                'success' => true,
                'message' => 'Auto borrado Correctamente',
            ], 200);
            Log::emergency('Se elimino el auto: ' . $id);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'success' => true,
                'message' => 'No se encontro el auto '.$exception->getMessage()
            ]);
            Log::error('No se encontro el auto ,'.$exception->getMessage());
        }

    }

    public function historial($id){
        try{

            // $auto = Auto::findOrFail($id)->with('autoVenta')->get();
            $auto = AutoVenta::where('auto_id','=',$id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Historial Auto encontrado Correctamente',
                'data' => $auto
            ], 200);
            Log::emergency('Se encontro el historial del auto: ' . $id);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'success' => true,
                'message' => 'No se encontro el auto '.$exception->getMessage()
            ]);
            Log::error('No se encontro el auto ,'.$exception->getMessage());
        }
    }
}
