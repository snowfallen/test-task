## Controllers

**ArticleController:**

* **Index():** Lists all articles.
* **Create():** Shows a form to create a new article.
* **Store():** Stores a new article.
* **Show():** Shows information about an article.
* **Edit():** Shows a form to edit an article.
* **Update():** Updates an article.
* **Destroy():** Deletes an article.
* **SearchByName():** Returns a list of articles written by an author with the given name.

**AuthorController:**

* **Index():** Lists all authors.
* **Create():** Shows a form to create a new author.
* **Store():** Stores a new author.
* **Show():** Shows information about an author.
* **Edit():** Shows a form to edit an author.
* **Update():** Updates an author.
* **Destroy():** Deletes an author.
* **GetTopAuthorsByArticlesLastWeek():** Returns a list of the top 3 authors by the number of articles in the last week.

## Requests

**ArticleRequest:**

* **Rules():** Defines the validation rules for article data.

**AuthorRequest:**

* **Rules():** Defines the validation rules for author data.

## Services

**ArticleService:**

* **Store():** Stores a new article.
* **Update():** Updates an article.
* **Delete():** Deletes an article.
* **SearchByName():** Returns a list of articles written by an author with the given name.

**AuthorService:**

* **Store():** Stores a new author.
* **Update():** Updates an author.
* **Delete():** Deletes an author.
* **GetTopAuthorsByArticlesLastWeek():** Returns a list of the top 3 authors by the number of articles in the last week.

## BaseService

**Paginate():** Returns a paginator for the given model.

## Models

**Article:**

* **Authors():** Returns a list of authors who wrote this article.
* **GetArticlesByAuthorName():** Returns a list of articles written by an author with the given name.

**Author:**

* **Articles():** Returns a list of articles written by this author.

## Factories

**ArticleFactory:**

* **Definition():** Defines the default data for creating fake Article instances.

**AuthorFactory:**

* **Definition():** Defines the default data for creating fake Author instances.

## Seeders

**ArticleSeeder:**

* **Run():** Creates 20 fake articles and assigns 1-3 random authors to each article.

**AuthorSeeder:**

* **Run():** Creates 20 fake authors.

**DatabaseSeeder:**

* **Run():** Calls the AuthorSeeder and ArticleSeeder.

## *Endpoints for Author*

| HTTP Method | Path           | Route Name                                 | Controller          | Method | Description                                                           |
|---|---|---|---|---|---|
| GET, HEAD | http://127.0.0.1:8000/authors    | authors.index                               | AuthorController     | @index | Lists all authors.                                                 |
| POST | http://127.0.0.1:8000/authors    | authors.store                               | AuthorController     | @store | Creates a new author.                                              |
| GET, HEAD | http://127.0.0.1:8000/authors/create | authors.create                             | AuthorController     | @create | Form to create a new author.                                       |
| GET, HEAD | http://127.0.0.1:8000/authors/top | authors.top                                 | AuthorController     | @getTopAuthorsByArticlesLastWeek    | Lists top authors by articles from the last week.                |
| GET, HEAD | http://127.0.0.1:8000/authors/{author} | authors.show                               | AuthorController     | @show | Shows a specific author.                                           |
| PUT, PATCH | http://127.0.0.1:8000/authors/{author} | authors.update                             | AuthorController     | @update | Updates a specific author.                                       |
| DELETE | http://127.0.0.1:8000/authors/{author} | authors.destroy                            | AuthorController     | @destroy| Deletes a specific author.                                       |
| GET, HEAD | http://127.0.0.1:8000/authors/{author}/edit | authors.edit                               | AuthorController     | @edit | Form to edit a specific author.                                    |

## *Endpoints for Article*

| HTTP Method | Path           | Route Name                                 | Controller          | Method | Description                        |
|---|---|---|---|---|------------------------------------|
| GET, HEAD | http://127.0.0.1:8000/articles | articles.index                             | ArticleController    | @index | Lists all articles.                |
| POST | http://127.0.0.1:8000/articles  | articles.store                              | ArticleController    | @store | Creates a new article.             |
| GET, HEAD | http://127.0.0.1:8000/articles/create | articles.create                             | ArticleController    | @create | Form to create a new article.      |
| GET, HEAD | http://127.0.0.1:8000/articles/{article} | articles.show                               | ArticleController    | @show | Shows a specific article.          |
| PUT, PATCH | http://127.0.0.1:8000/articles/{article} | articles.update                             | ArticleController    | @update | Updates a specific article.        |
| DELETE | http://127.0.0.1:8000/articles/{article} | articles.destroy                            | ArticleController    | @destroy| Deletes a specific article.        |
| GET, HEAD | http://127.0.0.1:8000/articles/{article}/edit | articles.edit                               | ArticleController    | @edit | Form to edit a specific article.   |
| GET, HEAD | http://127.0.0.1:8000/articles/by/author/name/{authorName} | articles.search                               | ArticleController    | @searchByName | Search all articles by author name |
