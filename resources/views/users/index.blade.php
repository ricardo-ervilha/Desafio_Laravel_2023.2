@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciar Usuários do Sistema</h1>
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

{{--    @can('isAdmin', '\App\Models\User')--}}
{{--        <p>Só mostra o parágrafo para quem é administrador.</p>--}}
{{--    @endcan--}}

    <div class="card">
        <div  class="card-header">
            <div style="align-items: center" class="row">
                <div class="col-sm">
                    <h3 class="card-title">Tabela de Usuários</h3>
                </div>
                <div style="display: flex; justify-content: flex-end; align-items: center" class="col-sm">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <form class="d-flex" action="/users/search" method="GET">
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
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-primary">

                            <form action="{{route('users.create')}}" method="POST">
                                @csrf
                                <div id="step-1" class="row step">
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome Completo</label>
                                                <input required name="name" type="text" class="form-control" id="name" placeholder="Digite o nome">
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
                                                <label for="exampleInputPassword1">Período de Trabalho</label>
                                                <input required name="workTime" type="number" class="form-control" id="workTime" placeholder="Digite o período">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">CEP</label>
                                                <input  required maxlength="9" name="cep" type="text" class="form-control cep" id="cep" placeholder="Digite o cep">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm">

                                        <div style="padding-bottom: 0 !important;" class="card-body">
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
                                <hr>
                                <div id="step-2" class="row step">
                                        <div class="col-sm">

                                            <div style="padding-top: 0 !important;" class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">E-mail</label>
                                                    <input required name="email" type="text" class="form-control" id="email" placeholder="Digite o e-mail">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Senha</label>
                                                    <input required name="password" type="password" class="form-control" id="password" placeholder="Digite a senha">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-sm">

                                            <div style="padding-top: 0 !important;" class="card-body">

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Confirmar senha</label>
                                                    <input required name="password_confirmation" type="password" class="form-control" id="confirm-password" placeholder="Confirme a senha">
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
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->dateBirth}}</td>
                        <td><span class="tag tag-success">{{$user->phone}}</span></td>
                        <td>
                            <button style="margin-right: 5px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalVisualizar{{$user->id}}"><i class="fas fa-eye"></i></button>

                            <!-- Modal Visualização -->
                            <div class="modal fade" id="modalVisualizar{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar Usuário</h5>
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
                                                                    <label for="exampleInputEmail1">Nome Completo</label>
                                                                    <input disabled value="{{$user->name}}"  required name="name" type="text" class="form-control" id="name{{$user->id}}" placeholder="Digite o nome">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Data de Nascimento</label>
                                                                    <input disabled required value="{{$user->dateBirth}}" name="dateBirth" type="date" class="form-control" id="dateBirth">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Telefone</label>
                                                                    <input disabled value="{{$user->phone}}" required name="phone" type="tel" maxlength="15" class="form-control phone" id="phone{{$user->id}}" placeholder="Digite o telefone">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Período de Trabalho</label>
                                                                    <input disabled value="{{$user->workTime}}" min="1" max="24"  required name="workTime" type="number" class="form-control" id="workTime" placeholder="Digite o período">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">CEP</label>
                                                                    <input disabled value="{{$user->address->cep}}" required maxlength="9" name="cep" type="text" class="form-control cep" id="cep{{$user->id}}" placeholder="Digite o cep">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="col-sm">

                                                            <div style="padding-bottom: 0 !important;" class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Cidade</label>
                                                                    <input disabled value="{{$user->address->city}}" required name="city" type="text" class="form-control" id="city{{$user->id}}" placeholder="Digite a cidade">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Unidade Federativa</label>
                                                                    <select disabled name="uf" id="uf" class="form-control" >
                                                                        <option>{{$user->address->uf}}</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Logradouro</label>
                                                                    <input disabled value="{{$user->address->publicPlace}}" required name="publicPlace" type="text" class="form-control" id="street{{$user->id}}" placeholder="Digite o logradouro">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Bairro</label>
                                                                    <input disabled value="{{$user->address->district}}"  required name="district" type="text" class="form-control" id="district{{$user->id}}" placeholder="Digite o bairro">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Número</label>
                                                                    <input disabled value="{{$user->address->num}}" required name="num" type="number" class="form-control" id="num{{$user->id}}" placeholder="Digite o número">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeletar{{$user->id}}">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="modalDeletar{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Deletar usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente deletar <strong>{{$user->name}}</strong> ?
                                        </div>
                                        <form action="/users/delete/{{$user->id}}" method="POST">
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
                {{$users->links()}}
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

                       $('#uf').prop('disabled', false);
                       $('#city').prop('disabled', false);
                       $('#street').prop('disabled', false);
                       $('#district').prop('disabled', false);

                       if($('#uf').val() != ''){
                           $('#uf').attr('readonly', true);
                       }if($('#city').val() != ''){
                           $('#city').attr('readonly', true);
                       }if($('#street').val() != ''){
                           $('#street').attr('readonly', true);
                       }if($('#district').val() != ''){
                           $('#district').attr('readonly', true);
                       }
                   }
               }
           });
        });
    </script>
@stop
