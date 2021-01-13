<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pacients;
use App\Models\Phones;
use Illuminate\Http\Request;

class PhonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $data = $request->all();

            if(!Pacients::find($data['pacient_id'])){
                return response()->json([
                    'message' => 'Usuário não encontrado',
                    'status' => false
                ], 400);
            }

            if($data['main'] == true){
                $listPhones = Phones::where('pacient_id',$data['pacient_id'])->get();
              

                foreach($listPhones as &$item){
                    if($item['main'] == true && $item['number'] != $data['number']){
                        return response()->json([
                            "message"=> "{$item['number']} já está definido como princiapal",
                            "status" => false
                        ]);
                    }
                }
            }



            $phones = new Phones();
            $phones->fill($data);
            if($phones->save($data)){
                return response()->json([
                    "message" => "Novo número de telefone cadastrado."
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                "message"=>"Não foi possível executar essa ação.",
                "status" => false
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idPacient)
    {
        try{
            $phones = Phones::where('pacient_id', $idPacient)->get();
            if(count($phones) == 0){
                return response()->json([
                    "message" => "Não foi encontrado nenhum telefone do ID solicitado"
                ]);
            }
    
            if(!Pacients::find($idPacient)){
                return response()->json([
                    "message"=>"Usuário não encontrado",
                    "status" => false
                ], 400);
            }

            return response()->json([
                "message" => "Lista de telefones",
                "stauts" => true,
                "data" => $phones
            ]);

        }catch(\Exception $e){
          

            return response()->json([
                "message"=>"Não foi possível executar essa ação.",
                "status" => false
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPhone)
    {
        try{
            $data = $request->all();

            if(!Phones::find($idPhone)){
                return response()->json([
                    'message' => 'Telefone não encontrado.',
                    'status' => false
                ], 400);
            }

            if($data['main'] == true){
                $listPhones = Phones::where('pacient_id',$data['pacient_id'])->get();
              

                foreach($listPhones as &$item){
                    if($item['main'] == true && $item['number'] != $data['number']){
                        return response()->json([
                            "message"=> "{$item['number']} já está definido como princiapal",
                            "status" => false
                        ]);
                    }
                }
            }
            $phones = Phones::find($idPhone);
            $phones->fill($data);
            if($phones->save($data)){
                return response()->json([
                    "message" => "Número editado com sucesso.",
                    "status" => true
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                "message"=>"Não foi possível executar essa ação.",
                "status" => false
            ], 500);
        }
    }

    public function updateMain($idPacient, $idNew){


        try{
            if(!Pacients::find($idPacient)){
                return response()->json([
                    "message" => "Não foi possível encontrar o ID informado.",
                    "stauts" => false
                ], 400);
            }


            $old = Phones::where('pacient_id', $idPacient)
                ->where('main', true);


            if(count($old->get()) > 0){
                $old->update(['main' => false]);
            }
            
            Phones::where('pacient_id', $idPacient)
                ->where('id', $idNew)
                ->update(['main' => true]);
            
            return response()->json([
                "message" => "Número principal alterado com sucesso.",
                "stauts" => true
            ]);


        }catch(\Exception $e){
            return response()->json([
                "message"=>"Não foi possível executar essa ação.",
                "status" => false
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPhone)
    {
        //

        try{

            $phone = Phones::find($idPhone);
            if(!$phone){
                return response()->json([
                    "message" => "Não foi possível encontrar o ID informado.",
                    "stauts" => false
                ], 400);
            }

            if($phone->main == true){
                return response()->json([
                    "message" => "Esse número está marcado como principal, não e possível deleta-ló.",
                    "stauts" => false
                ], 400);
            }

            $phone->delete();

            return response()->json([
                "message" => "Número deletado com sucesso.",
                "stauts" => true
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message"=>"Não foi possível executar essa ação.",
                "status" => false
            ], 500);
        }
    }
}
