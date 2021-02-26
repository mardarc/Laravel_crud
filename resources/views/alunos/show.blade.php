@extends('layout.dashboard')

@section('style')

    <style>

        .profile-pic {
            border-radius: 50%;
            border:dotted 2px #ccc;
            height: 150px;
            width: 150px;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            background-image: url( {{ URL::asset('images/professores/avatar.jpg') }} );
            vertical-align: middle;
            text-align: center;
            color: transparent;
            transition: all .3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .profile-pic:hover {
            background-color: rgba(0,0,0,.5);
            z-index: 10000;
            color: #fff;
            transition: all .3s ease;
            text-decoration: none;
        }

        .profile-pic span {
            display: inline-block;
            padding-top: 4.5em;
            padding-bottom: 4.5em;
        }

        form input[type="file"] {
                display: none;
                cursor: pointer;
        }

    </style>
@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Alunos', 'path' => ['Aluno', 'Detalhes']]])
@endsection

@section('conteudo')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <form class="form-horizontal form-material" action="{{ url('/alunos/' . $aluno->id . '/update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
            <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-12">
                    <div class="white-box">
                        <div class="user-bg">
                            <div class="overlay-box">
                                <div class="user-content mt-1">
                                    <div class="form-group mb-4">
                                        <label for="imagem">
                                            <div class="profile-pic" 
                                                style="background-image: url({{ URL::asset('images/alunos/' . $aluno->imagem) }}) ">
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <span>Nova Imagem</span>
                                            </div>
                                        </label>
                                        <input type="File" name="imagem" id="imagem">
                                        <h4 class="text-white mt-2"> {{ $aluno->nome }} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-12">
                    <div class="card">
                        <div class="card-body white-box">
                        
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nome Completo</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ $aluno->nome }}"
                                        class="form-control p-0 border-0" name="nome"> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nome da Mãe</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ $aluno->nome_mae }}"
                                        class="form-control p-0 border-0" name="nome_mae"> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email" class="col-md-12 p-0">E-mail</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="email" value="{{ $aluno->email }}"
                                        class="form-control p-0 border-0" name="email"
                                        id="email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-md-12 p-0">Data de Nascimento</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date" class="form-control p-0 border-0" name="data_nascimento" value="{{ $aluno->data_nascimento }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Curso</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0" name="curso" value="{{ $aluno->curso }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Status</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control p-o border-o" name="status">
                                                <option value="1" {{ $aluno->status == "1" ? 'selected' : ''}} >Matriculado</option>
                                                <option value="2" {{ $aluno->status == "2" ? 'selected' : ''}} >Pré-Matrícula</option>
                                                <option value="3" {{ $aluno->status == "3" ? 'selected' : ''}} >Desistente</option>
                                                <option value="4" {{ $aluno->status == "4" ? 'selected' : ''}} >Trancado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <button type="submit" class="btn btn-success w-50">Atualizar</button>
                                    </div>
                                    <div class="col-md-6 col-sm-12 text-right">
                                        <button type="button" class="btn btn-danger w-50" 
                                            data-toggle="modal" data-target="#modal_delete">Excluir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </form>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Modal de exclusão  -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modal_delete" tabindex="-1" aria-labelledby="modal_deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Atenção!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja confirmar a exclusão do aluno selecionado?</p>
                    <p>Ele será removido das turmas em que está cadastrado.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ url('/alunos/' . $aluno->id . '/delete') }}" type="a" class="btn btn-primary">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Modal de exclusão  -->
    <!-- ============================================================== -->
@endsection
    
@section('javascript')

    <script type="text/javascript">
        $('#telefone').mask('(99) 99999-9999');
    </script>
@endsection
