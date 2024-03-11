<?php

namespace App\Http\Services;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

class ArticleService extends BaseService
{
    public function store(array $data): void
    {
        $article = Article::create([
            'title' => $data['title'],
            'text' => $data['text']
        ]);
        $authors = Author::whereIn('name', explode(',', $data['authors']))->get();
        $article->authors()->attach($authors);
        $article->save();
    }

    public function update(array $data, Article $article): void
    {
        $article->update([
            'title' => $data['title'],
            'text' => $data['text']
        ]);
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }

    public function searchByName(string $authorName): Collection
    {
        return Article::getArticlesByAuthorName($authorName);
    }
}
