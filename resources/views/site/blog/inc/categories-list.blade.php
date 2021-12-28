<div id="searchCategoryResult">
    <div class="blog-bottom__sort">
        @foreach($categories as $category)
            <a href="{{ route('blog.category', $category->id) }}" class="blog-bottom__category" style="background-color: {{ $category->color }}">
                {{ Translate::t($category->name) }}
            </a>
        @endforeach
    </div>
</div>
