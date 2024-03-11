@extends('layouts.base')
@section('content')
    <div class="container">
        <div class="row justify-content-center m-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top 3 Authors by articles last week</div>
                    <div class="card-body">
                        @if($topAuthors->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Articles</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($topAuthors as $topAuthor)
                                    <tr>
                                        <td>
                                            <div class="m-2">
                                                {{ $topAuthor->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="m-2">
                                                {{ $topAuthor->articles()->count() }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4>No articles yet, maybe you'll be first!</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
