<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Helpers\Translate;
use Carbon\Carbon;
use App\Models\LogoCategory;
use Illuminate\Http\Request;

class LogoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if (request()->ajax()) {
			$categories = LogoCategory::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

			if (!is_null($request->search['value'])) {
				$categories->where(function ($query) use ($request) {
					foreach ($request->columns as $column) {
						if ($column["searchable"] == "true") {
							$query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
						}
					}
				});
			}

			$recordsFiltered = $categories->count();
			$categories->limit($request->length)
				  ->offset($request->start);
			$data = [];

			foreach ($categories->get() as $category) {
				$data[] = [
					'id' => $category->id,
					'name' => Translate::t($category->name),
//					'image' => '<img width="100" src="' . $logo->image . '"/>',
					'created_at' => Carbon::parse($category->created_at)->format('d/m/Y'),
					'action' => view('admin.logos.categories.actions', ['category' => $category])->render()
				];
			}

			return response()->json([
				'draw' => $request->draw,
				'recordsTotal' => LogoCategory::count(),
				'recordsFiltered' => $recordsFiltered,
				'data' => $data
			]);
		}else{
			return view('admin.logos.categories.index');
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Languages = Language::all();

		return view('admin.logos.categories.edit', compact('Languages'));
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
			'name' => 'required|min:1|unique:logo_categories',
			'url' => 'sometimes|min:1|unique:logo_categories',
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

		try {
			$category = LogoCategory::create($data);

			return response()->json([
				'success' => true,
				'data' => $category,
				'message' => 'Category successfully added.',
				'redirect' => route('admin.logos-categories.index'),
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
    public function edit(Request $request, LogoCategory $logos_category)
    {
    	$Category = $logos_category;
    	$Languages = Language::all();

		return view('admin.logos.categories.edit', compact('Category', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogoCategory $logos_category)
    {
		$request->validate([
			'name' => 'required',
			'url' => 'sometimes|min:1|unique:logo_categories,url,' . $logos_category->id,
		]);

		$data = $request->except(['_token', 'page_id']);

		if(!isset($data['url']) || !$data['url']){
			foreach($data['name'] as $item){
				if($item){
					$data['url'] = str_slug($item);
					break;
				}
			}
		}

		$data['name'] = json_encode($data['name']);

		try {
			$logos_category->update($data);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Category successfully updated.',
				'redirect' => route('admin.logos-categories.index'),
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
    public function destroy(LogoCategory $logos_category)
    {
		try {
			$logos_category->delete();

			return response()->json([
				'success' => true,
				'data' => $logos_category,
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
