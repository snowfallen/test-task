<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Services\AuthorService;
use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{
    private const INDEX_ROUTE_NAME = 'authors';
    private const SUCCESS_MESSAGE = 'Success! Author has been ';

    public function __construct(
        private readonly AuthorService $authorService,
        private readonly Author        $author)
    {
    }

    public function index(): View
    {
        return view('authors.index', ['authors' => $this->authorService->paginate($this->author, 5)]);
    }

    public function create(): View
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $authorRequest): RedirectResponse
    {
        $this->authorService->store($authorRequest->validated());

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'created.');
    }

    public function show(Author $author): View
    {
        return view('authors.show', ['author' => $author]);
    }

    public function edit(Author $author): View
    {
        return view('authors.edit', ['author' => $author]);
    }

    public function update(AuthorRequest $authorRequest, Author $author): RedirectResponse
    {
        $this->authorService->update($authorRequest->validated(), $author);

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'updated.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $this->authorService->delete($author);

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'deleted.');
    }

    public function getTopAuthorsByArticlesLastWeek(): View
    {
        $topAuthors = $this->authorService->getTopAuthorsByArticlesLastWeek();

        return view('authors.top', ['topAuthors' => $topAuthors]);
    }
}
