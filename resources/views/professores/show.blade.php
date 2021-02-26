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
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Professor', 'path' => ['Professor', 'Detalhes']]])
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
        <form class="form-horizontal form-material" action="{{ url('/professores/' . $professor->id . '/update') }}" method="POST" enctype="multipart/form-data">
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
                                                style="background-image: url({{ URL::asset('images/professores/' . $professor->imagem) }}) ">
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <span>Nova Imagem</span>
                                            </div>
                                        </label>
                                        <input type="File" name="imagem" id="imagem">
                                        <h4 class="text-white mt-2"> {{ $professor->nome }} </h4>
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
                                    <input type="text" value="{{ $professor->nome }}"
                                        class="form-control p-0 border-0" name="nome"> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email" class="col-md-12 p-0">E-mail</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="email" value="{{ $professor->email }}"
                                        class="form-control p-0 border-0" name="email"
                                        id="email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-md-12 p-0">Curso</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0" name="curso" value="{{ $professor->curso }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Graduacao</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control p-o border-o" name="graduacao">
                                                <option value="Graduação" {{ $professor->graduacao == "Graduação" ? 'selected' : ''}}>Graduação</option>
                                                <option value="Pós-Graduação" {{ $professor->graduacao == "Pós-Graduação" ? 'selected' : ''}}>Pós-Graduação</option>
                                                <option value="Mestrado" {{ $professor->graduacao == "Mestrado" ? 'selected' : ''}} >Mestrado</option>
                                                <option value="Doutorado" {{ $professor->graduacao == "Doutorado" ? 'selected' : ''}} >Doutorado</option>
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
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
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
                    <h4 class="modal-title text-danger">Atenção!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja confirmar a exclusão do professor selecionado?</p>
                    <p>Caso exitam turmas vinculadas a este professor, a disciplina ficará sem professor vinculado.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ url('/professores/' . $professor->id . '/delete') }}" type="a" class="btn btn-primary">Confirmar</a>
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
