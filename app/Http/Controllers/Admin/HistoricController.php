<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Historic;
use Illuminate\Http\Request;

class HistoricController extends Controller
{

    public function index(Historic $historic) {
        $filters = null;
        $historics = $historic->getHistorics([]);
        $tipos = $historic->getTiposOperacoes();
        return view("balance.historic", compact("historics", "tipos", "filters"));
    }

    public function searchHistoric(Request $request, Historic $historic) {
        $filters = $request->except("_token", "page") ?? [];
        $historics = $historic->getHistorics($filters);
        $tipos = $historic->getTiposOperacoes();
        return view("balance.historic", compact("historics", "tipos", "filters"));
    }

}
