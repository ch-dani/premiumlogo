<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

	public static $table_columns = [
		[
			'data'=> 'name',
			'bSortable'=> true,
			"title"=>"Name"
		],
		[
			'data'=> 'action',
			'searchable'=> false,
			'bSortable'=> false,
			"title"=>"Action"
		]
	];

	/**
	 * Get parent items.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function items()
	{
		return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('sort')->get();
	}

	/**
	 * Get all items.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function itemsAll()
	{
		return $this->hasMany(MenuItem::class)->orderBy('sort')->get();
	}

	/**
	 * Find menu by code.
	 *
	 * @param $code
	 * @return mixed
	 */
	public static function findByCode($code)
	{
		return self::where('code', $code)->firstOrFail();
	}
}
