<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderByDesc('created_at')->paginate(10);
        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

       // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
       $course = Course::create($request->all());
       //Course::create([ 'name' => $request->name]);

       // Salvar log
       Log::info('Curso cadastrado.', ['id' => $course->id, $course]);

       // Redirecionar o usuário, enviar a mensagem de sucesso
       return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //Validação
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
         // Editar as informações do registro no banco de dados
         $course->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        // Salvar log
        Log::info('Curso editado.', ['id' => $course->id]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('course.show', ['course' => $request->course])->with('success', 'Curso editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            // Excluir o registro do banco de dados
            $course->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('course.index')->with('success', 'Curso excluído com sucesso!');
        } catch (Exception $e) {
            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Curso não excluído!');
        }
    }
}
