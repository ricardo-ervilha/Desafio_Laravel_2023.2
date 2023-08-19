@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Enviar E-mails</h1>
@stop

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Envie uma mensagem para os proprietários do sistema</h3>
        </div>
        <form action="/email/send" method="POST">
            @csrf
            <div class="card-body">
                <label for="h2">Título</label>
                <input type="text" name="header" class="form-control" placeholder="Título...">
            </div>
            <div class="card-body">
                <label for="h2">Saudações</label>
                <input type="text" name="greetings" class="form-control" placeholder="Saudações...">
            </div>
            <div class="card-body">
                <label for="firstParagraph">Primeiro parágrafo</label>
                <textarea name="firstParagraph" class="form-control" rows="4" placeholder="Primeira parte..."></textarea>
            </div>
            <div class="card-body">
                <label for="h2">Segundo parágrafo</label>
                <textarea name="secondParagraph" class="form-control" rows="4" placeholder="Segunda parte..."></textarea>
            </div>
            <div class="card-body">
                <label for="h2">Agradecimentos</label>
                <input type="text" name="thanks" class="form-control"  placeholder="Agradecimentos...">
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Limpar</button>
            </div>
        </form>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
@stop
