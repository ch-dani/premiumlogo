<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\BlogArticleCategory;
use App\Models\Language;
use App\Traits\PaginateCollection;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use PaginateCollection;

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $categories         = BlogArticleCategory::all();
        $articles           = BlogArticle::where('is_published', true)->latest()->get();
        $mostRecentArticles = collect();
        for ($i = 0; $i < 4; $i++) {
            $mostRecentArticles[] = $articles->pull($i);
        }
        $articles               = $this->paginate($articles);
        $mostRecentTitleArticle = $mostRecentArticles->pull(0);

        return view('site.blog.index', compact('articles', 'mostRecentArticles', 'mostRecentTitleArticle', 'categories'));
    }

    /**
     * @param int $categoryId
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function category(int $categoryId)
    {
//        $category           = BlogArticleCategory::findOrFail($categoryId);
//        $categories         = BlogArticleCategory::all();
//        $articles           = $category->articles()->where('is_published', true)->latest()->get();
//        $mostRecentArticles = collect();
//        for ($i = 0; $i < 4; $i++) {
//            $mostRecentArticles[] = $articles->pull($i);
//        }
//        $articles               = $this->paginate($articles);
//        $mostRecentTitleArticle = $mostRecentArticles->pull(0);

        $category               = BlogArticleCategory::findOrFail($categoryId);
        $categories             = BlogArticleCategory::all();
        $articles               = $category->articles()->where('is_published', true)->latest()->get();
        $mostRecentArticles     = $articles->take(4);
        $articles               = $this->paginate($articles);
        $mostRecentTitleArticle = $mostRecentArticles->take(1)[0];

        return view('site.blog.category', compact('articles', 'mostRecentArticles', 'mostRecentTitleArticle', 'categories', 'category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function searchCategory(Request $request)
    {
        if ($request->ajax()) {
            $localeCode = $request->locale ?? 'en';
            $categories = BlogArticleCategory::all();

            if (!empty($request->keyword)) {
                $matchedCategories = collect();

                foreach ($categories as $category) {
                    $categoryNamesDecoded = json_decode($category->name);
                    if (isset($categoryNamesDecoded->{$localeCode})) {
                        if (strpos($categoryNamesDecoded->{$localeCode}, ucfirst($request->keyword)) !== false) {
                            $matchedCategories->push($category);
                        }
                    }
                }
            }

            return response()->json(['view' => view('site.blog.inc.categories-list', ['categories' => $matchedCategories ?? $categories])->render()]);
        }
    }

    /**
     * @param BlogArticle $article
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function article(BlogArticle $article)
    {
        $categories             = BlogArticleCategory::all();
        $articles               = BlogArticle::where('is_published', true)->latest()->get();
        $mostRecentArticles     = $articles->take(4);
        $articles               = $this->paginate($articles);
        $mostRecentTitleArticle = $mostRecentArticles->take(1)[0];
        return view('site.blog.article', compact('articles', 'mostRecentArticles', 'mostRecentTitleArticle', 'article', 'categories'));
    }
}
