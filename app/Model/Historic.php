<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = ["user_id", "amount", "total_before", 'type'];

    const ENTRADA = "I";
    const SAIDA = "S";
    const TRANSACAO = "T";

    public function register($datas, $operation) {
        $datas["total_before"] = $this->getTotalBefore($datas["user_id"]);
        $datas["type"] = $operation;

        Historic::create($datas);
    }

    public function getHistorics(array $filters, $quantityItensDisplay = 5) {
        $existFilters = count($filters);

        if ($existFilters) {
            $filters = array_filter($filters, function($value) {
                if ($value != null || $value != 'null') return $value;
            });

            return $this->where(function($query) use($filters) {
                        foreach ($filters as $key => $value) {

                            if ($key == "type") {
                                $value =  $this->getTipoOperacao($value);
                            }

                           $query->where($key, $value);
                        }
                    })->paginate($quantityItensDisplay);
        }

        return $this->where("user_id", auth()->id())->paginate($quantityItensDisplay);
    }

    public function getTiposOperacoes() {
        return [ "ENTRADA", "SAIDA", "TRANSACAO" ];
    }

    private function getTipoOperacao($typeOperacao) {
        if ($typeOperacao == 'ENTRADA') {
            return Historic::ENTRADA;
        } else if($typeOperacao == 'SAIDA') {
            return Historic::SAIDA;
        } else {
            return Historic::TRANSACAO;
        }
    }

    private function getTotalBefore($idUser)
    {
        $historics = Historic::where("user_id", $idUser)->get();
        $totalBefore = 0;


        if (count($historics)) {
            foreach ($historics as $historic) {
                $totalBefore += (float) $historic["amount"];
            }
        }

        return $totalBefore;
    }
}
