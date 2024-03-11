<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndexRoute()
    {
        $response = $this->get('/authors');

        $response->assertStatus(200);
        $response->assertViewIs('authors.index');
        $response->assertViewHas('authors');
    }

    public function testShowRoute()
    {
        $author = Author::factory()->create();

        $response = $this->get('authors/' . $author->id);

        $response->assertStatus(200);
        $response->assertViewIs('authors.show');
        $response->assertViewHas('author', $author);
    }

    public function testCreateRoute()
    {
        $response = $this->get('/authors/create');

        $response->assertStatus(200);
        $response->assertViewIs('authors.create');
    }

    public function testStoreRoute()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->post('/authors', $data);

        $author = Author::where('name', $data['name'])->first();

        $this->assertNotNull($author);
        $this->assertDatabaseHas('authors', $data);
    }

    public function testEditRoute()
    {
        $author = Author::factory()->create();

        $response = $this->get('authors/' . $author->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('authors.edit');
        $response->assertViewHas('author', $author);
    }

    public function testUpdateRoute()
    {
        $author = Author::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $this->put('authors/' . $author->id, $data);

        $updatedAuthor = Author::find($author->id);

        $this->assertEquals($data['name'], $updatedAuthor->name);
        $this->assertDatabaseHas('authors', $data);
    }

    public function testDestroyRoute()
    {
        $author = Author::factory()->create();

        $this->delete('authors/' . $author->id);

        $this->assertSoftDeleted($author);
    }
}
