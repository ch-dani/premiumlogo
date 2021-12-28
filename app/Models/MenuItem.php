<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_items';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'menu_id', 'title', 'sort', 'link', 'parent'
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [ 'title_translate' ];

	/**
	 * Get menu.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
	 */
	public function children()
	{
		return $this->hasMany(MenuItem::class, 'parent_id', 'id')->whereNotNull('parent_id')->orderBy('sort')->get();
	}

	/**
	 * Get the last sorting item.
	 *
	 * @param $menuId
	 * @return int
	 */
	public static function getLastSort($menuId)
	{
		$lastSort = self::where('menu_id', $menuId)->orderBy('sort', 'desc')->first();
		return is_null($lastSort) ? 0 : $lastSort->sort + 1;
	}

	/**
	 * Get translated name.
	 *
	 * @return string
	 */
	public function getTitleTranslateAttribute()
	{
		return \App\Helpers\Translate::t($this->title);
	}
}
