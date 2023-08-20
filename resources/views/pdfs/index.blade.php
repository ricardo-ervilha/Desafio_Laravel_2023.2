@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerar Relatório</h1>
@stop

@section('content')
    <form action="/pdf/generate" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Ano</label>
            <select style="width: 22%;" id="year" name="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-info">Gerar Relatório Geral de Consultas</button>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
@stop
