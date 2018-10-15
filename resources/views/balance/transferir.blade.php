@extends('adminlte::page')

@section('title', 'System balance')

@section('content_header')
    <h1>Transferência</h1>
@stop

@section('content')
    <div class="col-lg-12 col-xs-12">
       <div class="box box-primary">
           <div class="box-body">
               <form action="{{ route("balance.transferir.nova") }}" method="post">

                   @include("elements.message")

                   {{ csrf_field() }}
                   <div class="form-group col-lg-6">
                       <label for="">Valor:</label>
                       <input type="text" name="amount" placeholder="Digite valor" class="form-control"/>
                   </div>

                   <div class="form-group col-lg-6">
                       <label for="user">Pessoa:</label>
                       <select type="text" name="user_id_transaction" id="user" class="form-control">
                           <option value="">Selecionar uma pessoa</option>
                           @foreach($peoples as $people)
                               <option value="{{ $people->id }}" >{{ $people->name }}</option>
                           @endforeach
                       </select>
                   </div>

                   <div class="form-group col-lg-12">
                       <input type="submit" class="btn btn-primary" value="Gravar"/>
                   </div>
               </form>
           </div>
       </div>
    </div>
@stop