<?php

namespace App\Http\Services;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService extends BaseService
{
    public function store(array $data): void
    {
        Author::create($data);
    }

    public function update(array $data, Author $author): void
    {
        $author->update($data);
    }

    public function delete(Author $author): void
    {
        $articles = $author->articles()->get();
        foreach ($articles as $article) {
            $article->authors()->detach($author);
            if ($article->authors()->count() == 0) {
                $article->delete();
            }
        }
        $author->delete();
    }

    public function getTopAuthorsByArticlesLastWeek(): Collection
    {
        return Author::getTopAuthorsByArticlesLastWeek();
    }
}
