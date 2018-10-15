<?php
/**
 * Created by PhpStorm.
 * User: servidor
 * Date: 15/10/18
 * Time: 09:18
 */

namespace App\Service;


use Illuminate\Http\Request;

interface Storage
{

    public function store(array $data, Request $request);
}