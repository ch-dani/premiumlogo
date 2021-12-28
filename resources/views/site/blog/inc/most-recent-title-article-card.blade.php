<article class="hentry post-big">
    <div class="post-big__thumb">
        <img src="{{ $mostRecentTitleArticle->title_image }}" width="686" height="426"
             alt="{{ Translate::t($mostRecentTitleArticle->name) }}">
        <div class="overlay"></div>
    </div>

    <div class="post-big__content">
        <a href="{{ route('blog.category', $mostRecentTitleArticle->category->id) }}" class="post-big__category" style="background-color: {{ $mostRecentTitleArticle->category->color }}">
            {{ Translate::t($mostRecentTitleArticle->category->name) }}
        </a>
        <span class="post-big__date">
                                <time class="published" datetime="2020-09-28 12:00:00">
                                    {{ $mostRecentTitleArticle->created_at->format('d.m.Y') }}
                                </time>
                            </span>
        <h2 class="big-post__title entry-title">
            <a href="{{ route('blog.article', $mostRecentTitleArticle->id) }}" class="big-post__link">
                {{ Translate::t($mostRecentTitleArticle->name) }}
            </a>
        </h2>
    </div>
</article>
