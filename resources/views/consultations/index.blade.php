@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciar Consultas</h1>
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
                    <h3 class="card-title">Tabela de Consultas</h3>
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
                        <i class="fas fa-calendar-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Cadastro -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agendar Consulta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-primary">

                            <form action="/consultations/create" method="POST">
                                @csrf
                                <div id="step-1" class="row step">
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Data e Hora de Início</label>
                                                <input required name="startDate" type="datetime-local" class="form-control" id="startDate">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Data e Hora de Término</label>
                                                <input required name="endDate" type="datetime-local" class="form-control" id="endDate">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Proprietário</label>
                                                <select id="owners" name="owner_id" class="form-control">
                                                    @foreach($owners as $owner)
                                                        <option value="{{$owner->id}}">{{$owner->id}} - {{$owner->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Animal</label>
                                                <select id="animals" name="animal_id" class="form-control">
                                                    @foreach($animals as $animal)
                                                        <option value="{{$animal->id}}">{{$animal->id}} - {{$animal->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Custo</label>
                                                <input name="coast" type="text" class="form-control" id="valorMonetario" placeholder="Digite o custo">
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
                    <th>Nome do Animal</th>
                    <th>Data de Início</th>
                    <th>Data de Término</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{$consultation->id}}</td>
                        <td>{{\App\Models\Animal::find($consultation->animal_id)->name}}</td>
                        <td>{{$consultation->startDate}}</td>
                        <td>{{$consultation->endDate}}</td>
                        <td>
                            <button style="margin-right: 5px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalVisualizar{{$consultation->id}}"><i class="fas fa-eye"></i></button>

                            <!-- Modal Visualização -->
                            <div class="modal fade" id="modalVisualizar{{$consultation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar Consulta</h5>
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
                                                                    <label for="exampleInputEmail1">Data e Hora de Início</label>
                                                                    <input disabled value="{{$consultation->startDate}}" required name="startDate" type="datetime-local" class="form-control" id="startDate">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Data e Hora de Término</label>
                                                                    <input disabled value="{{$consultation->endDate}}" required name="endDate" type="datetime-local" class="form-control" id="endDate">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Proprietário</label>
                                                                    <input disabled value="{{\App\Models\Owner::find(\App\Models\Animal::find($consultation->animal_id)->owner_id)->name}}" type="text" class="form-control">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Animal</label>
                                                                    <input disabled value="{{\App\Models\Animal::find($consultation->animal_id)->name}}" type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Funcionário</label>
                                                                    <input disabled value="{{\App\Models\User::find($consultation->user_id)->name}}" type="text" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Custo</label>
                                                                    <input disabled value="R$ {{str_replace('.', ',', $consultation->coast)}}" name="coast" type="text" class="form-control" id="valorMonetario" placeholder="Digite o custo">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>


                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Fim Modal Visualização-->


                            <button onclick="popularTextareas({{$consultation->id}}, '{{$consultation->treatment == null ? '' : $consultation->treatment->diagnostic}}', '{{$consultation->treatment == null ? '' : $consultation->treatment->guidelines}}', '{{$consultation->treatment == null ? '' : $consultation->treatment->medicines}}', '{{$consultation->treatment == null ? '' : $consultation->treatment->extraInfos}}')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalTratamento{{$consultation->id}}">
                                <i class="fas fa-solid fa-prescription" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Cadastrar Tratamento -->
                            <div class="modal fade" id="modalTratamento{{$consultation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Adicionar Tratamento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card card-primary">

                                                <form action="/consultations/{{$consultation->id}}/treatment/create" method="POST">
                                                    @csrf
                                                    <div id="step-1" class="row step">
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Diagnóstico</label>
                                                                    <textarea name="diagnostic" id="diagnostic{{$consultation->id}}" class="form-control" rows="3" placeholder="Digite o diagnóstico"></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Orientações</label>
                                                                    <textarea name="guidelines" id="guidelines{{$consultation->id}}" class="form-control" rows="3" placeholder="Digite as orientações"></textarea>
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Medicamentos</label>
                                                                    <textarea name="medicines" id="medicines{{$consultation->id}}" class="form-control" rows="3" placeholder="Digite os medicamentos"></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Informações Adicionais</label>
                                                                    <textarea name="extraInfos" id="extraInfos{{$consultation->id}}" class="form-control" rows="3" placeholder="Digite as informações adicionais"></textarea>
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
                            <!--Fim Modal Cadastrar Tratamento-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        //Parte para adicionar a máscara no campo de custo.
        $(document).ready(function() {
            $('#valorMonetario').maskMoney({
                prefix: 'R$ ',     // Prefixo para o símbolo monetário
                thousands: '.',    // Separador de milhares
                decimal: ',',      // Separador decimal
                affixesStay: true, // Manter o prefixo e sufixo sempre visíveis
                allowZero: true    // Permitir que o valor seja zero
            });
        });


        //Requisição assíncrona para atualizar os animais disponíveis com base no proprietário escolhido.
        $(document).on('change', '#owners', function(){
            $("#animals").html(''); //Limpa o select de animais
            var valor = $("option:selected", this).val();
            $.ajax({
                url: `/owner-animals/${valor}`,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    for(var i = 0; i < data.length; i++){
                        $("#animals").append($("<option></option>").text(data[i].id + " - " + data[i].name).val(data[i].id))
                    }
                }
            });
        });

        function popularTextareas(consultId, diagnostic, guidelines, medicines, extraInfos) {
            var diagnosticElement = document.getElementById(`diagnostic${consultId}`);
            var guidelinesElement = document.getElementById(`guidelines${consultId}`);
            var medicinesElement = document.getElementById(`medicines${consultId}`);
            var extraInfosElement = document.getElementById(`extraInfos${consultId}`);

            if(diagnostic != ''){
                diagnosticElement.value = diagnostic;
                diagnosticElement.disabled = true;
                guidelinesElement.value = guidelines;
                guidelinesElement.disabled = true;
                medicinesElement.value = medicines;
                medicinesElement.disabled = true;
                extraInfosElement.value = extraInfos;
                extraInfosElement.disabled = true;
            }

        }
    </script>
@stop
