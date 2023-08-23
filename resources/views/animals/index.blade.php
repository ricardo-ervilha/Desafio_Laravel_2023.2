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
                            <form class="d-flex" action="/animals/search" method="GET">
                                <input type="text" name="search" class="form-control float-right" placeholder="Buscar">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button style="margin-left: 1rem" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-paw"></i>
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

                            <button style="margin-right: 5px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalTratamentos{{$animal->id}}">
                                <i class="fas fa-solid fa-stethoscope" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Tratamentos -->
                            <div class="modal fade" id="modalTratamentos{{$animal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tratamentos do Animal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            @foreach($animalConsultations[$animal->id] as $index => $consult)

                                                <div id="step{{$index}}{{$animal->id}}" class="card card-primary {{$index != 0 ? 'd-none' : ''}}" data-current-step="{{$index}}">
                                                    <div class="card-header">

                                                        <h3 class="card-title">Consulta iniciada em <strong> {{$consult->startDate}}</strong> e terminada em
                                                            <strong>{{$consult->endDate}}</strong></h3>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Funcionário</label>
                                                            <input disabled value="{{\App\Models\User::find($consult->user_id)->name}}" name="user" id="user" type="text" class="form-control" rows="3">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Diagnóstico</label>
                                                            <textarea disabled name="diagnostic" id="diagnostic" class="form-control" rows="3">{{\App\Models\Treatment::find($consult->treatment_id)->diagnostic}}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Medicamentos</label>>
                                                            <textarea disabled value="" name="diagnostic" id="medicines" class="form-control" rows="3">{{\App\Models\Treatment::find($consult->treatment_id)->medicines}}</textarea>
                                                        </div>

                                                    </div>

                                                </div>
                                            @endforeach

                                                <div style="display: flex; align-items: center; justify-content: flex-end" class="card-footer">
                                                    <button onclick="atualizarModalPrev({{$animal->id}})" type="button" id="nextBtn" class="btn btn-primary">Prev</button>
                                                    <button style="margin-left: 1rem;" onclick="atualizarModalNext({{count($animalConsultations[$animal->id])}}, {{$animal->id}})" type="button" id="nextBtn" class="btn btn-primary">Next</button>
                                                </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Fim Modal Tratamentos-->



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

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$animals->links()}}
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

        function atualizarModalPrev(animalId) {
            const modal = $("#modalTratamentos" + animalId);
            const currentStep = parseInt(modal.find(".card:visible").attr("data-current-step"));

            if (currentStep >= 1) {
                modal.find("#step" + currentStep + animalId).addClass("d-none");
                const newStep = currentStep - 1;
                modal.find("#step" + newStep + animalId).removeClass("d-none").attr("data-current-step", newStep);
            }
        }

        function atualizarModalNext(val, animalId) {
            const modal = $("#modalTratamentos" + animalId);
            const currentStep = parseInt(modal.find(".card:visible").attr("data-current-step"));

            if (currentStep < val - 1) {
                modal.find("#step" + currentStep + animalId).addClass("d-none");
                const newStep = currentStep + 1;
                modal.find("#step" + newStep + animalId).removeClass("d-none").attr("data-current-step", newStep);
            }
        }

    </script>
@stop
