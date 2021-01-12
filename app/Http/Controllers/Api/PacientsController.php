<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Pacients;
use App\Models\Phones;
use Exception;
use Illuminate\Http\Request;

class PacientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pacients = Pacients::all();

        return response()->json($pacients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      
       try{
           $newPacient = new Pacients();
           $newAddress = new Address();
           $newPhone  = new Phones();
        $data = $request->all();
        $dataPhones = $data['phones'];
        
            
        $dataAddress = $data['main_address'];
        $dataAddress['main'] = true;
            
        unset($data['main_address'], $data['phones']);


        $newPacient->fill($data);
        $newPacient->save();
        $idPacient = $newPacient->id;

        if($newPacient){

            $dataAddress['pacient_id'] = $idPacient;
            $newAddress->fill($dataAddress);
            $newAddress->save($dataAddress);

            foreach($dataPhones as $item){
                $item['pacient_id'] = $idPacient;

                $newPhone->fill($item);
                $newPhone->save($item);
            }


            return response()->json([
                'message' => "Paciente cadastrado com sucesso.",
                "status" => true
            ]);

        }


        return response()->json(['message'=> "Houve um erro ao executar essa funcionalidade."]);

       }catch(\Exception $e){
        return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
       }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        //
        try{

            $pacient = Pacients::firstWhere('document', $document);    

            if(!$pacient){
                return response()->json([
                    "message"=>"Não encontrei o documento informado $document."
                ], 400);
            }
            return response()->json($pacient);
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
        //

        try{
            $updatePacients = Pacients::find($id);
            if(!$updatePacients){
                return response()->json([
                    "message"=>"Não encontrei o usuário informado."
                ], 400);
            }
            $updatePacients->fill($request->all());
            $updatePacients->save($request->all());

            return response()->json([
                "message"=> "Usuário editado com sucesso.",
                "status" => true
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
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
            $pacient = Pacients::find($id);
            if(!$pacient){
                return response()->json([
                    "message"=>"Não encontrei o usuário informado."
                ], 400);
            }
            $pacient->delete();
            return response()->json([
                "message" => "Usuário excluído com sucesso."
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e], 500);
        }
    }
}
