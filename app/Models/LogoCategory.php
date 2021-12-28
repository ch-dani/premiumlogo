<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoCategory extends Model
{
    use HasFactory;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
//	protected $table = 'logo_categories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'name', 'url' ];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [ 'name_translate' ];

	/**
	 * The logos that belong to the category.
	 */
	public function logos()
	{
		return $this->belongsToMany('App\Models\Logo');
	}

	/**
	 * Get translated name.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getNameTranslateAttribute()
	{
		return \App\Helpers\Translate::t($this->name);
	}
}
