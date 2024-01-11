@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Show Proprietário</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>Detalhes do Owner</h2>
                </div>
                <div class="card">
                    <div class="card-header">{{$owner->name}}</div>

                    <div class="card-body">
                        {{$owner->email}}
                        {{$owner->dateBirth}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
