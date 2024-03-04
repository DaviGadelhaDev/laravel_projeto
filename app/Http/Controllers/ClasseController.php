<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClasseController extends Controller
{
    public function index(Course $course)
    {
        //Usando os dados do course no relacionamento de 1 para muitos
        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('order_classe')->get();
        return view('classes.index', ['classes' => $classes, 'course' => $course]);
    }
    //Método create com relacionamento entre tabelas
    public function create(Course $course)
    {
        return view('classes.create', ['course' => $course]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'course_id' => 'required'
        ]);
        try {
            // Recuperar a última ordem da aula no curso
            $lastOrderClasse = Classe::where('course_id', $request->course_id)->orderByDesc('order_classe')->first();
            // Cadastrar no banco de dados na tabela aulas
            $classe = Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                'order_classe' => $lastOrderClasse != null ? $lastOrderClasse->order_classe + 1 : 1,
                /*'order_classe' => 'CCCCC',*/
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
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->back()->with('error', 'Aula não cadastrada!');
        }
    }

    public function show(Classe $classe)
    {
        return view('classes.show', ['classe' => $classe]);
    }

    public function edit(Request $request, Classe $classe)
    {
        return view('classes.edit', ['classe' => $classe]);
    }

    
    public function update(Request $request, Classe $classe)
    {
       // Editar as informações do registro no banco de dados
       $classe->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    // Salvar log
    Log::info('Aula editada.', ['id' => $classe->id]);

    // Redirecionar o usuário, enviar a mensagem de sucesso
    }


    public function destroy(Classe $classe)
    {
        // Excluir o registro do banco de dados
        $classe->delete();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula apagada com sucesso!');
        
      
    }
}
