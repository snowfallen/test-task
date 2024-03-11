<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Services\ArticleService;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    private const INDEX_ROUTE_NAME = 'articles';
    private const SUCCESS_MESSAGE = 'Success! Article has been ';

    public function __construct(
        private readonly ArticleService $articleService,
        private readonly Article        $article)
    {
    }

    public function index(): View
    {
        return view('articles.index', [
            'articles' => $this->articleService->paginate($this->article, 5),
            'authors' => Author::all()
        ]);
    }

    public function create(): View
    {
        return view('articles.create', ['authors' => Author::all()]);
    }

    public function store(ArticleRequest $articleRequest): RedirectResponse
    {
        $this->articleService->store($articleRequest->validated());

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'created.');
    }

    public function show(Article $article): View
    {
        return view('articles.show', ['article' => $article]);
    }

    public function edit(Article $article): View
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $articleRequest, Article $article): RedirectResponse
    {
        $this->articleService->update($articleRequest->validated(), $article);

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'updated.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->delete($article);

        return redirect(self::INDEX_ROUTE_NAME)->with('success', self::SUCCESS_MESSAGE . 'deleted.');
    }

    public function searchByName(string $authorName): Collection
    {
        return $this->articleService->searchByName($authorName);
    }
}
