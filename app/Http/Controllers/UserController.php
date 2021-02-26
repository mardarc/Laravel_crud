<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

use App\Models\User;

use Exception;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $usuarios = User::where(function ($query) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $query->where('nome', 'LIKE', '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('usuario', 'LIKE' , '%' . Str::lower($request->get('search') . '%'))
                                            ->orWhere('cpf', 'LIKE' , '%' . Str::lower($request->get('search') . '%'));
                                }
            });

            return DataTables::of($usuarios)
                            ->setRowAttr(['data-id' => function($usuarios) {
                                return $usuarios->id;
                            }])
                            ->addIndexColumn()
                            ->make(true);
        }

        return view('usuarios.index');
    }
    
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $password = Hash::make($request->password);
        $uuid = Uuid::uuid4();
        $imagem = $request->file('imagem');
        
        try {

            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/users'), $uuid . '.' . $extensao);
                }
            }

            $usuario = new User;
            $usuario->nome = $request->nome;
            $usuario->cpf = $request->cpf;
            $usuario->usuario = $request->usuario;
            $usuario->email = $request->email;
            $usuario->telefone = $request->telefone;
            $usuario->password = $password;
            $usuario->uuid = $uuid;
            $usuario->save();

        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível criar novo usuário <br>' . $e->getMessage());
        }

        return redirect('usuarios')->with('success', 'Usuário criado com sucesso!');
    }

    public function show($id)
    {
        try { 
            $usuario = User::findOrFail($id);
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível acessar o usuário selecionado');
        }

        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        

        $imagem = $request->file('imagem');
        
        try {

            $usuario = User::find($id);
            if($request->hasFile('imagem')) {
                $extensao = $imagem->extension();
                if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ){
                    $imagem->move(public_path('images/users'), $usuario->uuid . '.' . $extensao);
                }
            }
            
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            
            if ($request->password != 'password') {
                $password = Hash::make($request->password);
                $usuario->password = $password;
            }
            if ($request->telefone != null) {
                $usuario->telefone = $request->telefone;
            }
            
            $usuario->save();
        }
        catch(Exception $e) {
            return back()->with('error', 'Não foi possível atualizar os dados do usuário');
        }

        return back()->with('success', 'Os dados do usuário foram atualizados');
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
        }
        catch (Exception $e) {
            return back()->with('error', 'Não foi possível excluir o usuário selecionado.');
        }

        return redirect('usuarios')->with('success', 'O usuário foi devidamente excluído');
    }
}
