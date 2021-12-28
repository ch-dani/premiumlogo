<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignerPlan;
use App\Models\Language;
use Illuminate\Http\Request;

class DesignerPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $plans = DesignerPlan::all();

        if ($request->ajax()) {
            return $this->processForDataTable($request, "DesignerPlan", "designer-plans",
                [
                    "title" => [
                        'name' => 'title',
                        'translatable' => true
                    ],
                    "url" => "url"
                ]);
        }

        return view('admin.designer-plans.index', ["plans" => $plans, "table_columns" => DesignerPlan::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Languages = Language::all();

        return view('admin.designer-plans.edit', compact('Languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'price' => 'required',
            'advantages' => 'required',
        ]);

        $data = $request->except(['_token']);

        $data['title'] = json_encode($data['title']);
        $data['advantages'] = json_encode($data['advantages']);

        try {
            $plan = DesignerPlan::create($data);

            return response()->json([
                'success' => true,
                'data' => $plan,
                'message' => 'Designer plan successfully added.',
                'redirect' => route('admin.designer-plans.index'),
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignerPlan $designer_plan)
    {
        $DesignerPlan = $designer_plan;
        $Languages = Language::all();

        return view('admin.designer-plans.edit', compact('DesignerPlan', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DesignerPlan $designer_plan)
    {
        $data = $request->except(['_token']);

        $data['title'] = json_encode($data['title']);
        $data['advantages'] = json_encode($data['advantages']);

        try {
            $designer_plan->update($data);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Designer plan successfully updated.',
                'redirect' => route('admin.designer-plans.index'),
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignerPlan $designer_plan)
    {
        try {
            $designer_plan->delete();

            return response()->json([
                'success' => true,
                'data' => $designer_plan,
                'message' => 'Designer plan successfully deleted.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
