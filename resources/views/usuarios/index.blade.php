@extends('layout.dashboard')

@section('conteudo')
    
    
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="white-box">
                    <h4 class="box-title">Lista de Usuários</h4>
                    <table class="table table-hover table-sm" id="dt-usuarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Usuario</th>
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

        $(document).ready(function() {
            jQuery.fn.dataTable.ext.errMode = 'none';
            table = $('#dt-usuarios').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route ('usuarios') }}",
                    data: function (d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                lengthChange: false,
                lenghtMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nome', name: 'nome'},
                    {data: 'usuario', name: 'usuario'},

                ],
                order: [[0, 'desc']],
                "initComplete": function(settings, json) {
                    table.buttons().container().appendTo('#dt-usuarios_wrapper .col-md-4:eq(0)');

                    $('#search').attr('placeholder', 'Pesquisar');

                }
            })
        })

    </script>
@endsection