@extends('master')

@section('content')
    <form action="{{ route('course.update', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Name</label>
        <input type="text" name="name" id="name" placeholder="Course Name" value="{{ old('name', $course->name) }}">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" placeholder="Course Price" value="{{ old('name', $course->price) }}">
        <button type="submit">Update</button>
    </form>
@endsection