@extends('adminlte::page')

@section('title', 'System balance')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')
    <div class="col-lg-12 col-xs-12">
        <a href="{{ route("balance.recarregar") }}" class="btn btn-primary">
            <i class="fa fa-cart-plus"></i>&nbsp;Recarregar</a>
        <a href="{{ route("balance.sacar") }}" class="btn btn-danger">
            <i class="fa fa-cart-arrow-down"></i>&nbsp;Sacar</a>
        <a href="{{ route("balance.transferir") }}" class="btn btn-warning">
            <i class="fa fa-exchange"></i>&nbsp;Transferir</a>
        <br/>
        <br/>
        <div class="small-box bg-green">
            <div class="inner">
                <h3>R$ {{ number_format($balance["amount"], 2, ",", ".") }}</h3>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">Show historic &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
@stop