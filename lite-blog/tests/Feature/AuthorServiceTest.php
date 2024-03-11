<?php

namespace Tests\Feature;

use App\Http\Services\AuthorService;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Collection\Collection;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class AuthorServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStore()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $authorService = new AuthorService();
        $authorService->store($data);

        $author = Author::where('name', $data['name'])->first();

        $this->assertNotNull($author);
        $this->assertEquals($data['name'], $author->name);
    }

    public function testUpdate()
    {
        $author = Author::factory()->create();
        $data = [
            'name' => $this->faker->name,
        ];

        $authorService = new AuthorService();
        $authorService->update($data, $author);

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => $data['name'],
        ]);
    }

    public function testDelete()
    {
        $author = Author::factory()->create();
        $articles = Article::factory(3)->create();
        $author->articles()->attach($articles);

        $authorService = new AuthorService();
        $authorService->delete($author);

        $this->assertSoftDeleted($author);

        foreach ($articles as $article) {
            $this->assertFalse($article->authors->contains($author->id));
            if ($article->authors->count() === 0) {
                $this->assertSoftDeleted($article);
            } else {
                $this->assertDatabaseHas('articles', ['id' => $article->id]);
            }
        }
    }


    public function testGetTopAuthorsByArticlesLastWeek()
    {
        $authorService = new AuthorService();
        assertEquals(0, $authorService->getTopAuthorsByArticlesLastWeek()->count());
    }

    public function testGetTopAuthorsByArticles()
    {
        $john = Author::factory()->create();
        $sam = Author::factory()->create();
        $frodo = Author::factory()->create();
        $pipin = Author::factory()->create();
        $authorService = new AuthorService();
        $authorService->update(['name' => 'John'], $john);
        $authorService->update(['name' => 'Sam'], $sam);
        $authorService->update(['name' => 'Frodo'], $frodo);
        $authorService->update(['name' => 'Pipin'], $pipin);

        $john->articles()->attach(Article::factory(5)->create());
        $sam->articles()->attach(Article::factory(2)->create());
        $frodo->articles()->attach(Article::factory(4)->create());
        $pipin->articles()->attach(Article::factory(1)->create());

        assertEquals('John', $authorService->getTopAuthorsByArticlesLastWeek()[0]->name);
        assertEquals('Frodo', $authorService->getTopAuthorsByArticlesLastWeek()[2]->name);
        assertEquals('Sam', $authorService->getTopAuthorsByArticlesLastWeek()[1]->name);
        assertEquals(3, $authorService->getTopAuthorsByArticlesLastWeek()->count());
    }
}
