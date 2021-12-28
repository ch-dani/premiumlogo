<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuRequest;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{

	/**
	 * Show all menu.
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */
	public function index(Request $request)
	{
		$Menus = Menu::all();

		if($request->ajax()){
			$data = $this->processForDataTable($request, 'Menu', 'menu', ['name' => 'name']);

			return $data;
		}

		return view('admin.menu.index', ["Menus" => $Menus, "table_columns" => Menu::$table_columns]);
	}

	/**
	 * Show edit menu.
	 *
	 * @param Menu $menu
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */
	public function edit(Menu $Menu)
	{
		$Languages = Language::all();

		return view('admin.menu.edit', compact('Menu', 'Languages'));
	}

	/**
	 * Creating or updating item menu.
	 *
	 * @param MenuRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Throwable
	 */
	public function store(MenuRequest $request)
	{
		$menu = Menu::findByCode($request->code);
		$data = $request->except('_token');

		$data['title'] = json_encode($data['title']);

		if (!isset($data['item_id'])) {
			$data['sort'] = MenuItem::getLastSort($menu->id);
			$data['menu_id'] = $menu->id;

			$menuItem = MenuItem::create($data);
		} else {
			$menuItem = MenuItem::find($data['item_id']);
			unset($data['item_id']);

			$menuItem->update($data);
			$menuItem->save();
		}

		return response()->json([
			'status' => 'success',
			'html' => view('admin.menu.sortable', ['menu' => $menu])->render(),
			'id' => $menuItem->id,
			'sort' => $menuItem->sort,
			'title' => $menuItem->title,
		]);
	}

	/**
	 * Get menu view.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Throwable
	 */
	public function get_sortable(Request $request)
	{
		return response()->json([
			'status' => 'success',
			'html' => view('admin.menu.sortable', ['menu' => Menu::findByCode($request->code)])->render()
		]);
	}

	/**
	 * Save sorting.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function save_sortable(Request $request)
	{
		foreach ($request->items as $id => $item) {
			$menuItem = MenuItem::find($id);

			if ($menuItem->menu->code != $request->code)
				continue;

			$menuItem->sort = $item['sort'];
			$menuItem->parent_id = isset($item['parent_id']) ? $item['parent_id'] : null;
			$menuItem->save();
		}

		return response()->json([
			'status' => 'success'
		]);
	}

	/**
	 * Deleting menu item.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function remove(Request $request)
	{
		$menuItem = MenuItem::findOrFail($request->id);

		foreach ($menuItem->children() as $child) {
			$child->delete();
		}

		$menuItem->delete();

		return response()->json([
			'status' => 'success'
		]);
	}
}
