<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Pacients;
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
        $data = $request->all();
        $address = $data['main_address'];
        $address['main_address']['main'] = true;
        $phones = $data['phones'];
        unset($data['main_address'], $data['phones']);
        $newPacient = new Pacients();
        $newPacient->fill($data);
        $newPacient->save();
        $idPacient = $newPacient->id;
        if($newPacient){
            return response()->json(['message' => "Usuário criado com sucesso."]);
        }


        return response()->json(['message'=> "Houve um erro ao executar essa funcionalidade."]);

       }catch(\Exception $e){
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
