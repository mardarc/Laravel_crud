<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

use App\Models\Alunos;
use App\Models\TurmasAlunos;

use File;
use Exception;
use DataTables;

class AlunosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alunos = Alunos::where(function ($query) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $query->where('nome', 'LIKE', '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('cpf', 'LIKE' , '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('email', 'LIKE' , '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('curso', 'LIKE' , '%' . Str::lower($request->get('search') . '%'));
                                }
            });

            return DataTables::of($alunos)
                            ->setRowAttr(['data-id' => function($alunos) {
                                return $alunos->id;
                            }])
                            ->addIndexColumn()
                            ->make(true);
        }

        return view('alunos.index');

    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $uuid = Uuid::uuid4();
        $imagem = $request->file('imagem');
        
        try {

            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/alunos/'), $uuid . '.' . $extensao);
                }
            }

            $aluno = new Alunos;
            $aluno->nome = $request->nome;
            $aluno->cpf = $request->cpf;
            $aluno->nome_mae = $request->nome_mae;
            $aluno->email = $request->email;
            $aluno->curso = $request->curso;
            $aluno->data_nascimento = $request->data_nascimento;
            $aluno->status = $request->status;
            $aluno->uuid = $uuid;
            $aluno->save();

        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível cadastrar novo aluno <br>' . $e->getMessage());
        }

        return redirect('alunos')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show($id)
    {
        try { 
            $aluno = Alunos::findOrFail($id);
            $aluno->imagem = (File::exists('images/alunos/' . $aluno->uuid . '.jpg')) ? $aluno->uuid . '.jpg' : 'avatar.png';
            
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível acessar o aluno selecionado');
        }
        
        return view('alunos.show', compact('aluno'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $imagem = $request->file('imagem');
        
        try {

            $aluno = Alunos::find($id);
            
            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/alunos'), $aluno->uuid . '.' . $extensao);
                }
            }
            
            $aluno->nome = $request->nome;
            $aluno->nome_mae = $request->nome_mae;
            $aluno->email = $request->email;
            $aluno->curso = $request->curso;
            $aluno->data_nascimento = $request->data_nascimento;
            $aluno->status = $request->status;
            $aluno->save();

        }
        catch(Exception $e) {
            return back()->with('error', 'Não foi possível atualizar os dados do aluno <br> '. $e->getMessage());
        }

        return back()->with('success', 'Os dados do aluno foram atualizados');
    }

    public function destroy($id)
    {
        try {
            TurmasAlunos::where('aluno_id', $id)->delete();
            Alunos::where('id', $id)->delete();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível excluir o aluno selecionado.');
        }

        return redirect('alunos')->with('success', 'O aluno foi devidamente excluído');
    }
}
