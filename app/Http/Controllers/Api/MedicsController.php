<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medics;
use Illuminate\Http\Request;

class MedicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $listMedics = Medics::all();
            if($request->query('active') == true){
                $listMedics = Medics::where('active', true)->get();
            }
    
            return response()->json([
                "message" => "Listagem de Médicos",
                "status" => true,
                "data" => $listMedics
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        try{
            if(Medics::where('crm', $request->crm)->count() > 0){
                return response()->json([
                    'message' => "Já existe um médico que possuí esse CRM",
                    'status' => false
                    
                ],400);
            }
    
            $medics = new Medics();
            $medics->fill($request->all());
            $medics->save($request->all());
            return response()->json([
                'message'=> "Médico cadastrado com sucesso.",
                "status" => true
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
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

            $medic = Medics::find($id);


            if(!$medic){
                return response()->json([
                    'message'=> "ID não encontrado.",
                    "status" => true
                ], 400);
            }

            return response()->json([
                "message" => "Medico encontrado",
                "status" => true,
                "data" => $medic
            ]);

        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
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
            $medic = Medics::find($id);


            if(!$medic){
                return response()->json([
                    'message'=> "ID não encontrado.",
                    "status" => true
                ], 400);
            }
            $medic->save($request->all());
            $medic->fill($request->all());
            return response()->json([
                'message'=> "Médico Editado com sucesso.",
                "status" => true
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
        }
    }

}
