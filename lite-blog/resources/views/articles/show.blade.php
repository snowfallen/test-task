@extends('layouts.base')

@section('content')
    <div class="container w-50">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">{{ $article->title }}</h3>
                <p>{{$article->text}}</p>
                <p class="text-secondary">Authors:</p>
                @foreach($article->authors()->get() as $author)
                    <a href="{{ route('authors.show', $author) }}"
                       class="text-primary m-2">{{$author->name}}</a>
                @endforeach
                <ul class="list-unstyled text-end">
                    <li>Created at: {{ $article->created_at }}</li>
                    <li>Updated at: {{ $article->updated_at }}</li>
                </ul>
                <div class="d-flex flex-row justify-content-end">
                    <a href="{{ route('articles.edit', $article) }}"
                       class="btn btn-sm btn-secondary m-2">Edit</a>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST"
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
