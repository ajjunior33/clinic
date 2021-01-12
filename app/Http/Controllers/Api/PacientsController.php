<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Pacients;
use App\Models\Phones;
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
        dd($e);
        return response()->json(['message'=>"Houve um erro ao processar sua requisição", 'e' => $e]);
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
