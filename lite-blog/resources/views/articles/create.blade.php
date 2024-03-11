@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new article</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('articles.store') }}">
                            @csrf

                            <div class="form-group row p-2">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}" required autocomplete="title"
                                           autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row p-2">
                                <label for="authors" class="col-md-4 col-form-label text-md-right">Authors</label>

                                <div class="col-md-6">
                                    <div class="form__multiselect m-2">
                                        <label for="select" class="form__multiselect__label"></label>
                                        <input id="checkbox" class="form__multiselect__checkbox" type="checkbox">
                                        <input type="hidden" id="selectedAuthors" name="authors">
                                        <label for="checkbox" class="form__multiselect__checkbox__label"></label>
                                        <select id="select" class="form__multiselect__select p-2" multiple>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->name }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('authors')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row p-2">
                                <label for="text" class="col-md-4 col-form-label text-md-right">Text</label>

                                <div class="col-md-6">
                                    <textarea id="text" name="text"
                                              class="form-control @error('text') is-invalid @enderror"
                                              rows="5">{{ old('text') }}</textarea>

                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
