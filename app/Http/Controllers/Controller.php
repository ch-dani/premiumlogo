<?php

namespace App\Http\Controllers;

use App\Helpers\Translate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function proccessFields($item, $fields)
    {
        $ret = [];
        foreach ($fields as $key => $field) {
            $translatable = false;

            if (is_array($field)) {
                if (isset($field['translatable'])) {
                    $translatable = $field['translatable'];
                }

                $field = $field['name'];
            }

            if ($translatable) {
                $ret[$field] = Translate::t($item->{"$key"});
            } else {
                $ret[$field] = $item->{"$key"};
            }
        }

        return $ret;
    }

    public function processForDataTable(\Illuminate\Http\Request $request, $model_name = "", $route_name = "", $fields = ["name" => "name"])
    {
        if (!$model_name) {
            return false;
        }
        $model = "\App\Models\\$model_name";

        $items = $model::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);
        if (!is_null($request->search['value'])) {
            $items->where(function ($query) use ($request) {
                foreach ($request->columns as $column) {
                    if ($column["searchable"] == "true") {
                        $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                    }
                }
            });
        }

        $recordsFiltered = $items->count();
        $items->limit($request->length)
            ->offset($request->start);
        $data = [];

        foreach ($items->get() as $item) {
            $def    = [
                'id'         => $item->id,
                'created_at' => Carbon::parse($item->created_at)->format('d/m/Y'),
                'action'     => view('admin.inc.table-actions', ['item' => $item, "route" => ($route_name ? $route_name : strtolower($model_name))])->render()
            ];
            $data[] = array_merge(
                $def,
                $this->proccessFields($item, $fields)
            );
        }
        return [
            'draw'            => $request->draw,
            'recordsTotal'    => $model::count(),
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data
        ];
    }

//    public function destroy($item){
//		try {
//			$item->delete();

//			return response()->json([
//				'success' => true,
//				'data' => $item,
//				'message' => 'Logo successfully deleted.',
//			]);
//		} catch (\Exception $exception) {
//			return response()->json([
//				'success' => false,
//				'message' => $exception->getMessage()
//			]);
//		}
//    }


    public function __construct()
    {
//        \Artisan::call('cache:clear');
//        \Artisan::call('route:cache');
//        \Artisan::call('config:cache');
//        \Artisan::call('view:clear');
    }
}
