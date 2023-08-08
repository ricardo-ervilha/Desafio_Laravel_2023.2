@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciar Usuários do Sistema</h1>
@stop

@section('content')
    <div class="card">
        <div  class="card-header">
            <div style="align-items: center" class="row">
                <div class="col-sm">
                    <h3 class="card-title">Tabela de Usuários</h3>
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

        <!-- Modal -->
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
                            <div class="card-header">
                                <h3 class="card-title">Dados Básicos</h3>
                            </div>

                            <form>
                                <div class="row">
                                    <div class="col-sm">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome Completo</label>
                                                <input name="name" type="name" class="form-control" id="exampleInputEmail1" placeholder="Digite o nome">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">E-mail</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o e-mail">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Data de Nascimento</label>
                                                <input name="dateBirth" type="date" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Telefone</label>
                                                <input name="phone" type="text" class="form-control" id="exampleInputPassword1" placeholder="Digite o telefone">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Período de Trabalho</label>
                                                <input name="workTime" type="number" class="form-control" id="exampleInputPassword1" placeholder="Digite o período">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Categoria</label>
                                                <select class="form-control">
                                                    <option>Funcionário</option>
                                                    <option>Administrador</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Senha</label>
                                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite a senha">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Confirmar senha</label>
                                                <input name="confirm-password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirme a senha">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Próximo</button>
                    </div>
                </div>
            </div>
        </div>


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
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>teste@gmail.com</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">(32) 98414-7860</span></td>
                    <td>
                        <button style="margin-right: 5px;" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        <button style="margin-right: 5px;" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>teste@gmail.com</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">(32) 98414-7860</span></td>
                    <td>
                        <button style="margin-right: 5px;" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        <button style="margin-right: 5px;" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>teste@gmail.com</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">(32) 98414-7860</span></td>
                    <td>
                        <button style="margin-right: 5px;" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        <button style="margin-right: 5px;" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>teste@gmail.com</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">(32) 98414-7860</span></td>
                    <td>
                        <button style="margin-right: 5px;" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        <button style="margin-right: 5px;" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
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
    <script> console.log('Hi!'); </script>
@stop
