<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class UploadController extends Controller
{
	public function upload(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'file' => 'file|required|max:100000'
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => $validator->errors()->all()[0]
			]);
		}

		return response()->json([
			'status' => 'success',
			'name' => $request->file('file')->getClientOriginalName(),
			'type' => explode('/', $request->file('file')->getMimeType())[0],
			'size' => $request->file('file')->getSize(),
			'src' => str_replace('public', 'storage', '/' . Storage::putFile('public/uploads' . (isset($request->folder) && $request->folder ? '/'.$request->folder : ''), $request->file('file')))
		]);
	}

	public function uploadCkeditor(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'upload' => 'file|required|max:100000'
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => $validator->errors()->all()[0]
			]);
		}

		return response()->json([
			'uploaded' => true,
			'status' => 'success',
			'fileName' => $request->file('upload')->getClientOriginalName(),
			'type' => explode('/', $request->file('upload')->getMimeType())[0],
			'size' => $request->file('upload')->getSize(),
			'url' => str_replace('public', 'storage', '/' . Storage::putFile('public/uploads/editor', $request->file('upload')))
		]);
	}
}
