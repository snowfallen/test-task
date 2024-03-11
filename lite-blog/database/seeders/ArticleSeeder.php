<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory(20)->create()->each(function ($article) {
            $authors = Author::inRandomOrder()->limit(rand(1, 3))->get();
            $article->authors()->attach($authors);
        });
    }
}
