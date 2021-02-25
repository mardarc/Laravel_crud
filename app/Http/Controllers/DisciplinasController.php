<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Disciplinas;

use Exception;
use DataTables;

class DisciplinasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $disciplinas = Disciplinas::where(function ($query) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $query->where('nome', 'LIKE', '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('curso', 'LIKE' , '%' . Str::lower($request->get('search') . '%'));
                                }
            });

            return DataTables::of($disciplinas)
                            ->setRowAttr(['data-id' => function($disciplinas) {
                                return $disciplinas->id;
                            }])
                            ->addIndexColumn()
                            ->make(true);
        }

        return view('disciplinas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disciplinas.create');
    }

    public function store(Request $request)
    {
        try {

            $disciplina = new Disciplinas;
            $disciplina->nome = $request->nome;
            $disciplina->curso = $request->curso;
            $disciplina->carga_horaria = $request->carga_horaria;
            $disciplina->save();

        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível criar a disciplina.' . $e->getMessage());
        }

        return view('disciplinas.index')->with('success', 'Disciplina criada com sucesso.');
    }

    public function show($id)
    {
        try { 
            $disciplina = Disciplinas::findOrFail($id);
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível acessar a disciplina selecionado');
        }
        
        return view('disciplinas.show', compact('disciplina'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {

            $disciplina = Disciplinas::find($id);
            
            $disciplina->nome = $request->nome;
            $disciplina->curso = $request->curso;
            $disciplina->carga_horaria = $request->carga_horaria;
            $disciplina->save();

        }
        catch(Exception $e) {
            return back()->with('error', 'Não foi possível atualizar os dados da disciplina <br> '. $e->getMessage());
        }

        return back()->with('success', 'Os dados da disciplina foram atualizados');
    }

    public function destroy($id)
    {
        try {
            Disciplinas::where('id', $id)->delete();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível excluir a disciplina selecionada.');
        }

        return redirect('disciplinas')->with('success', 'A disciplina foi devidamente excluída');
    }
}
