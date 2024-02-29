<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;

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

        //Recuperar a ultima ordem da aula no curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)->orderBy('order_classe')->first();
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            'order_classe' => $lastOrderClasse != null ? $lastOrderClasse->order_classe + 1 : 1, 
            'course_id' => $request->course_id
        ]);

        return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Registered successfully');
    }

    public function show(Classe $classe)
    {
        return view('classes.show', ['classe' => $classe]);
    }

    public function edit(Request $request, Classe $classe)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            ''
        ]);

        return view('classes.edit', ['classe' => $classe]);
    }

    
    public function update(Request $request, Classe $classe)
    {
        $classe->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Classe edited successfully');
    }


    public function destroy(Classe $classe)
    {
        try
        {
             //Excluir o usuário
       $classe->delete();
       //redirecionar o usuário
       return redirect()->route('classe.index', ['course' => $classe->course_id])->with('sucess', 'Classe delete successfully');
        }
        catch(Exception $e)
        {
            return redirect()->route('course.index')->with('error', 'Error: Classe not delete');
        }
      
    }
}
