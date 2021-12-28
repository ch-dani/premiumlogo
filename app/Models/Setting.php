<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'data'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'data' => 'array'
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [ 'translate' ];

	/**
	 * Get setting by name.
	 *
	 * @param $name
	 * @return mixed
	 */
	public static function findByName($name)
	{
		return self::where('name', $name)->first();
	}

	/**
	 * Get translated name.
	 *
	 * @return string
	 */
	public function getTranslateAttribute()
	{
		return \App\Helpers\Translate::t($this->data);
	}
}
