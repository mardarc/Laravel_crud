@extends('layout.dashboard')

@section('style')

@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Turmas', 'path' => ['Turma', 'Detalhes']]])
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
        
        <div class="row">
            <div class="col-lg-4 col-xlg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body white-box">
                        <form class="form-horizontal form-material" action="{{ url('/turmas/' . $turma->id . '/update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Professor</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select class="form-control p-o border-o" name="professor_id" required>
                                        @foreach ($professores as $professor)
                                            <option value="{{ $professor->id }}" {{ $turma->professor_id === $professor->id ? 'selected' : '' }}>{{ $professor->nome }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Disciplina</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select class="form-control p-o border-o" name="disciplina_id">
                                        @foreach ($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}"  {{ $turma->disciplina_id === $disciplina->id ? 'selected' : '' }}>{{ $disciplina->nome }} </option>
                                        @endforeach
                                    </select>
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body white-box">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h4>Lista de Alunos</h4>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_aluno">Adicionar Aluno</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-hover table-sm" id="dt-turmas-alunos">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        
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
                    <p>Deseja confirmar a exclusão do usuário selecionado?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ url('/turmas/' . $turma->id . '/delete') }}" type="a" class="btn btn-primary">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Modal de exclusão  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Modal add aluno  -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modal_add_aluno" tabindex="-1" aria-labelledby="modal_add_alunoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Adicionar Alunos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>CPF ou ID</label>
                    <div class="row">
                        <div class="col-9">
                            <input type="text" class="form-control p-0 border-0" name="cpf" id="search_cpf_id" required> 
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-dark w-100" id="search_aluno">Localizar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th width="70%">Nome</th>
                                        <th width="30%">Ação</th>
                                    </tr>
                                </thead>
                                <tbody id="add_aluno_tbody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {{-- <a href="{{ url('/usuarios/' . $usuario->id . '/delete') }}" type="a" class="btn btn-primary">Confirmar</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Modal de exclusão  -->
    <!-- ============================================================== -->

@endsection
    
@section('javascript')

    <script type="application/javascript" src="{{ url('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/jszip.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/pdfmake.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/vfs_fonts.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/buttons.html5.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/buttons.print.min.js') }}"></script>
    <script type="application/javascript" src="{{ url('js/datatables/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript">
        let url_base = "{{ url('/turmas') }}"
        let turma_id = {!! $turma->id !!};
        
        $(document).ready(function() {
            let turma_id = {!! $turma->id !!};

            jQuery.fn.dataTable.ext.errMode = 'none';
            table = $('#dt-turmas-alunos').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url_base + '/' + turma_id + '/show',
                    data: function (d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                lengthChange: false,
                lenghtMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                columns: [
                    {data: 'aluno_id', name: 'aluno_id'},
                    {data: 'nome', name: 'alunos.nome'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'}
                ],
                order: [[0, 'desc']],
                "initComplete": function(settings, json) {
                    table.buttons().container().appendTo('#dt-turmas-alunos_wrapper .col-md-4:eq(0)');

                    $('#search').attr('placeholder', 'Pesquisar');

                    $('#search').on('change', function(){
                        table.draw();
                    })
                }
            })
        })

        $(document).on('click', '#search_aluno', function() {
            $('#add_aluno_tbody').html('')
            let pesquisa = $('#search_cpf_id').val();
            $.ajax({
                url: "{{ route('search_alunos') }}",
                method: "GET",
                data: {
                    pesquisa: pesquisa
                }
            }).done(function(res){
                if (res.error) {
                    return
                }

                let alunos = res.alunos;
                let html = '';
                $.each(alunos, function (key, val) {
                    html += '<tr>';
                    html +=     '<td>' + val.nome + '</td>';
                    html +=     '<td><button class="btn btn-sm btn-info w-100 btn-add-aluno" data-id="' + val.id +'">Adicionar</button></td>';
                    html += '</tr>';
                })
                $('#add_aluno_tbody').html(html)

            }).fail(function(jqXHR, e) {
                    console.log(jqXHR, jqXHR.responseJSON, e);
            });
        })

        $(document).on('click', '.btn-add-aluno', function(){
            let aluno_id = $(this).data('id');

            $.ajax({
                url: "{{ route('add_alunos') }}",
                method: "GET",
                data: {
                    aluno_id: aluno_id,
                    turma_id: turma_id
                }
            }).done(function(res){
                if (res.error) {
                    return
                }

                $('#add_aluno_tbody').html(html)

            }).fail(function(jqXHR, e) {
                    console.log(jqXHR, jqXHR.responseJSON, e);
            });
        });
        
    </script>

@endsection
