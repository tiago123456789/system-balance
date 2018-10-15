@extends('adminlte::page')

@section('title', 'System balance')

@section('content_header')
    <h1>Recarregar</h1>
@stop

@section('content')
    <div class="col-lg-12 col-xs-12">
       <div class="box box-primary">
           <div class="box-body">
               <form action="{{ route("balance.recarregar.nova") }}" method="post">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <label for="">Valor:</label>
                       <input type="text" name="amount" placeholder="Digite valor" class="form-control"/>
                   </div>

                   <div class="form-group">
                       <input type="submit" class="btn btn-primary" value="Gravar"/>
                   </div>
               </form>
           </div>
       </div>
    </div>
@stop