@extends('layout.dashboard')

@section('style')

@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Disciplina', 'path' => ['Disciplina', 'Detalhes']]])
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
        <form class="form-horizontal form-material" action="{{ url('/disciplinas/' . $disciplina->id . '/update') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body white-box">
                        
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nome da Disciplina</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ $disciplina->nome }}"
                                        class="form-control p-0 border-0" name="nome"> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-md-12 p-0">Curso</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0" name="curso" value="{{ $disciplina->curso }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Carga Horária</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" class="form-control p-0 border-0" name="carga_horaria" value="{{ $disciplina->carga_horaria }}">
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
                    <p>Deseja confirmar a exclusão da disciplina selecionada?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ url('/disciplinas/' . $disciplina->id . '/delete') }}" type="a" class="btn btn-primary">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Modal de exclusão  -->
    <!-- ============================================================== -->
@endsection
    
@section('javascript')

@endsection
