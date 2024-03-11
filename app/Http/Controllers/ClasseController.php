<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClasseController extends Controller
{

    // Listar as aulas
    public function index(Course $course)
    {
        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('order_classe')->get();

        // Salvar log
        Log::info('Listar aulas.', ['id' => $course->id]);

        // Carregar a VIEW
        return view('classes.index', ['menu' => 'courses', 'classes' => $classes, 'course' => $course]);
    }

    // Detalhes da aula
    public function show(Classe $classe)
    {

        // Salvar log
        Log::info('Visualizar aula.', ['id' => $classe->id]);

        // Carregar a VIEW
        return view('classes.show', ['menu' => 'courses', 'classe' => $classe]);
    }

    // Carregar o formulário cadastrar nova aula
    public function create(Course $course)
    {
        // Carregar a VIEW
        return view('classes.create', ['menu' => 'courses', 'course' => $course]);
    }

    // Cadastrar no banco de dados a nova aula
    public function store(ClasseRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Recuperar a última ordem da aula no curso
            $lastOrderClasse = Classe::where('course_id', $request->course_id)->orderByDesc('order_classe')->first();

            // Cadastrar no banco de dados na tabela aulas
            $classe = Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                'order_classe' => $lastOrderClasse != null ? $lastOrderClasse->order_classe + 1 : 1,
                'course_id' => $request->course_id,
            ]);

            // Salvar log
            Log::info('Aula cadastrada.', ['id' => $classe->id, $classe]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Aula não cadastrada', ['name' => $request->name]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Aula não cadastrada!');
        }
    }

    // Carregar o formulário editar aula
    public function edit(Classe $classe)
    {

        // Salvar log
        Log::info('Editar aula.', ['id' => $classe->id]);

        // Carregar a VIEW
        return view('classes.edit', ['menu' => 'courses', 'classe' => $classe]);
    }

    // Editar no banco de dados a aula
    public function update(ClasseRequest $request, Classe $classe)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $classe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Salvar log
            Log::info('Aula editada.', ['id' => $classe->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Aula não editada', ['erro' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Aula não editada!');
        }
    }

    // Excluir a aula do banco de dados
    public function destroy(Classe $classe)
    {
        try {
            // Excluir o registro do banco de dados
            $classe->delete();

            // Salvar log
            Log::info('Apagar aula.', ['id' => $classe->id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula apagada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Aula não apagada.', ['erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('error', 'Aula não excluída!');
        }
    }
}
