<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public static function getTopAuthorsByArticlesLastWeek(): Collection
    {
        if (!static::exists()) {
            return new Collection([]);
        }

        $authors = static::withCount('articles')
            ->whereHas('articles')
            ->get();

        return self::getTopAuthorsFromCollection($authors);
    }

    private static function getTopAuthorsFromCollection(Collection $authors): Collection
    {
        $authorsWhoHasArticles = [];
        foreach ($authors as $author) {
            if (self::validateDates($author)) {
                $authorsWhoHasArticles[$author->id] = $author->articles()->get()->count();
            }
        }
        arsort($authorsWhoHasArticles);

        return self::sortByArticlesCount(array_slice($authorsWhoHasArticles, 0, 3, true));
    }

    private static function sortByArticlesCount(array $authorsWhoHasArticles): Collection
    {
        return Author::whereIn('id', array_keys($authorsWhoHasArticles))->get()
            ->sortBy(fn($a) => -$a->articles()->get()->count());
    }

    private static function validateDates(Author $author): Collection
    {
        return $author->articles->whereBetween('created_at', [
            Carbon::today()->startOfWeek()->subWeek(),
            Carbon::today()->endOfWeek()->subWeek()
        ]);
    }
}
