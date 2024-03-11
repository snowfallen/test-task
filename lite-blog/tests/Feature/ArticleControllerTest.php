<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndexRoute()
    {
        $response = $this->get('articles');

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles');
    }

    public function testShowRoute()
    {
        $article = Article::factory()->create();

        $response = $this->get('articles/' . $article->id);

        $response->assertStatus(200);
        $response->assertViewIs('articles.show');
        $response->assertViewHas('article', $article);
    }

    public function testCreateRoute()
    {
        $response = $this->get('/articles/create');

        $response->assertStatus(200);
        $response->assertViewIs('articles.create');
    }

    public function testStoreRoute()
    {
        $data = [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'authors' => Author::factory()->create()->name,
        ];

        $this->post('/articles', $data);

        $this->assertDatabaseHas('articles', ['title' => $data['title'], 'text' => $data['text']]);
    }

    public function testEditRoute()
    {
        $article = Article::factory()->create();

        $response = $this->get('articles/' . $article->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('articles.edit');
        $response->assertViewHas('article', $article);
    }

    public function testUpdateRoute()
    {
        $author = Author::factory()->create();
        $article = Article::factory()->create();
        $article->authors()->attach($author);
        $data = [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'authors' => $author->name
        ];

        $this->put('articles/' . $article->id, $data);
        $updatedArticle = Article::find($article->id);
        $this->assertEquals($data['title'], $updatedArticle->title);
        $this->assertDatabaseHas('articles', ['title' => $data['title'], 'text' => $data['text']]);
    }

    public function testDestroyRoute()
    {
        $article = Article::factory()->create();

        $this->delete('articles/' . $article->id);

        $this->assertSoftDeleted($article);
    }

    public function testGetArticlesByAuthorName()
    {
        $author1 = Author::factory()->create();
        $author1->articles()->attach(Article::factory(3)->create());
        $author2 = Author::factory()->create();
        $author2->articles()->attach(Article::factory(2)->create());
        assertEquals('1',$this->get('articles/by/author/name/' . $author1->name)[0]['id']);
        assertEquals('2',$this->get('articles/by/author/name/' . $author1->name)[1]['id']);
        assertEquals('3',$this->get('articles/by/author/name/' . $author1->name)[2]['id']);
        assertEquals('4',$this->get('articles/by/author/name/' . $author2->name)[0]['id']);
        assertEquals('5',$this->get('articles/by/author/name/' . $author2->name)[1]['id']);
    }
}
