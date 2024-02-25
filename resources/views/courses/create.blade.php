@extends('master')

@section('content')
    <form action="{{ route('course.store') }}" method="POST">
        @csrf
        <label for="nome">Name</label>
        <input type="text" name="name" id="name" placeholder="Course Name" value="{{ old('name') }}">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" placeholder="course price" value="{{ old('price') }}">
        <button type="submit">Register</button>
    </form>
@endsection