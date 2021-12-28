<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogArticle;
use App\Models\BlogArticleCategory;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @param Request $request
     * @return array|false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index(Request $request)
    {
        $articles = BlogArticle::all();
        $table_columns = BlogArticle::$table_columns;

        if ($request->ajax()) {
            return $this->processForDataTable(
                $request,
                'BlogArticle',
                'blog',
                [
                    'name' => ['name' => 'name', 'translatable' => true],
//                    'content' => ['name' => 'content', 'translatable' => true],
                    'is_published' => ['name' => 'is_published'],
                ]
            );
        }

        return view('admin.blog.index', ['articles' => $articles, 'table_columns' => $table_columns]);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create()
    {
        $Languages = Language::all();
        $statusOptions = collect(['1' => 'Published', '0' => 'Hidden'])->prepend('Select option');
        $Categories = BlogArticleCategory::all();

        return \view('admin.blog.edit', compact('Languages', 'statusOptions', 'Categories'));
    }

    /**
     * @param BlogArticle $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogArticle $article)
    {
        try {
            $article->delete();

            return response()->json([
                'success' => true,
                'data' => $article,
                'message' => 'Article successfully deleted.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|min:3',
            'content' => 'required',
        ]);

        $data = $request->except(['_token']);

        $data['name'] = json_encode($data['name']);
        $data['content'] = json_encode($data['content']);

        try {
            $article = BlogArticle::create($data);
            return response()->json([
                'success' => true,
                'data' => $article,
                'message' => 'Article successfully added.',
                'redirect' => route('admin.blog.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @param BlogArticle $blog
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function edit(BlogArticle $blog)
    {
        $Languages = Language::all();
        $statusOptions = collect(['1' => 'Published', '0' => 'Hidden'])->prepend('Select option');
        $Categories = BlogArticleCategory::all();

        $article = $blog;
        return view('admin.blog.edit', compact('article', 'Languages', 'statusOptions', 'Categories'));
    }

    /**
     * @param Request $request
     * @param BlogArticle $blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BlogArticle $blog)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $data = $request->except(['_token', 'article_id']);

        $data['name'] = json_encode($data['name']);
        $data['content'] = json_encode($data['content']);

        try {
            $blog->update($data);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Article successfully updated.',
                'redirect' => route('admin.blog.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
