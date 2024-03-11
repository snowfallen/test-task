<nav class="navbar navbar-light bg-light justify-content-between mb-5 px-5">
    <a class="navbar-brand">Test task for Online Venture sp. z o.o</a>
    <nav>
        <a href="{{ route('authors.index') }}" class="text-decoration-none m-2 p-2">Authors</a>
        <a href="{{ route('articles.index') }}" class="text-decoration-none m-2 p-2">Articles</a>
        <a href="{{ route('authors.top') }}" class="text-decoration-none m-2 p-2">Best authors</a>
    </nav>
    <form class="form-inline d-flex searchForm" id="searchForm">
        <input class="form-control mr-sm-2 m-2" id="authorName" type="search" placeholder="Search" aria-label="Search">
        <div id="searchResults" class="mt-3 position-absolute top-100 card end-20"></div>
    </form>
    <script>
        const searchForm = document.getElementById('searchForm');
        const authorNameInput = document.getElementById('authorName');
        const searchResults = document.getElementById('searchResults');

        authorNameInput.addEventListener('input', debounce(() => {
            const authorName = authorNameInput.value.trim();

            if (authorName.length > 0) {
                getArticle(authorName);
            } else {
                searchResults.innerHTML = '';
            }
        }, 600));

        function debounce(func, delay) {
            let timeoutId;
            return function () {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => func.apply(this, arguments), delay);
            };
        }

        async function getArticle(authorName) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/articles/by/author/name/${authorName}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                searchResults.innerHTML = '';

                if (data.length === 0) {
                    searchResults.innerHTML = '<p class="text-muted p-2">No articles found for author "' + authorName + '".</p>';
                } else {
                    let resultsHtml = '';
                    for (const article of data) {
                        resultsHtml += `
                            <a href="articles/${article.id}" class="d-block text-decoration-none mb-2 p-2">  ${article.title}
                            </a>
                        `;
                    }
                    searchResults.innerHTML = resultsHtml;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                searchResults.innerHTML = '<p class="text-danger">An error occurred during search.</p>';
            }
        }

    </script>
</nav>
