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

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index')->with('success', 'Desligado com sucesso');
    }
}
