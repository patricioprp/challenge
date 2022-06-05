<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Color;

class ColorController extends Controller
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
            'message' => 'Colores obtenidos correctamente',
            'data' => Color::orderBy('nombre','asc')->get()
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
            ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'created' => false,
                'errors'  => $validator->errors()->all()
            ],500);
        }


        $color = Color::where('nombre',$request->nombre)->get();
        if(count($color) > 0){
            return response()->json([
                'succes' => false,
                'message' => 'El color ya existe'
            ],500);
        }else{
            try {
                DB::beginTransaction();
                $nuevo_color = new Color();
                $nuevo_color->nombre = $request->nombre;
                $nuevo_color->save();
                DB::commit();
                Log::info('Se guardo el color ');
                return response()->json([
                    'success' => true,
                    'message' => "Se registro el color correctamente",
                ], 200);
            } catch (\PDOException $e) {
                DB::rollBack();
                Log::error('Error al almacenar el color' . $e->getMessage());
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
