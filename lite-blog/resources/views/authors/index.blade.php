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
                    <div class="card-header">Authors</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Articles</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td>
                                        <div class="m-2">
                                            {{ $author->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-2">
                                            {{ $author->articles()->count() }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-end">
                                            <a href="{{ route('authors.show', $author) }}"
                                               class="btn btn-sm btn-primary m-2">Detail</a>
                                            <a href="{{ route('authors.edit', $author) }}"
                                               class="btn btn-sm btn-secondary m-2">Edit</a>
                                            <form action="{{ route('authors.destroy', $author) }}" method="POST"
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
                        {{ $authors->links() }}
                        <div class="mt-3 d-flex justify-content-end">
                            <a href="{{ route('authors.create') }}" class="btn btn-primary">Create new author</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
