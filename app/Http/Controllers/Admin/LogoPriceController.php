<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\LogoPrice;

class LogoPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $prices = LogoPrice::all();

        if ($request->ajax()) {
            return $this->processForDataTable($request, "LogoPrice", "logo-prices",
                [
                    "title" => [
                        'name' => 'title',
                        'translatable' => true
                    ],
                    "url" => "url"
                ]);
        }

        return view('admin.logo-prices.index', ["prices" => $prices, "table_columns" => LogoPrice::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Languages = Language::all();

        return view('admin.logo-prices.edit', compact('Languages'));
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
            'price' => 'required',
            'advantages' => 'required',
        ]);

        $data = $request->except(['_token']);

        $data['title'] = json_encode($data['title']);
        $data['advantages'] = json_encode($data['advantages']);

        try {
            $plan = LogoPrice::create($data);

            return response()->json([
                'success' => true,
                'data' => $plan,
                'message' => 'Logo price successfully added.',
                'redirect' => route('admin.logo-prices.index'),
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
    public function edit(LogoPrice $logo_price)
    {
        $LogoPrice = $logo_price;
        $Languages = Language::all();

        return view('admin.logo-prices.edit', compact('LogoPrice', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogoPrice $logo_price)
    {
        $data = $request->except(['_token']);

        $data['title'] = json_encode($data['title']);
        $data['advantages'] = json_encode($data['advantages']);

        try {
            $logo_price->update($data);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Logo price successfully updated.',
                'redirect' => route('admin.logo-prices.index'),
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
    public function destroy(LogoPrice $logo_price)
    {
        try {
            $logo_price->delete();

            return response()->json([
                'success' => true,
                'data' => $logo_price,
                'message' => 'Logo price successfully deleted.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
