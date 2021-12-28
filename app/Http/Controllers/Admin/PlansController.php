<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plans;

class PlansController extends Controller{


    public function index(Request $req){
    	$plans = Plans::all();
    	
        if($req->ajax()){
        	$data = $this->processForDataTable($req, "Plans", "plans", ["title"=>"name", "price"=>"price"]);
        	return $data;

        }
	    return view('admin.plans.index', ["plans"=>$plans, "table_columns"=>Plans::$table_columns]);
    }

    public function create(){
    }

    public function store(Request $request){
    
    }


    public function show($id){
    }


    public function edit($id){
    
    }

    public function update(Request $request, $id){
    }

    public function destroy(Plans $plan){
    
		try {
			$plan->delete();
			return response()->json([
				'success' => true,
				'data' => $plan,
				'message' => 'Logo successfully deleted.',
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}


//    	parent::destroy($plan);
    }
}
