<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Pacients;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
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

            if(!Pacients::find($data['pacient_id'])){
                return response()->json([
                    'message' => 'Usuário não encontrado',
                    'status' => false
                ], 400);
            }

            if($data['main'] == true){
                $listAddress = Address::where('pacient_id',$data['pacient_id'])->get();
            

                foreach($listAddress as &$item){
                    if($item['main'] == true){
                        return response()->json([
                            "message"=> "{$item['id']} já está definido como princiapal",
                            "status" => false
                        ]);
                    }
                }
            }



            $address = new Address();
            $address->fill($data);
            if($address->save($data)){
                return response()->json([
                    "message" => "Novo endereço cadastrado."
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
            $address = Address::where('pacient_id', $idPacient)->get();
            if(count($address) == 0){
                return response()->json([
                    "message" => "Não foi encontrado nenhum endereço do ID solicitado"
                ]);
            }
    
            if(!Pacients::find($idPacient)){
                return response()->json([
                    "message"=>"Usuário não encontrado",
                    "status" => false
                ], 400);
            }

            return response()->json([
                "message" => "Lista de endereços",
                "stauts" => true,
                "data" => $address
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
    public function update(Request $request, $idAddress)
    {
        try{
            $data = $request->all();

            if(!Address::find($idAddress)){
                return response()->json([
                    'message' => 'Telefone não encontrado.',
                    'status' => false
                ], 400);
            }

            if($data['main'] == true){
                $listAddress = Address::where('pacient_id',$data['pacient_id'])->get();
              

                foreach($listAddress as &$item){
                    if($item['main'] == true){
                        return response()->json([
                            "message"=> "{$item['id']} já está definido como principal.",
                            "status" => false
                        ]);
                    }
                }
            }
            $address = Address::find($idAddress);
            $address->fill($data);
            if($address->save($data)){
                return response()->json([
                    "message" => "Endereço editado com sucesso.",
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


            $old = Address::where('pacient_id', $idPacient)
                ->where('main', true);


            if(count($old->get()) > 0){
                $old->update(['main' => false]);
            }
            
            Address::where('pacient_id', $idPacient)
                ->where('id', $idNew)
                ->update(['main' => true]);
            
            return response()->json([
                "message" => "Endereço principal alterado com sucesso.",
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
    public function destroy($idAddress)
    {
        try{

            $address = Address::find($idAddress);
            if(!$address){
                return response()->json([
                    "message" => "Não foi possível encontrar o ID informado.",
                    "stauts" => false
                ], 400);
            }

            if($address->main == true){
                return response()->json([
                    "message" => "Esse endereço está marcado como principal, não e possível deleta-ló.",
                    "stauts" => false
                ], 400);
            }

            $address->delete();

            return response()->json([
                "message" => "Endereço deletado com sucesso.",
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
