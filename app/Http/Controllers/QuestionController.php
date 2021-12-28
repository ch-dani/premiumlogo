<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Helpers\Translate;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
	{
		$Categories = QuestionCategory::get();
		$PopularQuestions = Question::where('is_popular', true)->get();

		return view('site.faq.categories', compact('Categories', 'PopularQuestions'));
	}

	public function category(QuestionCategory $Category)
	{
		$Categories = QuestionCategory::get();

		return view('site.faq.category', compact('Category', 'Categories'));
	}

	public function categoryQuestion(QuestionCategory $Category, Question $Question)
	{
		$Categories = QuestionCategory::get();

		return view('site.faq.category', compact('Category', 'Categories', 'Question'));
	}

	public function searchQuestions(Request $request)
	{
		$response = ['success' => true, 'results' => []];

		if($request->has('search') && $request->search){
			$questions = Question::where('name', 'like', '%'.$request->search.'%')->get();

			if(!$questions->isEmpty()){
				foreach($questions as $question){
					$response['results'][] = [
						'id' => $question->id,
						'text' => Translate::t($question->name),
						'url' => route('faq.category-question', [$question->categories()->first(), $question]),
					];
				}
			}
		}

		return response()->json($response);
	}
}
