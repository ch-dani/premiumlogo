<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Helpers\Translate;
use Carbon\Carbon;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$categories = QuestionCategory::all();

		if($request->ajax()){
//			$data = $this->processForDataTable($request, "QuestionCategory", "faq-categories", ["name"=>"name", "url"=>"url"]);
			$data = $this->processForDataTable($request, "QuestionCategory", "faq-categories", ["name"=>['name'=>'name', 'translatable'=>true], "url"=>"url"]);

			return $data;
		}

		return view('admin.questions.categories.index', ["categories" => $categories, "table_columns" => QuestionCategory::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Languages = Language::all();

		return view('admin.questions.categories.edit', compact('Languages'));
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
			'name' => 'required|min:1|unique:question_categories',
			'url' => 'sometimes|unique:question_categories',
		]);

		$data = $request->except(['_token']);

		if(!isset($data['url']) || !$data['url']){
			foreach($data['name'] as $item){
				if($item){
					$data['url'] = str_slug($item);
					break;
				}
			}
		}

		$data['name'] = json_encode($data['name']);
		$data['content'] = json_encode($data['content']);

		try {
			$category = QuestionCategory::create($data);

			return response()->json([
				'success' => true,
				'data' => $category,
				'message' => 'Category successfully added.',
				'redirect' => route('admin.faq-categories.index'),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, QuestionCategory $FaqCategory)
    {
    	$Category = $FaqCategory;
		$Languages = Language::all();

		return view('admin.questions.categories.edit', compact('Category', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionCategory $FaqCategory)
    {
		$request->validate([
			'name' => 'required',
			'url' => 'sometimes|unique:question_categories,url,' . $FaqCategory->id,
		]);

		$data = $request->except(['_token']);

		if(!isset($data['url']) || !$data['url']){
			foreach($data['name'] as $item){
				if($item){
					$data['url'] = str_slug($item);
					break;
				}
			}
		}

		$data['name'] = json_encode($data['name']);
		$data['content'] = json_encode($data['content']);

		try {
			$FaqCategory->update($data);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Category successfully updated.',
				'redirect' => route('admin.faq-categories.index'),
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
    public function destroy(QuestionCategory $FaqCategory)
    {
		try {
			$FaqCategory->delete();

			return response()->json([
				'success' => true,
				'data' => $FaqCategory,
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
