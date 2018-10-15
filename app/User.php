<?php

namespace App;

use App\Model\Balance;
use App\Model\Historic;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private $historicModel;

    private $balanceModel;

    public function __construct() {
        $this->historicModel = new Historic();
        $this->balanceModel = new Balance();
    }

    public function balance() {
        return $this->hasOne(Balance::class);
    }

    public function historics() {
        return $this->hasMany(Historic::class);
    }

    public function transfer($amountTransfer, $idUserTransfer) {
        DB::beginTransaction();
        $idUser = \auth()->id();
        $this->balanceModel->drawnOut($amountTransfer, $idUser);
        $this->balanceModel->reload($amountTransfer, $idUserTransfer);

        $this->historicModel->register([
            "amount" => $amountTransfer, "user_id" => $idUser, "user_id_transaction" => $idUserTransfer
        ], Historic::TRANSACAO);
        DB::commit();
    }

    public function getBalance() {
        $balance = \auth()->user()->balance;
        return $balance;
    }
}
