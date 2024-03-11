<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //Recuperar do banco de dados as informações do usuário logado
        $user = User::where('id', Auth::id())->first();

        return view('profile.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = User::where('id', Auth::id())->first();

        return view('prodile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $request->validated();

        DB::beginTransaction();
        try{
            $user = User::where('id', Auth::id())->first();

            $user->update([
                'name' => $request->name,
                'email'=> $request->email,
            ]);
            Log::info('Perfil editado com sucesso', ['id' => $user->id]);
            DB::commit();

            return redirect()->route('profile.show')->with('success', 'Perfil editado com sucesso!');
        }
        catch(Exception $e){
            Log::info('Perfil não editado', ['error' => $e->getMessage()]);
            DB::rollBack();

            return back()->withInput()->with('error', 'Perfil não editado');
        }
    }

    public function editPassword()
    {
        $user = User::where('id', Auth::id())->first();

        return view('profile.editPassword', ['user' => $user]);
    }

    public function updatePassword(ProfileRequest $request)
    {
        $request->validate([
            'password' => 'required|min:6'
        ],[
            'required' => 'O campo senha é obrigatório',
            'min' => 'A senha deve ter no mínimo :min caracteres'
        ]);

        try{
            $user = User::where('id', Auth::id())->first();
            $user->update([
                'password' => $request->password
            ]);
            Log::info('Senha atualizada', ['user' => $user->id]);
            DB::commit();

            return redirect()->route('profile.show')->with('success', 'Senha atualizada');
        }
        catch(Exception $e){
            //Salvar no log
            Log::info('Erro ao atualizar a senha', ['error' => $e->getMessage()]);

            return back()->with('error', 'Erro ao atualizar a senha');
        }

       
       
    }
}
