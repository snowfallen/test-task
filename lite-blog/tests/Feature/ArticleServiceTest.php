<?php

namespace Tests\Feature;

use App\Http\Services\ArticleService;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStore()
    {
        $data = [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'authors' => Author::factory()->create()->name,
        ];

        $articleService = new ArticleService();
        $articleService->store($data);

        $article = Article::where('title', $data['title'])->first();

        $this->assertNotNull($article);
        $this->assertEquals($data['title'], $article->title);
        $this->assertEquals($data['text'], $article->text);

        $attachedAuthors = $article->authors;
        $this->assertCount(1, $attachedAuthors);
        $this->assertTrue($attachedAuthors->contains('name', $data['authors']));
    }

    public function testUpdate()
    {
        $article = Article::factory()->create();
        $data = [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'authors' => $article->authors()->get(),
        ];

        $articleService = new ArticleService();
        $articleService->update($data, $article);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => $data['title'],
            'text' => $data['text'],
        ]);
    }

    public function testDelete()
    {
        $article = Article::factory()->create();

        $articleService = new ArticleService();
        $articleService->delete($article);

        $this->assertSoftDeleted($article);
    }
}
