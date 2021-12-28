<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Carbon\Carbon;
use App\Helpers\Translate;
use App\Models\Shape;
use Illuminate\Http\Request;
use ZipArchive;

class ShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if (request()->ajax()) {
            $shapes = Shape::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            if (!is_null($request->search['value'])) {
                $shapes->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $shapes->count();
            $shapes->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($shapes->get() as $shape) {
                $data[] = [
                    'id' => $shape->id,
                    'name' => Translate::t($shape->name),
                    'image' => '<img height="38" src="' . $shape->image . '"/>',
                    'created_at' => Carbon::parse($shape->created_at)->format('d/m/Y'),
                    'action' => view('admin.shapes.actions', ['shape' => $shape])->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Shape::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('admin.shapes.index');
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

		return view('admin.shapes.edit', compact('Languages'));
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
			'name' => 'required|min:1|unique:shapes',
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);

		try {
			$shape = Shape::create($data);

			return response()->json([
				'success' => true,
				'data' => $shape,
				'message' => 'Shape successfully added.',
				'redirect' => route('admin.shapes.index'),
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
    public function edit(Shape $Shape)
    {
		$Languages = Language::all();

		return view('admin.shapes.edit', compact('Shape', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shape $Shape)
    {
		$request->validate([
			'name' => 'required',
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);

		try {
			$Shape->update($data);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Shape successfully updated.',
				'redirect' => route('admin.shapes.index'),
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
    public function destroy(Shape $Shape)
    {
		try {
			$Shape->delete();

			return response()->json([
				'success' => true,
				'data' => $Shape,
				'message' => 'Shape successfully deleted.',
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
        return view('admin.shapes.import');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function import(Request $request)
    {
        try {
            $zip = new ZipArchive();

            $archivePath = public_path($request->archive_path);

            $zip->open($archivePath);

            $zip->extractTo(public_path('storage/uploads/shapes'));

            for( $i = 0; $i < $zip->numFiles; $i++ ){
                $stat = $zip->statIndex( $i );
                $imageName = basename($stat['name']);
                $fileName = explode('.', $imageName);
                if (isset($fileName[1]) && ($fileName[1] == 'png' || $fileName[1] == 'svg')) {
                    Shape::updateOrCreate(
                        [
                            'image' => '/storage/uploads/shapes/' . $imageName
                        ],
                        [
                            'image' => '/storage/uploads/shapes/' . $imageName,
                            'name' => '{"en":"' .  $fileName[0] . '"}'
                        ]
                    );
                } else {
                    unlink(public_path('storage/uploads/shapes/' . $imageName));
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
