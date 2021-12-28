<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'name', 'content', 'is_popular' ];

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
	 * The questions that belong to the category.
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Models\QuestionCategory');
	}
}
