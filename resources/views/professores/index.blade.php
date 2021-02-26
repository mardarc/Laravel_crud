@extends('layout.dashboard')

@section('style')

<style>
    table tbody tr:hover {
        cursor: pointer;
    }
</style>
@endsection

@section('breadcrumb')
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Professores', 'path' => ['Professores']]])
@endsection

@section('conteudo')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="white-box">
                    <div class="row mb-2">
                        <div class="col">
                            <h4 class="box-title">Lista de Professores</h4>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('/professores/create') }}" type="button" class="btn btn-primary">Novo Professor</a>
                        </div>
                    </div>
                    <table class="table table-hover table-sm" id="dt-professores">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
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
        let url_base = "{{ url('/professores')}}";

        $(document).ready(function() {
            jQuery.fn.dataTable.ext.errMode = 'none';
            table = $('#dt-professores').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route ('professores') }}",
                    data: function (d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                lengthChange: false,
                lenghtMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nome', name: 'nome'},
                    {data: 'email', name: 'email'},

                ],
                order: [[0, 'desc']],
                "initComplete": function(settings, json) {
                    table.buttons().container().appendTo('#dt-professores_wrapper .col-md-4:eq(0)');

                    $('#search').attr('placeholder', 'Pesquisar');

                    $('#search').on('change', function(){
                        table.draw();
                    })

                    $(document).on('click', '#dt-professores tbody tr', function (){
                        let id = $(this).data('id');
                        window.location.href = url_base + '/' + id + '/show'; 
                    })
                }
            })
        })

    </script>
@endsection