<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'title', 'text', 'created_at'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public static function getArticlesByAuthorName(string $authorName): Collection
    {
        $authors = Author::where('name', $authorName);
        if ($authors->get()->count() === 0) {
            return new Collection([]);
        }
        return Author::where('name', $authorName)->firstOrFail()->articles()->get();
    }
}
