@extends('layout.dashboard')

@section('style')
@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Turmas', 'path' => ['Turma', 'Novo' ]]])
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
        <form id="form-novo-usuario" class="form-horizontal form-material" action="{{ url('/turmas/store') }}" method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body white-box">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Professor</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select class="form-control p-o border-o" name="professor_id" required>
                                        <option value="">Selecione</option>
                                        @foreach ($professores as $professor)
                                            <option value="{{ $professor->id }}">{{ $professor->nome }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Disciplina</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select class="form-control p-o border-o" name="disciplina_id">
                                        <option value="">Selecione</option>
                                        @foreach ($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}">{{ $disciplina->nome }} </option>
                                        @endforeach
                                    </select>
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

    <script type="text/javascript">
        $('#telefone').mask('(99) 99999-9999');
        $('#cpf').mask('000.000.000-00');
    </script>
@endsection
