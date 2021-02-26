<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

use App\Models\Professores;
use File;
use Exception;
use DataTables;

class ProfessoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $professores = Professores::where(function ($query) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $query->where('nome', 'LIKE', '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('cpf', 'LIKE' , '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('email', 'LIKE' , '%' . Str::lower($request->get('search') . '%'));
                                }
            });

            return DataTables::of($professores)
                            ->setRowAttr(['data-id' => function($professores) {
                                return $professores->id;
                            }])
                            ->addIndexColumn()
                            ->make(true);
        }

        return view('professores.index');
    }

    public function create()
    {
        return view('professores.create');
    }

    public function store(Request $request)
    {
        $uuid = Uuid::uuid4();
        $imagem = $request->file('imagem');
        
        try {

            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/professores/'), $uuid . '.' . $extensao);
                }
            }

            $professor = new Professores;
            $professor->nome = $request->nome;
            $professor->cpf = $request->cpf;
            $professor->email = $request->email;
            $professor->curso = $request->curso;
            $professor->graduacao = $request->graduacao;
            $professor->uuid = $uuid;
            $professor->save();

        }

        catch (Exception $e) {
            return back()->with('error', 'Não foi possível cadastrar novo professor <br>' . $e->getMessage());
        }

        return redirect('professores')->with('success', 'Professor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try { 
            $professor = Professores::findOrFail($id);
            $professor->imagem = (File::exists('images/professores/' . $professor->uuid . '.jpg')) ? $professor->uuid . '.jpg' : 'avatar.png';
            
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível acessar o professor selecionado');
        }
        
        return view('professores.show', compact('professor'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $imagem = $request->file('imagem');
        
        try {

            $professor = Professores::find($id);
            
            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/professores'), $professor->uuid . '.' . $extensao);
                }
            }
            
            $professor->nome = $request->nome;
            $professor->email = $request->email;
            $professor->curso = $request->curso;
            $professor->graduacao = $request->graduacao;
            $professor->save();

        }
        catch(Exception $e) {
            return back()->with('error', 'Não foi possível atualizar os dados do usuário <br> '. $e->getMessage());
        }

        return back()->with('success', 'Os dados do usuário foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Professores::where('id', $id)->delete();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível excluir o professor selecionado.');
        }

        return redirect('professores')->with('success', 'O professor foi devidamente excluído');
    }
}
