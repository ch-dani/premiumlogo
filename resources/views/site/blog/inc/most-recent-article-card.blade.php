@isset($mostRecentArticle)
    <article class="hentry article-list__post">
        <div class="article-list__thumb">
            <a href="{{ route('blog.article', $mostRecentArticle->id) }}">
		        <img src="{{ $mostRecentArticle->title_image }}" width="100" height="102"
		             alt="{{ Translate::t($mostRecentArticle->name) }}">
            </a>
        </div>

        <div class="article-list__content">
            <a href="{{ route('blog.category', $mostRecentArticle->category->id) }}" class="article-list__category" style="background-color: {{ $mostRecentArticle->category->color }}">
                {{ Translate::t($mostRecentArticle->category->name) }}
            </a>
            <span class="article-list__date">
            <time class="published" datetime="2020-09-28 12:00:00">
                {{ $mostRecentArticle->created_at->format('d.m.Y') }}
            </time>
        </span>
            <h2 class="article-list__title entry-title">
                <a href="{{ route('blog.article', $mostRecentArticle->id) }}" class="article-list__link">
                    {{ Translate::t($mostRecentArticle->name) }}
                </a>
            </h2>
        </div>
    </article>
@endisset
