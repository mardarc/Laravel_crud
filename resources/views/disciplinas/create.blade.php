@extends('layout.dashboard')

@section('style')
@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Professores', 'path' => ['Professor', 'Novo' ]]])
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
        <form id="form-nova-disciplina" class="form-horizontal form-material" action="{{ url('/disciplinas/store') }}" method="POST"> 
        {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body white-box">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nome da Disciplina</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text"
                                        class="form-control p-0 border-0" name="nome" required> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-8">
                                        <label class="col-md-12 p-0">Curso</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"
                                                class="form-control p-0 border-0" 
                                                name="curso">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-md-12 p-0">Carga Horária</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number"
                                                class="form-control p-0 border-0" 
                                                name="carga_horaria">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <button type="submit" class="btn btn-success w-50">Salvar</button>
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

@endsection
    
@section('javascript')
@endsection
