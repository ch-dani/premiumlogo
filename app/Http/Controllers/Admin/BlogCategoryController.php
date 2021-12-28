<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArticleCategory;
use App\Models\Language;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = BlogArticleCategory::all();

        if($request->ajax()){
            return $this->processForDataTable($request, "BlogArticleCategory", "blog-categories", ["name"=>['name'=>'name', 'translatable'=>true], "url"=>"url"]);
        }

        return view('admin.blog.categories.index', ["categories" => $categories, "table_columns" => BlogArticleCategory::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Languages = Language::all();

        return view('admin.blog.categories.edit', compact('Languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|unique:blog_article_categories',
            'color' => 'required',
        ]);

        $data = $request->except(['_token']);

        $data['name'] = json_encode($data['name']);

        try {
            $category = BlogArticleCategory::create($data);

            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Category successfully added.',
                'redirect' => route('admin.blog-categories.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BlogArticleCategory $blog_category)
    {
        $Category = $blog_category;
        $Languages = Language::all();

        return view('admin.blog.categories.edit', compact('Category', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogArticleCategory $blog_category)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);

        $data = $request->except(['_token']);

        $data['name'] = json_encode($data['name']);

        try {
            $blog_category->update($data);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Category successfully updated.',
                'redirect' => route('admin.blog-categories.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogArticleCategory $blog_category)
    {
        try {
            $blog_category->delete();

            return response()->json([
                'success' => true,
                'data' => $blog_category,
                'message' => 'Category successfully deleted.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
