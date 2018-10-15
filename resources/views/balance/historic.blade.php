@extends('adminlte::page')

@section('title', 'System balance')

@section('content_header')
    <h1>Historics</h1>
@stop

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <form action="{{ route("balance.historic.search") }}" method="get" >
                    {{ csrf_field() }}
                    <div class="form-group col-md-3">
                        <label for="id">Id:</label>
                        <input type="text" name="id" class="form-control"/>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="type">Tipo:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Selecionar um tipo</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo }}">{{$tipo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3" style="margin-top: 22px">
                        <input type="submit" class="btn btn-primary" value="Search" />
                    </div>
                </form>

                <a href="{{ route("balance.historic") }}" class="btn btn-default pull-right" style="margin-top: 20px">
                    <i class="fa fa-trash"></i>&nbsp;Clear filters</a>
            </div>
            <div class="box-body">
                @if(count($historics) == 0)
                    <p class="text-bold">Nenhum registro encontrado!</p>
                    @else
                    @endif
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Valor anterior</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                    </tr>
                    </thead>
                    @foreach($historics as $historic)
                        <tbody>
                            <tr>
                                <td>{{ $historic->id }}</td>
                                <td>{{ number_format($historic->total_before, "2", ",", ".") }}</td>
                                <td>{{ number_format($historic->amount, "2", ",", ".") }}</td>
                                <td>
                                     @if($historic->type == "I")
                                        Entrada
                                     @elseif($historic->type == "S")
                                        Saída
                                     @else
                                        Transação
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach

                </table>
                    @if($filters)
                        {{ $historics->appends($filters)->links() }}
                    @endif

                    @if(!$filters)
                        {{ $historics->links() }}
                    @endif
            </div>
        </div>
    </div>
@stop