<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use Exception;
use Illuminate\Support\Facades\Password;

class Logincontroller extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(LoginRequest $request, User $user)
    {
        $request->validated();
        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return back()->withInput()->with('error', 'Email e/ou senha inválido(s)');
        }
        Log::info('Logou no sistema.', ['id' => $user->id]);
        return redirect()->route('dashboard.index');
    }

    public function create()
    {
        return view('login.create');
    }

    public function storeUser(LoginUserRequest $request)
    {
        //validação
        $request->validated();
        DB::beginTransaction();
        try
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            Log::info("Usuário cadastrado.", ['id' => $user->id]);
            DB::commit();
            return redirect()->route('login.index')->with('success', 'Conta cadastrada com sucesso');
        }
        catch(Exception $e)
        {
            Log::info("Usuário não cadastrado.", ['error' => $e->getMessage()]);
            DB::rollBack();

            return back()->withInput()->with('error', 'Usuário não cadastrado');
        }
    }

    public function showForgotPassword()
    {
        return view('login.forgotPassword');
    }

    public function submitForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ],
        [
            'email.required' => 'O campo E-mail é obrigatório',
            'email.email' => 'Digite um E-mail válido'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            Log::warning('Tentativa recuperar senhacom E-mail não cadastrado', ['email' => $request->email]);
            return back()->withInput()->with('error', 'E-mail não cadastrado');
        }

        try{
            //Salvar token recuperar senha e enviar e-mail
            $status = Password::sendResetLink(
                $request->only('email')
            );

            Log::info('Recuperar senha', ['status' => $status, 'email' => $request->email]);
            return redirect()->route('login.index')->with('success', 'Enviado E-mail com as instruções para recuperar senha');
        }
        catch(Exception $e){
            Log::warning("Erro ao recuperar senha", ['error' => $e->getMessage(), 'email' => $request->email]);
            return back()->withInput()->with('error', 'Erro ao recuperar senha');
        }


    }   

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index')->with('success', 'Desligado com sucesso');
    }
}
