<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Block;

class BlockController extends Controller
{
	/*
    public function whyChooseFreeLogoDesign()
    {
        $Languages = Language::all();
        $name = 'why-choose-freeLogoDesign';
        $block = Block::where('name', $name)->first();

        return view('admin.blocks.' . $name, compact('block', 'name', 'Languages'));
    }

    public function professionalLogosForYourCompany()
    {
        $Languages = Language::all();
        $name = 'professional-logos-for-your-company';
        $block = Block::where('name', $name)->first();

        return view('admin.blocks.' . $name, compact('block', 'name', 'Languages'));
    }
	*/

    public function edit(Request $request)
	{
		$Languages = Language::all();
		$name = collect(explode('.', $request->route()->getName()))->last();
		$block = Block::where('name', $name)->first();

		return view('admin.blocks.' . $name, compact('block', 'name', 'Languages'));
	}

    public function update(Request $request)
    {
		$data = $request->except(['_token']);

		$data['data'] = json_encode($data['data']);

		try {
			$block = Block::updateOrCreate(
				['name' => $request->name],
				$data
			);

			return response()->json([
				'success' => true,
				'data' => $block,
				'message' => 'Block successfully updated.',
				'redirect' => route('admin.blocks.' . $request->name),
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}
    }
}
