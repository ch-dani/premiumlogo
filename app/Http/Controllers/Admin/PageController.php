<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Language;

class PageController extends Controller {
	public function index( Request $request ) {
		$pages = Page::all();

		if ( $request->ajax() ) {
			$data = $this->processForDataTable( $request, "Page", "pages", [
				"title" => [
					'name'         => 'title',
					'translatable' => true
				],
				"url"   => "url"
			] );

			return $data;
		}

		return view( 'admin.pages.index', [ "pages" => $pages, "table_columns" => Page::$table_columns ] );
	}

	public function create(): View {
		$Languages = Language::all();
//      $statusOptions = collect(Page::STATUS_OPTIONS)->prepend('Select option');
		$statusOptions = collect( Page::STATUS_OPTIONS );

		return \view( 'admin.pages.edit', compact( 'Languages', 'statusOptions' ) );
	}

	public function edit( Page $page ) {
		$Languages = Language::all();
//      $statusOptions = collect(Page::STATUS_OPTIONS)->prepend('Select option');
		$statusOptions = collect( Page::STATUS_OPTIONS );

		return view( 'admin.pages.edit', compact( 'page', 'Languages', 'statusOptions' ) );
	}

	public function store( Request $request ) {
		$request->validate( [
//          'key' => 'required|min:1|unique:pages',
//			'key'              => 'required',
			'slug'             => 'required',
			'title'            => 'required|min:1',
			'content'          => 'required|min:1',
			'meta_title'       => 'required|min:1',
			'meta_description' => 'required|min:1'
		] );

		$data = $request->except( [ '_token' ] );

		$data['title']            = json_encode( $data['title'] );
		$data['content']          = json_encode( $data['content'] );
		$data['content2']          = json_encode( $data['content2'] );
		$data['meta_title']       = json_encode( $data['meta_title'] );
		$data['meta_description'] = json_encode( $data['meta_description'] );

//		$data['key']    = $request->input( 'key' );
		$data['key']    = $request->input( 'slug' );
		$data['slug']   = $request->input( 'slug' );
		$data['static'] = (string) Page::STATIC_OPTIONS['not_static'];
		$data['status'] = $request->input( 'status' );

		try {
			$page = Page::create( $data );

			return response()->json( [
				'success'  => true,
				'data'     => $page,
				'message'  => 'Page successfully added.',
				'redirect' => route( 'admin.pages.index' ),
			] );
		} catch ( \Exception $exception ) {
			return response()->json( [
				'success' => false,
				'message' => $exception->getMessage()
			] );
		}
	}

	public function update( Request $request, Page $page )
	{
		$request->validate( [
//          'key' => 'required|min:1|unique:pages',
//			'key' => 'required',
			'slug'             => 'required',
			'title'            => 'required|min:1',
			'content'          => 'required|min:1',
			'meta_title'       => 'required|min:1',
			'meta_description' => 'required|min:1'
		] );

		$data = $request->except( [ '_token' ] );

		$data['title']            = json_encode( $data['title'] );
		$data['content']          = json_encode( $data['content'] );
		$data['content2']          = json_encode( $data['content2'] );
		$data['meta_title']       = json_encode( $data['meta_title'] );
		$data['meta_description'] = json_encode( $data['meta_description'] );
		$data['key'] = $data['slug'];
		$data['static'] = (string) Page::STATIC_OPTIONS['not_static'];

		try {
			$page->update( $data );

			return response()->json( [
				'success'  => true,
				'data'     => $page,
				'message'  => 'Page successfully updated.',
				'redirect' => route( 'admin.pages.index' ),
			] );
		} catch ( \Exception $exception ) {
			return response()->json( [
				'success' => false,
				'message' => $exception->getMessage()
			] );
		}
	}

	public function destroy( Page $page ) {
		$page->delete();

		return redirect()->route( 'admin.pages.index' )->with( 'success', 'Page was deleted' );
	}
}
