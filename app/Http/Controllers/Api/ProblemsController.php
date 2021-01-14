<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medics;
use App\Models\Pacients;
use App\Models\Problems;
use Illuminate\Http\Request;

class ProblemsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $getIdMedic =Medics::where('crm', $data['crm_medic']);
            $getIdPacient = Pacients::where('document', $data['document_pacient']);
            unset($data['crm_medic'], $data['document_pacient']);

            if($getIdMedic->count() < 1){
                return response()->json([
                    "message" => "CRM Informado não encontrado",
                    "status" => false
                ]);
            }
            if($getIdPacient->count() < 1){
                return response()->json([
                    "message" => "Documento Informado não encontrado",
                    "status" => false
                ]);
            }
            $getIdMedic = $getIdMedic->get()[0];
            $getIdPacient = $getIdPacient->get()[0];

            $data['medic_id'] = $getIdMedic->id;
            $data['pacient_id'] = $getIdPacient->id;

            $problems = new Problems();

            $problems->fill($data);
            $problems->save($data);

            return response()->json([
                "message"=> "Diagnostico registrado com sucesso.",
                "status"=> true
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['message'=>"Houve um erro ao processar sua requisição"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        try{
            
           
            $getDiagnostic = Pacients::where('document', $document);
            
            if($getDiagnostic->count() < 1){
                return response()->json([
                    "message" => "Documento Informado não encontrado",
                    "status" => false
                ], 400);
            }

            return response()->json([
                "message" => "Diagnosticos",
                "status" => true,
                "data" => $getDiagnostic
            ]);

        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição"], 500);
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
            $data = $request->all();
            $getIdMedic =Medics::where('crm', $data['crm_medic']);
            $getIdPacient = Pacients::where('document', $data['document_pacient']);
            unset($data['crm_medic'], $data['document_pacient']);

            if($getIdMedic->count() < 1){
                return response()->json([
                    "message" => "CRM Informado não encontrado",
                    "status" => false
                ],400);
            }
            if($getIdPacient->count() < 1){
                return response()->json([
                    "message" => "Documento Informado não encontrado",
                    "status" => false
                ],400);
            }
            $getIdMedic = $getIdMedic->get()[0];
            $getIdPacient = $getIdPacient->get()[0];

            $data['medic_id'] = $getIdMedic->id;
            $data['pacient_id'] = $getIdPacient->id;

            $problems = Problems::find($id);

            if(!$problems){
                return response()->json([
                    "messsage"=>"Não foi possível encontrar o diagnostico informado.",
                    "status" => false
                ],400);
            }

            $problems->fill($data);
            $problems->save($data);

            return response()->json([
                "message"=> "Diagnostico registrado com sucesso.",
                "status"=> true
            ]);


        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição"], 500);
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
            $problem = Problems::find($id);
            if(!$problem){
                return response()->json([
                    "messsage"=>"Não foi possível encontrar o diagnostico informado.",
                    "status" => false
                ],400);
            }

            $problem->delete();

            return response()->json([
                "messsage"=>"Deletado com sucesso.",
                "status" => false
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição"], 500);
        }
    }
}
