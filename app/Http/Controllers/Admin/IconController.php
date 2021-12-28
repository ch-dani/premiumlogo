<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Helpers\Translate;
use Carbon\Carbon;
use App\Models\Language;
use Illuminate\Http\Request;
use ZipArchive;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	if (request()->ajax()) {
            $icons = Icon::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            if (!is_null($request->search['value'])) {
                $icons->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $icons->count();
            $icons->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($icons->get() as $icon) {
                $data[] = [
                    'id' => $icon->id,
                    'name' => Translate::t($icon->name),
                    'image' => '<img height="38" src="' . $icon->image . '"/>',
                    'created_at' => Carbon::parse($icon->created_at)->format('d/m/Y'),
                    'action' => view('admin.icons.actions', ['icon' => $icon])->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Icon::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('admin.icons.index');
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

		return view('admin.icons.edit', compact('Languages'));
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
			'name' => 'required|min:1|unique:icons',
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);

		try {
			$icon = Icon::create($data);

			return response()->json([
				'success' => true,
				'data' => $icon,
				'message' => 'Icon successfully added.',
				'redirect' => route('admin.icons.index'),
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
    public function edit(Icon $Icon)
    {
		$Languages = Language::all();

		return view('admin.icons.edit', compact('Icon', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Icon $Icon)
    {
		$request->validate([
			'name' => 'required',
		]);

		$data = $request->except(['_token']);

		$data['name'] = json_encode($data['name']);

		try {
			$Icon->update($data);

			return response()->json([
				'success' => true,
				'data' => $data,
				'message' => 'Icon successfully updated.',
				'redirect' => route('admin.icons.index'),
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
    public function destroy(Icon $Icon)
    {
		try {
			$Icon->delete();

			return response()->json([
				'success' => true,
				'data' => $Icon,
				'message' => 'Icon successfully deleted.',
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
        return view('admin.icons.import');
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

            $zip->extractTo(public_path('storage/uploads/icons'));

            for( $i = 0; $i < $zip->numFiles; $i++ ){
                $stat = $zip->statIndex( $i );
                $imageName = basename($stat['name']);
                $fileName = explode('.', $imageName);
                if (isset($fileName[1]) && ($fileName[1] == 'png' || $fileName[1] == 'svg')) {
                    Icon::updateOrCreate(
                        [
                            'image' => '/storage/uploads/icons/' . $imageName
                        ],
                        [
                            'image' => '/storage/uploads/icons/' . $imageName,
                            'name' => '{"en":"' .  $fileName[0] . '"}'
                        ]
                    );
                } else {
                    unlink(public_path('storage/uploads/icons/' . $imageName));
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
