@extends('layouts.base')

@section('content')
    <div class="container w-50">
        <div class="card author-details">
            <div class="card-body">
                <h3 class="card-title text-center">Author name - {{ $author->name }}</h3>
                <ul class="list-unstyled text-center">
                    <li>Created at: {{ $author->created_at }}</li>
                    <li>Updated at: {{ $author->updated_at }}</li>
                </ul>
                <div class="d-flex flex-row justify-content-end">
                    <a href="{{ route('authors.edit', $author) }}"
                       class="btn btn-sm btn-secondary m-2">Edit</a>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST"
                          class="m-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
