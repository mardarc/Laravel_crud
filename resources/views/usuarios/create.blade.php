@extends('layout.dashboard')

@section('style')
<style>

    .user-content input{
        background: transparent;
        border: 0;
        border-bottom: solid 1px white;
        color: white;
    }
    .user-content input:focus{
        background: transparent;
        border: 0;
        border-bottom: solid 1px white;
        color: white;
    }

    .profile-pic {
        border-radius: 50%;
        border:dotted 2px #ccc;
        height: 150px;
        width: 150px;
        background-size: cover;
        background-position: center;
        background-blend-mode: multiply;
        background-image: url({{ URL::asset('images/users/avatar.png') }});
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
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Usuários', 'path' => ['Usuários', 'Novo' ]]])
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
        <form id="form-novo-usuario" class="form-horizontal form-material" action="{{ url('/usuarios/store') }}" method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-4 col-xlg-3 col-md-12">
                    <div class="white-box">
                        <div class="user-bg"> <img height="100%" alt="user" src=" {{ url('plugins/images/large/img1.jpg') }}">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <div class="form-group mb-4">
                                        <label for="imagem">
                                            <div class="profile-pic">
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <span>Nova Imagem</span>
                                            </div>
                                        </label>
                                        <input type="File" name="imagem" id="imagem">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xlg-9 col-md-12">
                    <div class="card">
                        <div class="card-body white-box">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nome Completo</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text"
                                        class="form-control p-0 border-0" name="nome" required> 
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-md-12 p-0">Usuário</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"
                                                class="form-control p-0 border-0" name="usuario" required> 
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">CPF</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"
                                                class="form-control p-0 border-0" 
                                                name="cpf" required id="cpf"
                                                placeholder="000.000.000-00"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-md-12 p-0">E-mail</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email"
                                                class="form-control p-0 border-0" name="email" required> 
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Telefone</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"
                                                class="form-control p-0 border-0" 
                                                name="telefone" id="telefone"
                                                placeholder="(00) 00000-0000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label for="email" class="col-md-12 p-0">Senha</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password"
                                                class="form-control p-0 border-0" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="col-md-12 p-0">Confirmação de Senha</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" class="form-control p-0 border-0" 
                                            name="confirm_password" required>
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

@endsection
    
@section('javascript')

    <script type="text/javascript">
        $('#telefone').mask('(99) 99999-9999');
        $('#cpf').mask('000.000.000-00');
    </script>
@endsection
