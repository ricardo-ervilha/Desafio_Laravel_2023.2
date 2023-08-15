@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciar Animais</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div  class="card-header">
            <div style="align-items: center" class="row">
                <div class="col-sm">
                    <h3 class="card-title">Tabela de Animais</h3>
                </div>
                <div style="display: flex; justify-content: flex-end; align-items: center" class="col-sm">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button style="margin-left: 1rem" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Cadastro -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Animal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-primary">

                            <form action="/animals/create" method="POST">
                                @csrf
                                <div id="step-1" class="row step">
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome</label>
                                                <input required name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Proprietário</label>
                                                <select name="owner_id" class="form-control">
                                                    @foreach($owners as $owner)
                                                        <option value="{{$owner->id}}">{{$owner->id}} - {{$owner->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Espécie</label>
                                                <input required name="species" type="text" class="form-control" id="name" placeholder="Digite a espécie">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Raça</label>
                                                <input required name="breed" type="text" class="form-control" id="name" placeholder="Digite a raça">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Data de Nascimento</label>
                                                <input required name="dateBirth" type="date" class="form-control" id="dateBirth">
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div style="display: flex; align-items: center; justify-content: flex-end" class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--Fim Modal Cadastro-->


        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($animals as $animal)
                    <tr>
                        <td>{{$animal->id}}</td>
                        <td>{{$animal->name}}</td>
                        <td>{{$animal->dateBirth}}</td>
                        <td>
                            <button style="margin-right: 5px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalVisualizar{{$animal->id}}"><i class="fas fa-eye"></i></button>

                            <!-- Modal Visualização -->
                            <div class="modal fade" id="modalVisualizar{{$animal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar Animal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card card-primary">

                                                <div id="step-1" class="row step">
                                                    <div class="col-sm">

                                                        <div style="padding-bottom: 0 !important;" class="card-body">

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nome</label>
                                                                <input disabled required name="name" value="{{$animal->name}}" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Proprietário</label>
                                                                <select disabled name="owner_id" class="form-control">
                                                                    <option> {{$animal->owner_id}} - {{\App\Models\Owner::find($animal->owner_id)->name}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Espécie</label>
                                                                <input required disabled name="species" value="{{$animal->species}}" type="text" class="form-control" id="name" placeholder="Digite a espécie">
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-sm">

                                                        <div style="padding-bottom: 0 !important;" class="card-body">

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Raça</label>
                                                                <input disabled value="{{$animal->breed}}" required name="breed" type="text" class="form-control" id="name" placeholder="Digite a raça">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Data de Nascimento</label>
                                                                <input disabled required value="{{$animal->dateBirth}}" name="dateBirth" type="date" class="form-control" id="dateBirth">
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button style="margin-right: 5px;" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{$animal->id}}"><i class="fas fa-edit"></i></button>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="modalEditar{{$animal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Animal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card card-primary">

                                                <form action="/animals/edit/{{$animal->id}}" method="POST">
                                                    @csrf
                                                    <div id="step-1" class="row step">
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nome</label>
                                                                    <input value="{{$animal->name}}" required name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Espécie</label>
                                                                    <input value="{{$animal->species}}" required name="species" type="text" class="form-control" id="name" placeholder="Digite a espécie">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Raça</label>
                                                                    <input value="{{$animal->breed}}" required name="breed" type="text" class="form-control" id="name" placeholder="Digite a raça">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Data de Nascimento</label>
                                                                    <input value="{{$animal->dateBirth}}" required name="dateBirth" type="date" class="form-control" id="dateBirth">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div style="display: flex; align-items: center; justify-content: flex-end" class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Fim Modal Editar-->


                            <button style="margin-right: 5px;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeletar{{$animal->id}}">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="modalDeletar{{$animal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Deletar animal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente deletar <strong>{{$animal->name}}</strong> ?
                                        </div>
                                        <form action="/animals/delete/{{$animal->id}}" method="POST">
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="">
                                <i class="fas fa-solid fa-stethoscope" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>
@stop
