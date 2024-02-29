@extends('master')

@section('content')
    <form action="{{ route('classe.store') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
        <label for="nome">Name</label>
        <input type="text" name="name" id="name" placeholder="Classe Name" value="{{ old('name') }}">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
        <button type="submit">Register</button>
    </form>
@endsection