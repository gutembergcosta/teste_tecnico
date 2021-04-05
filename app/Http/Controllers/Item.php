<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ModelItem;
use App\Models\ModelCategoria;
use App\Models\ModelTimes;
use Validator;

class Item extends Controller
{
    
    private $modelTimes;

    public function __construct(){
        $this->modelTimes = new ModelTimes();
    }

    public function pagina($id = false)
    {
        $data['times'] = $this->modelTimes->select("*")->orderBy("pontos", "desc")->get();
        $data['timesSelect'] = $this->modelTimes->select("*")->orderBy("nome", "asc")->get();

        return view('pagina')->with('data', $data);
    }

    public function salvar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'time_casa' => 'required',
            'time_visitante' => 'required',
            'placar_casa' => 'required|integer|min:0',
            'placar_visitante' => 'required|integer|min:0',
        ]);

        if($validator->fails() ){
            return response()->json([
                'status' => 1,
                'error'=>$validator->errors()->all()]
            );
        }

        if($request->time_casa == $request->time_visitante){
            return response()->json([
                'status' => 0,
                'msg' => 'Os times não podem ser idênticos'
            ]);
        }

        if($request->placar_casa > $request->placar_visitante){

            $timeVencedor = $this->modelTimes->find($request->time_casa);
            $timeVencedor->increment('pontos',3);
            $timeVencedor->increment('jogos',1);
            $timeVencedor->increment('vitorias',1);
            if($request->placar_casa > 0){$timeVencedor->increment('gols_feitos', $request->placar_casa);}
            if($request->placar_visitante > 0){$timeVencedor->increment('gols_sofridos', $request->placar_visitante);}
            $timeVencedor->save();
            
            
            $timePerdedor = $this->modelTimes->find($request->time_visitante);
            $timePerdedor->increment('jogos',1);
            $timePerdedor->increment('derrotas',1);
            if($request->placar_visitante > 0){$timePerdedor->increment('gols_feitos', $request->placar_visitante);}
            if($request->placar_casa > 0){$timePerdedor->increment('gols_sofridos', $request->placar_casa);}
            $timePerdedor->save();

        }elseif($request->placar_casa < $request->placar_visitante){

            $timeVencedor = $this->modelTimes->find($request->placar_visitante);
            $timeVencedor->increment('pontos',3);
            $timeVencedor->increment('jogos',1);
            $timeVencedor->increment('vitorias',1);
            if($request->placar_casa > 0){$timeVencedor->increment('gols_feitos', $request->placar_casa);}
            if($request->placar_visitante > 0){$timeVencedor->increment('gols_sofridos', $request->placar_visitante);}
            $timeVencedor->save();

            $timePerdedor = $this->modelTimes->find($request->time_casa);
            $timePerdedor->increment('jogos',1);
            $timePerdedor->increment('derrotas',1);
            if($request->placar_visitante > 0){$timePerdedor->increment('gols_feitos', $request->placar_visitante);}
            if($request->placar_casa > 0){$timePerdedor->increment('gols_sofridos', $request->placar_casa);}
            $timePerdedor->save();

        }else{

            $timeVencedor = $this->modelTimes->find($request->time_casa);
            $timeVencedor->increment('pontos',1);
            $timeVencedor->increment('jogos',1);
            $timeVencedor->increment('empates',1);
            if($request->placar_casa > 0){$timeVencedor->increment('gols_feitos', $request->placar_casa);}
            if($request->placar_visitante > 0){$timeVencedor->increment('gols_sofridos', $request->placar_visitante);}
            $timeVencedor->save();

            $timePerdedor = $this->modelTimes->find($request->time_visitante);
            $timePerdedor->increment('pontos',1);
            $timePerdedor->increment('jogos',1);
            $timePerdedor->increment('empates',1);
            if($request->placar_visitante > 0){$timePerdedor->increment('gols_feitos', $request->placar_visitante);}
            if($request->placar_casa > 0){$timePerdedor->increment('gols_sofridos', $request->placar_casa);}
            $timePerdedor->save();

        }
       
        return response()->json([
            'status' => 2,
            'msg' => 'Dados do confronto atualizados!',
            'campeonato' => $this->modelTimes->select("*")->orderBy("pontos", "desc")->get()
        ]);

    }


}
