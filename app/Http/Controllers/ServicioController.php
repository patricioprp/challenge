<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Servicio;
use App\Propietario;
use App\User;
use App\Venta;
use App\AutoVenta;
use App\Auto;

class ServicioController extends Controller
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
            'message' => 'Servicios obtenidos correctamente',
            'data' => Servicio::orderBy('nombre','asc')->get()
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
            'user_id'     => 'required|integer',
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

        foreach($servicios as $servicio){
            $auto = Auto::find($servicio['auto_id']);
            if($auto->color->nombre === 'Gris' && $servicio['servicio'] === 'Pintura'){
                return response()->json([
                    'success' => false,
                    'message' => "Por politicas del taller NO se permite brindar el servicio de “Pintura” para autos de color
                    GRIS"
                ],500);
            }
        }

        try {
            DB::beginTransaction();
            $venta = new Venta($request->all());
            $venta->fecha = \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d');
    
            $venta->propietario_id = $request->propietario_id;
            $venta->user_id = $request->user_id;
            $propietario = Propietario::find($request->propietario_id);
            $venta->propietario_id = $propietario->id;
            $user = User::find($request->user_id);
            $venta->user_id = $user->id;
            $venta->monto = 0;
            $total = 0;
            $venta->save();
            foreach($request->servicios as $servicio){
                $linea_venta =  new AutoVenta();
                $linea_venta->servicio = $servicio['servicio'];
                $linea_venta->costo_servicio = $servicio['costo_servicio'];
                $total = $total + $servicio['costo_servicio'];
                $linea_venta->auto_id = $servicio['auto_id'];
                $linea_venta->venta_id = $venta->id;
                $linea_venta->save();
            }
            $venta_total = Venta::find($venta->id);
            $venta_total->monto = $total;
            $venta_total->save();
            DB::commit();
            Log::info('Se guardo la venta ');
            return response()->json([
                'success' => true,
                'message' => "Se registro la venta correctamente",
            ], 201);
        } catch (\PDOException $e) {
            DB::rollBack();
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 500);
            Log::error('Error al almacenar la venta' . $e->getMessage());
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
