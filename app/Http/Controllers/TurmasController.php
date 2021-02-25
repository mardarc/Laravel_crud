<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TurmasAlunos;
use App\Models\Turmas;
use App\Models\Alunos;
use App\Models\Professores;
use App\Models\Disciplinas;

use Exception;
use DataTables;

class TurmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $turmas = Turmas::with('professor', 'disciplina')
                            ->where(function ($query) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $query->where('id', 'LIKE', '%' . Str::lower($request->get('search') . '%'));
                                }
            });

            return DataTables::of($turmas)
                            ->setRowAttr(['data-id' => function($turmas) {
                                return $turmas->id;
                            }])
                            ->addIndexColumn()
                            ->make(true);
        }

        return view('turmas.index');
    }

    public function create()
    {
        $professores = Professores::get();
        $disciplinas = Disciplinas::get();
        $alunos = Alunos::get();
        
        return view('turmas.create', compact('disciplinas', 'professores', 'alunos'));
    }

    public function store(Request $request)
    {
        try {

            $turma = new Turmas;
            $turma->professor_id = $request->professor_id;
            $turma->disciplina_id = $request->disciplina_id;
            $turma->save();

        }

        catch (Exception $e) {
            return back()->with('error', 'Não foi possível cadastrar nova turma <br>' . $e->getMessage());
        }

        return redirect('turmas')->with('success', 'Turma cadastrada com sucesso!');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $turmas_alunos = TurmasAlunos::join('alunos', 'turmas_alunos.aluno_id', '=', 'alunos.id')
                                        ->join('turmas', 'turmas_alunos.turma_id', '=', 'turmas.id')
                                        ->where('turma_id', $id);

            return DataTables::of($turmas_alunos)
                            ->addIndexColumn()
                            ->make(true);
        }

        try { 
            $turma = Turmas::with('professor', 'disciplina')->where('id', $id)->firstOrFail();
            $professores = Professores::get();
            $disciplinas = Disciplinas::get();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível acessar o turma selecionada');
        }
        
        return view('turmas.show', compact('turma', 'disciplinas', 'professores'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {

            $turma = Turmas::find($id);
            
            $turma->professor_id = $request->professor_id;
            $turma->disciplina_id = $request->disciplina_id;
            $turma->save();

        }
        catch(Exception $e) {
            return back()->with('error', 'Não foi possível atualizar os dados da turma <br> '. $e->getMessage());
        }

        return back()->with('success', 'Os dados da turma foram atualizados');
    }

    public function destroy($id)
    {
        try {
            Turmas::where('id', $id)->delete();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível excluir a turma selecionada.');
        }

        return redirect('turmas')->with('success', 'A turma foi devidamente excluída');
    }

    public function searchAlunos(Request $request)
    {
        try{
            $alunos = Alunos::where('id', 'like', '%' . $request->pesquisa . '%')
                            ->orWhere('cpf', 'like', '%' . $request->pesquisa . '%')
                            ->get();
        }

        catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
        
        return response()->json([
            'error' => false,
            'alunos' => $alunos
        ]);
    }

    public function addAlunos(Request $request)
    {
        try {
            $aluno = TurmasAlunos::where('aluno_id', $request->aluno_id)->where('turma_id', $request->turma_id);

            if ($aluno->exists()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Aluno já está cadastrado na turma.'
                ]);
            }
            else {
                
                $turma_aluno = new TurmasAlunos;
                $turma_aluno->aluno_id = $request->aluno_id;
                $turma_aluno->turma_id = $request->turma_id;
                $turma_aluno->save();

            }
        }
        catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false
        ]);
    }
}
