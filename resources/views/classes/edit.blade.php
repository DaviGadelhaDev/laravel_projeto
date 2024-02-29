@extends('master')

@section('content')
    <form action="{{ route('classe.update', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="course_id" id="course_id" value="{{ $classe->id }}">
        <label for="nome">Name</label>
        <input type="text" name="name" id="name" placeholder="Classe Name" value="{{ old('name', $classe->name) }}">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $classe->description) }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection