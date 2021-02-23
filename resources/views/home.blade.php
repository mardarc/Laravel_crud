@extends('layout.dashboard')

@section('conteudo')
    
    @include('layout.dashboard_breadcrumb', ['title' => ['name' => 'Home', 'path' => []]])

    <div class="jumbotron">
        <h1 class="display-4">Seja bem-vindo!</h1>
        <p class="lead">Este sistema foi desenvolvido para administração de professores, alunos e disciplinas.</p>
        <hr class="my-4">
        <p>Para criar, consultar, alterar ou até mesmo excluir os dados dos usuários, escolha um item no menu lateral esquerdo.</p>
    </div>
    
@endsection