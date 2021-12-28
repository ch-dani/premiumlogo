<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'name', 'content', 'image', 'rating', 'in_slider' ];

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

	public static $table_columns_order = [
		[0, "desc"]
	];
}
