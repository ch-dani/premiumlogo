<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$questions = Question::all();

		if($request->ajax()){
			$data = $this->processForDataTable($request, "Question", "faq", ["name"=>['name'=>'name', 'translatable'=>true], "url"=>"url"]);

			return $data;
		}

		return view('admin.questions.index', ["questions" => $questions, "table_columns" => Question::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Languages = Language::all();
		$Categories = QuestionCategory::all();

		return view('admin.questions.edit', compact('Languages', 'Categories'));
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
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);
		$data['content'] = json_encode($data['content']);

		try {
			$question = Question::create($data);
			$question->categories()->sync($request->categories);

			return response()->json([
				'success' => true,
				'data' => $question,
				'message' => 'Question successfully added.',
				'redirect' => route('admin.faq.index'),
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
    public function edit(Question $Faq)
    {
    	$Question = $Faq;
		$Languages = Language::all();
		$Categories = QuestionCategory::all();
		$question_categories_ids = $Question->categories->pluck('id')->toArray();

		return view('admin.questions.edit', compact('Question', 'Languages', 'Categories', 'question_categories_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $faq)
    {
		$request->validate([
			'name' => 'required',
			'categories' => 'required',
		]);

		$data = $request->except(['_token', 'page_id']);

		$data['name'] = json_encode($data['name']);
		$data['content'] = json_encode($data['content']);
//		dd($data);

		try {
			$faq->update($data);
			$faq->categories()->sync($request->categories);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Question successfully updated.',
				'redirect' => route('admin.faq.index'),
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
    public function destroy(Question $Faq)
    {
		try {
			$Faq->delete();

			return response()->json([
				'success' => true,
				'data' => $Faq,
				'message' => 'Question successfully deleted.',
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}
    }
}
