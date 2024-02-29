<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

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

        Course::create($request->all());
        return redirect()->route('course.index')->with('success', 'Registration completed successfully');
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
        $course->update(['name'=>$request->name, 'price'=>$request->price]);
        return redirect()->route('course.index')->with('success', 'Course edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index')->with('success', 'Course deleted successfully');
    }
}
