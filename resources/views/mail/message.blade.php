@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Enviar E-mails</h1>
@stop

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Envie uma mensagem para os proprietários do sistema</h3>
        </div>

        <div class="card-body">
            <textarea class="form-control" rows="10" placeholder="Digite aqui..."></textarea>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
            </div>
            <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Limpar</button>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
@stop
