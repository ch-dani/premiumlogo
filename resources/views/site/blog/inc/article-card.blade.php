<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <article class="hentry blog-bottom__post">
        <div class="blog-bottom__thumb">
        	<a href="{{ route('blog.article', $article->id) }}">
		        <img src="{{ $article->title_image }}" width="377" height="240"
		             alt="{{ Translate::t($article->name) }}">
			</a>
        </div>

        <div class="blog-bottom__content">
            <a href="{{ route('blog.category', $article->category->id) }}" class="blog-bottom__category" style="background-color: {{ $article->category->color }}">
                {{ Translate::t($article->category->name) }}
            </a>
            <span class="blog-bottom__date">
                                            <time class="published" datetime="2020-09-28 12:00:00">
                                                {{ $article->created_at->format('d.m.Y') }}
                                            </time>
                                        </span>
            <h2 class="blog-bottom__title entry-title">
                <a href="{{ route('blog.article', $article->id) }}" class="blog-bottom__link">
                    {{ Translate::t($article->category->name) }}
                </a>
            </h2>
        </div>
    </article>
</div>
