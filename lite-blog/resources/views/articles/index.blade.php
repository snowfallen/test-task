@extends('layouts.base')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success d-flex justify-content-between w-50" role="alert">
                    {{ session('success') }}
                    <button class="close-button btn btn-secondary" onclick="this.parentNode.parentNode.removeChild(this.parentNode)">x
                    </button>
                </div>
            </div>

        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Articles</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>
                                        <div class="m-2">
                                            {{ $article->title }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-end">
                                            <a href="{{ route('articles.show', $article) }}"
                                               class="btn btn-sm btn-primary m-2">Detail</a>
                                            <a href="{{ route('articles.edit', $article) }}"
                                               class="btn btn-sm btn-secondary m-2">Edit</a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                                  class="m-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $articles->links() }}
                        <div class="mt-3 d-flex justify-content-end">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Create new article</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
