<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NegociationException;
use App\Http\Controllers\Controller;
use App\Model\Balance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    private $userModel;
    private $balanceModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->balanceModel = new Balance();
    }

    public function index() {
        $balance = $this->userModel->getBalance();
        return view("balance.index", compact("balance"));
    }

    public function transferir() {
        $peoples = User::all(["id", "name"]);
        return view("balance.transferir", compact("peoples"));
    }

    public function novaTransferir(Request $request) {
        try {
            $data = $request->except("_token");
            $this->userModel->transfer($data["amount"], $data["user_id_transaction"]);
            return redirect("/admin/balance");
        } catch(NegociationException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function sacar() {
        return view("balance.sacar");
    }

    public function novoSacar(Request $request) {
        try {
            $data = $request->only("amount");
            $this->balanceModel->drawnOut($data["amount"], auth()->id());
            return redirect("/admin/balance");
        } catch(NegociationException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function recarregar() {
        return view("balance.recarregar");
    }

    public function novaRecarregar(Request $request) {
        $newBalance = $request->except("_token");
        $idUser = auth()->id();

        $this->balanceModel->reload($newBalance["amount"], $idUser);
        return redirect("/admin/balance");
    }
}
