<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Helpers\Translate;
use App\Models\LogoCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Logo;
use ZipArchive;
use \App\Models\Template;

class TemplatesController extends Controller{


	public function saveTemplate(Request $req){
		\App\Models\Template::create($req->except("_token"));	
		return ["success"=>true];
	}
	
	
	public function templateList(Request $req){
	
		exit("time to list");
	
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        if (request()->ajax()) {
			$templates = Template::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

			if (!is_null($request->search['value'])) {
				$templates->where(function ($query) use ($request) {
					foreach ($request->columns as $column) {
						if ($column["searchable"] == "true") {
							$query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
						}
					}
				});
			}

			$recordsFiltered = $templates->count();
			$templates->limit($request->length)
					 ->offset($request->start);
			$data = [];

			foreach ($templates->get() as $t) {
				$data[] = [
					'id' => $t->id,
					'name' => $t->name?$t->name:ucfirst($t->type." ".$t->id),
					'type' => ucfirst($t->type),
					'created_at' => Carbon::parse($t->created_at)->format('d/m/Y'),
					'action' => view('admin.templates.actions', ['template' => $t])->render()
				];
			}

			return response()->json([
				'draw' => $request->draw,
				'recordsTotal' => Logo::count(),
				'recordsFiltered' => $recordsFiltered,
				'data' => $data
			]);
        }else{
        
        	return view('admin.templates.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//		$Categories = LogoCategory::get();
//		$Languages = Language::all();

		return view('admin.logos.edit'); //, compact('Categories', 'Languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	exit("store 1");
		$request->validate([
			'name' => 'required|min:1|unique:logos',
			'categories' => 'required',
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);

		try {
			$logo = Logo::create($data);

			$logo->categories()->sync($request->categories);

			return response()->json([
				'success' => true,
				'data' => $logo,
				'message' => 'Logo successfully added.',
				'redirect' => route('admin.logos.index'),
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
	 * @param Logo $logo
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Logo $Logo)
    {
    	exit("edit 1");
    	$Categories = LogoCategory::get();
		$Languages = Language::all();
    	$logo_categories_ids = $Logo->categories->pluck('id')->toArray();

		return view('admin.logos.edit', compact('Logo', 'Categories', 'Languages', 'logo_categories_ids'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param Logo $logo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Logo $logo)
    {
    	exit("update 1");
		$request->validate([
			'name' => 'required',
			'categories' => 'required',
		]);

		$data = $request->except(['_token', 'page_id']);

		$data['name'] = json_encode($data['name']);

		try {
			$logo->update($data);
			$logo->categories()->sync($request->categories);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Logo successfully updated.',
				'redirect' => route('admin.logos.index'),
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
    public function destroy(Template $template)
    {
		try {
			$template->delete();

			return response()->json([
				'success' => true,
				'data' => $template,
				'message' => 'Template successfully deleted.',
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}
    }
    /**
     * @return array|mixed
     */
    public function importIndex()
    {
        $Categories = LogoCategory::get();
        return view('admin.logos.import', compact('Categories'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function import(Request $request)
    {
        $request->validate([
            'categories' => 'required',
        ]);

        try {
            $zip = new ZipArchive();

            $archivePath = public_path($request->archive_path);

            $zip->open($archivePath);

            $zip->extractTo(public_path('storage/uploads/logos'));

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $stat = $zip->statIndex($i);
                $imageName = basename($stat['name']);
                $fileName = explode('.', $imageName);
                if (isset($fileName[1]) && $fileName[1] == 'svg') {
                    $logo = Logo::updateOrCreate(
                        [
                            'image' => '/storage/uploads/logos/' . $imageName
                        ],
                        [
                            'image' => '/storage/uploads/logos/' . $imageName,
                            'name' => '{"en":"' . $fileName[0] . '"}'
                        ]
                    );

                    $logo->categories()->sync($request->categories);
                } else {
                    unlink(public_path('storage/uploads/logos/' . $imageName));
                }
            }

            $zip->close();

            unlink($archivePath);

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
