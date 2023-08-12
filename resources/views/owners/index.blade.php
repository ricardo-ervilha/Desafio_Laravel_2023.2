@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciar Proprietários</h1>
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
                    <h3 class="card-title">Tabela de Proprietários</h3>
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
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Proprietário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-primary">

                            <form action="/owners/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="step-1" class="row step">
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome Completo</label>
                                                <input required name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">E-mail</label>
                                                <input required name="email" type="text" class="form-control" id="email" placeholder="Digite o e-mail">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Data de Nascimento</label>
                                                <input required name="dateBirth" type="date" class="form-control" id="dateBirth">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Telefone</label>
                                                <input  required name="phone" type="tel" maxlength="15" class="form-control phone" id="phone" placeholder="Digite o telefone">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">CPF</label>
                                                <input maxlength="14" required name="cpf" type="text" class="form-control cpf" id="cpf" placeholder="Digite o cpf">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputFile">Foto de Perfil</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="profilePhoto" class="form-control" type="file" id="profilePhoto">
                                                        <label for="formFile" class="form-label"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">CEP</label>
                                                <input  required maxlength="9" name="cep" type="text" class="form-control cep" id="cep" placeholder="Digite o cep">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Cidade</label>
                                                <input required name="city" type="text" class="form-control" id="city" placeholder="Digite a cidade">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Unidade Federativa</label>
                                                <select name="uf" id="uf" class="form-control">
                                                    <option value="AC">AC</option>
                                                    <option value="AL">AL</option>
                                                    <option value="AP">AP</option>
                                                    <option value="AM">AM</option>
                                                    <option value="BA">BE</option>
                                                    <option value="CE">CE</option>
                                                    <option value="DF">DF</option>
                                                    <option value="ES">ES</option>
                                                    <option value="GO">GO</option>
                                                    <option value="MA">MA</option>
                                                    <option value="MT">MT</option>
                                                    <option value="MS">MS</option>
                                                    <option value="MG">MG</option>
                                                    <option value="PA">PA</option>
                                                    <option value="PB">PB</option>
                                                    <option value="PR">PR</option>
                                                    <option value="PE">PE</option>
                                                    <option value="PI">PI</option>
                                                    <option value="RJ">RJ</option>
                                                    <option value="RN">RN</option>
                                                    <option value="RS">RS</option>
                                                    <option value="RO">RO</option>
                                                    <option value="RR">RR</option>
                                                    <option value="SC">SC</option>
                                                    <option value="SP">SP</option>
                                                    <option value="SE">SE</option>
                                                    <option value="TO">TO</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Logradouro</label>
                                                <input  required name="publicPlace" type="text" class="form-control" id="street" placeholder="Digite o logradouro">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bairro</label>
                                                <input  required name="district" type="text" class="form-control" id="district" placeholder="Digite o bairro">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Número</label>
                                                <input  required name="num" type="number" class="form-control" id="num" placeholder="Digite o número">
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
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($owners as $owner)
                    <tr>
                        <td>{{$owner->id}}</td>
                        <td>{{$owner->name}}</td>
                        <td>{{$owner->email}}</td>
                        <td>{{$owner->dateBirth}}</td>
                        <td><span class="tag tag-success">{{$owner->phone}}</span></td>
                        <td>
                            <button style="margin-right: 5px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalVisualizar{{$owner->id}}"><i class="fas fa-eye"></i></button>

                            <!-- Modal Visualização -->
                            <div class="modal fade" id="modalVisualizar{{$owner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar Usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="image text-center">
                                                <img src="{{$owner->profilePhoto == null ? asset('/storage/avatars/sem-imagem.jpg') :  asset("/storage/{$owner->profilePhoto}")}}" class="img-thumbnail" height="auto" width="150px">
                                            </div>

                                            <div class="card card-primary">

                                                <div id="step-1" class="row step">
                                                    <div class="col-sm">

                                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nome Completo</label>
                                                                <input disabled value="{{$owner->name}}"  required name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">E-mail</label>
                                                                <input disabled value="{{$owner->email}}"  required name="email" type="text" class="form-control" id="email" placeholder="Digite o e-mail">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Data de Nascimento</label>
                                                                <input disabled required value="{{$owner->dateBirth}}" name="dateBirth" type="date" class="form-control" id="dateBirth">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Telefone</label>
                                                                <input disabled value="{{$owner->phone}}" required name="phone" type="tel" maxlength="15" class="form-control phone" id="phone" placeholder="Digite o telefone">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">CPF</label>
                                                                <input disabled value="{{$owner->cpf}}"  required name="cpf" type="text" class="form-control" id="cpf" placeholder="Digite o cpf">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">CEP</label>
                                                                <input disabled value="{{$owner->address->cep}}" required maxlength="9" name="cep" type="text" class="form-control cep" id="cep" placeholder="Digite o cep">
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-sm">

                                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Cidade</label>
                                                                <input disabled value="{{$owner->address->city}}" required name="city" type="text" class="form-control" id="city" placeholder="Digite a cidade">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Unidade Federativa</label>
                                                                <select disabled name="uf" id="uf" class="form-control" >
                                                                    <option>{{$owner->address->uf}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Logradouro</label>
                                                                <input disabled value="{{$owner->address->publicPlace}}" required name="publicPlace" type="text" class="form-control" id="street" placeholder="Digite o logradouro">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Bairro</label>
                                                                <input disabled value="{{$owner->address->district}}"  required name="district" type="text" class="form-control" id="district" placeholder="Digite o bairro">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Número</label>
                                                                <input disabled value="{{$owner->address->num}}" required name="num" type="number" class="form-control" id="num" placeholder="Digite o número">
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button style="margin-right: 5px;" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{$owner->id}}"><i class="fas fa-edit"></i></button>


                            <!-- Modal Editar -->
                            <div class="modal fade" id="modalEditar{{$owner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Proprietário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card card-primary">

                                                <form action="/owners/edit/{{$owner->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div id="step-1" class="row step">
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nome Completo</label>
                                                                    <input required value="{{$owner->name}}" name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">E-mail</label>
                                                                    <input required value="{{$owner->email}}" name="email" type="text" class="form-control" id="email" placeholder="Digite o e-mail">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Data de Nascimento</label>
                                                                    <input required value="{{$owner->dateBirth}}" name="dateBirth" type="date" class="form-control" id="dateBirth">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Telefone</label>
                                                                    <input  required value="{{$owner->phone}}" name="phone" type="tel" maxlength="15" class="form-control phone" id="phone" placeholder="Digite o telefone">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">CPF</label>
                                                                    <input maxlength="14" value="{{$owner->cpf}}" required name="cpf" type="text" class="form-control cpf" id="cpf" placeholder="Digite o cpf">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputFile">Foto de Perfil</label>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input name="profilePhoto" class="form-control" type="file" id="profilePhoto">
                                                                            <label for="formFile" class="form-label"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">


                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">CEP</label>
                                                                    <input value="{{$owner->address->cep}}" required maxlength="9" name="cep" type="text" class="form-control cep" id="cep" placeholder="Digite o cep">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Cidade</label>
                                                                    <input value="{{$owner->address->city}}" required name="city" type="text" class="form-control" id="city" placeholder="Digite a cidade">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Unidade Federativa</label>
                                                                    <select name="uf" id="uf" class="form-control">
                                                                        <option {{$owner->address->uf == 'AC' ? 'selected' : ''}} value="AC">AC</option>
                                                                        <option {{$owner->address->uf == 'AL' ? 'selected' : ''}} value="AL">AL</option>
                                                                        <option {{$owner->address->uf == 'AP' ? 'selected' : ''}} value="AP">AP</option>
                                                                        <option {{$owner->address->uf == 'AM' ? 'selected' : ''}} value="AM">AM</option>
                                                                        <option {{$owner->address->uf == 'BA' ? 'selected' : ''}} value="BA">BE</option>
                                                                        <option {{$owner->address->uf == 'CE' ? 'selected' : ''}} value="CE">CE</option>
                                                                        <option {{$owner->address->uf == 'DF' ? 'selected' : ''}} value="DF">DF</option>
                                                                        <option {{$owner->address->uf == 'ES' ? 'selected' : ''}} value="ES">ES</option>
                                                                        <option {{$owner->address->uf == 'GO' ? 'selected' : ''}} value="GO">GO</option>
                                                                        <option {{$owner->address->uf == 'MA' ? 'selected' : ''}} value="MA">MA</option>
                                                                        <option {{$owner->address->uf == 'MT' ? 'selected' : ''}} value="MT">MT</option>
                                                                        <option {{$owner->address->uf == 'MS' ? 'selected' : ''}} value="MS">MS</option>
                                                                        <option {{$owner->address->uf == 'MG' ? 'selected' : ''}} value="MG">MG</option>
                                                                        <option {{$owner->address->uf == 'PA' ? 'selected' : ''}} value="PA">PA</option>
                                                                        <option {{$owner->address->uf == 'PB' ? 'selected' : ''}} value="PB">PB</option>
                                                                        <option {{$owner->address->uf == 'PR' ? 'selected' : ''}} value="PR">PR</option>
                                                                        <option {{$owner->address->uf == 'PE' ? 'selected' : ''}} value="PE">PE</option>
                                                                        <option {{$owner->address->uf == 'PI' ? 'selected' : ''}} value="PI">PI</option>
                                                                        <option {{$owner->address->uf == 'RJ' ? 'selected' : ''}} value="RJ">RJ</option>
                                                                        <option {{$owner->address->uf == 'RN' ? 'selected' : ''}} value="RN">RN</option>
                                                                        <option {{$owner->address->uf == 'RS' ? 'selected' : ''}} value="RS">RS</option>
                                                                        <option {{$owner->address->uf == 'RO' ? 'selected' : ''}} value="RO">RO</option>
                                                                        <option {{$owner->address->uf == 'RR' ? 'selected' : ''}} value="RR">RR</option>
                                                                        <option {{$owner->address->uf == 'SC' ? 'selected' : ''}} value="SC">SC</option>
                                                                        <option {{$owner->address->uf == 'SP' ? 'selected' : ''}} value="SP">SP</option>
                                                                        <option {{$owner->address->uf == 'SE' ? 'selected' : ''}} value="SE">SE</option>
                                                                        <option {{$owner->address->uf == 'TO' ? 'selected' : ''}} value="TO">TO</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Logradouro</label>
                                                                    <input value="{{$owner->address->publicPlace}}"  required name="publicPlace" type="text" class="form-control" id="street" placeholder="Digite o logradouro">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Bairro</label>
                                                                    <input value="{{$owner->address->district}}"  required name="district" type="text" class="form-control" id="district" placeholder="Digite o bairro">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Número</label>
                                                                    <input value="{{$owner->address->num}}" required name="num" type="number" class="form-control" id="num" placeholder="Digite o número">
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


                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeletar{{$owner->id}}">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="modalDeletar{{$owner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Deletar usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente deletar <strong>{{$owner->name}}</strong> ?
                                        </div>
                                        <form action="/owners/delete/{{$owner->id}}" method="POST">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $('.cep').mask('00000-000');
        $('.phone').mask('(00) 00000-0000');
        $('.cpf').mask('000.000.000-00');

        $(document).on('blur', '#cep', function(){
            const cep = $(this).val();
            $.ajax({
                url: 'https://viacep.com.br/ws/'+ cep + '/json/',
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.erro){
                        alert('Endereço não encontrado!');
                    }else{
                        $('#uf').val(data.uf.toUpperCase());
                        $('#city').val(data.localidade);
                        $('#street').val(data.logradouro);
                        $('#district').val(data.bairro);
                    }
                }
            });
        });

    </script>
@stop
