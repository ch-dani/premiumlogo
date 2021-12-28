<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'name', 'image' ];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [ 'name_translate' ];

	public static $table_columns = [
		[
			'data'=> 'id',
			'bSortable'=> true,
			'title'=>"ID"
		],
		[
			'data'=> 'name',
			'bSortable'=> true,
			"title"=>"Name"
		],
		[
			'data'=>'created_at',
			'searchable'=> false,
			'bSortable'=> true,
			"title"=>"Create at"

		],
		[
			'data'=> 'action',
			'searchable'=> false,
			'bSortable'=> false,
			"title"=>"Actions"
		]
	];

	/**
	 * Get translated name.
	 *
	 * @return string
	 */
	public function getNameTranslateAttribute()
	{
		return \App\Helpers\Translate::t($this->name);
	}
}
