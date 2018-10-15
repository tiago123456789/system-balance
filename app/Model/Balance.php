<?php

namespace App\Model;

use App\Exceptions\NegociationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    protected $fillable = ['user_id', 'amount'];

    private $historicModel;

    public function __construct(array $attributes = [])
    {
        $this->historicModel = new Historic();
    }

    public function drawnOut($amount, $idUser) {
        DB::beginTransaction();
        $balance = $this->where("user_id", $idUser)->get()->first();

        if ($balance == null || $balance["amount"] < $amount) {
            throw new NegociationException("Operação não pode ser executada, devido saldo ser menor que o valor informado não operação.");
        }

        $balance["amount"] -= (float) $amount;
        $balance->save();
        $this->historicModel->register([ "amount" => $amount, "user_id" => $idUser ], Historic::SAIDA);
        DB::commit();
    }

    public function reload($amount, $idUser) {
        DB::beginTransaction();
        $balance = Balance::where("user_id", $idUser)->get()->first();

        if ($balance) {
            $balance["amount"] += $amount;
            $balance->save();
        } else {
            $balance = new Balance();
            $balance->amount = $amount;
            $balance->user_id = $idUser;
            $balance->save();
        }

        $this->historicModel->register([
            "amount" => $amount, "user_id" => $idUser
        ], Historic::ENTRADA);
        DB::commit();
    }
}
