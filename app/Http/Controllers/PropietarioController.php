<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Propietario;

class PropietarioController extends Controller
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
            'message' => 'Propietarios obtenidos correctamente',
            'data' => Propietario::orderBy('nombre','asc')->get()
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
            'nombre'     => 'required|string',
            'apellido'     => 'required|string',
            ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'created' => false,
                'errors'  => $validator->errors()->all()
            ],500);
        }


        $propietario = Propietario::where('nombre',$request->nombre)->get();
        if(count($propietario) > 0){
            return response()->json([
                'succes' => false,
                'message' => 'El propietario ya existe'
            ],500);
        }else{
            try {
                DB::beginTransaction();
                $nuevo_propietario = new Propietario();
                $nuevo_propietario->nombre = $request->nombre;
                $nuevo_propietario->apellido = $request->apellido;
                $nuevo_propietario->save();
                DB::commit();
                Log::info('Se guardo el propietario ');
                return response()->json([
                    'success' => true,
                    'message' => "Se registro el propietario correctamente",
                ], 201);
            } catch (\PDOException $e) {
                DB::rollBack();
                Log::error('Error al almacenar el propietario' . $e->getMessage());
            }
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
