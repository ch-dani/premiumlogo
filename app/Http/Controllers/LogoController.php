<?php

namespace App\Http\Controllers;

use App\Helpers\Translate;
use App\Models\Icon;
use App\Models\Logo;
use App\Models\LogoCategory;
use App\Models\Shape;
use App\Services\IconFinderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogoController extends Controller{

	public function index(Request $req){
		$admin_mode = \Auth::guard('admin')->check();
		return view('site.logo', [
			"admin_mode"=>$admin_mode
		]);
	}
	

	public function createTemplate(Request $req){
		$admin_mode = \Auth::guard('admin')->check();
		return view('site.logo', [
			"admin_mode"=>$admin_mode
		]);
	}
	


	public function templateEdit(Request $req, \App\Models\Template $template){
		$admin_mode = \Auth::guard('admin')->check();
		
		return view('site.logo', [
			"is_edit"=>true,
			"admin_mode"=>$admin_mode,
			"template"=>$template->content
		]);
	}


	public function template(Request $req, \App\Models\Template $template){
	
		$admin_mode = \Auth::guard('admin')->check();
		
		
		return view('site.logo', [
			"admin_mode"=>$admin_mode,
			"template"=>$template->content
		]);
	}
	
	
	public function templateList(Request $req){
		$templates = \App\Models\Template::get();
		$return = [];
		
		$category = $req->category??"";
		
		foreach($templates as $template){
			$return[$template->type] = $return[$template->type] ?? []; 
			$return[$template->type][] = [
				"id"=>$template->id,
				"name"=>$template->name?$template->name:ucfirst($template->type." ".$template->id),
				"type"=>$template->type,
				"thumbnail"=>$template->thumbnail
			];
		}
		if($category){
			return ["success"=>true, "data"=>$return[$category] ?? []];
		}else{
			return ["success"=>true, "data"=>$return];
		}
	}
	
	
	public function templateListById(Request $req, \App\Models\Template $template){	
	
		return $template;
	}

    /**
     * @return array|\Illuminate\Contracts\Foundation\Applffication|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function categories()
    {
        $categories = LogoCategory::get();
        return view('site.logos.categories', compact('categories'));
    }

    /**
     * @param LogoCategory $category
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function category(LogoCategory $category)
    {
        return view('site.logos.category', compact('category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function searchCategories(Request $request){
    
        $response = ['success' => true, 'html' => ''];

        $categories = LogoCategory::where('name', 'like', '%' . $request->search . '%')->get();
//		dump($categories);

        if (!$categories->isEmpty()) {
            foreach ($categories as $category) {
                $response['html'] .= view('site.inc.items.logos-category', ['category' => $category])->render();
            }
        } else {
            $response['html'] = view('site.inc.items.logos-category-empty')->render();
        }

//		dd($response);
        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveUserLogo(Request $request){
    	\App\Helpers\Logo::saveUserLogo($request);

        return response()->json([ 'success' => true ]);
    }

    // https://logo.webstaginghub.com/logos/json/categories
    public function getCategoriesJson()
	{
		$categories = LogoCategory::all(); //::with('logos')->get();
		foreach($categories as &$cat){
			$cat->amount = count($cat->logos()->get());
		}
		

		return response()->json($categories);
	}

	// https://logo.webstaginghub.com/logos/json/logos
	// https://logo.webstaginghub.com/logos/json/logos/5
	public function getLogosJson(Request $request, LogoCategory $category)
	{
		if($category->exists){
			$logos = $category->logos()->paginate(15);
		}else{
			$logos = Logo::paginate(15);
		}

		return response()->json($logos);
	}

	// https://logo.webstaginghub.com/logos/json/shapes
	public function getShapesJson()
	{
		$items = Shape::paginate(15);

		return response()->json($items);
	}

    // https://logo.webstaginghub.com/logos/json/icons
    public function getIconsJson(Request $request)
    {
        $items = [];
        $icons = IconFinderService::search($request->input('query'),
            config('iconfinder.per_page'),
            --$request->page * config('iconfinder.per_page'));

        if ($icons) {
            foreach ($icons['icons'] as $icon) {
                foreach ([64, 128, 48] as $size) {
                    $key = array_search($size, array_column($icon['raster_sizes'], 'size'));

                    if ($key) {
                        break;
                    }
                }

                if (!$key) {
                    continue;
                }

                if (isset($icon['raster_sizes'][$key]["formats"][0]['preview_url'])) {
                    $items[] = [
                        'image' => route('logos.json.icon', ['icon' => $icon['raster_sizes'][$key]["formats"][0]['preview_url']]),
                        'name_translate' => ucfirst($icon['tags'][0])
                    ];
                }
            }
        }

        return response()->json([
            'data' => $items
        ]);
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getIcon(Request $request)
    {
        return file_get_contents($request->icon);
    }
}
