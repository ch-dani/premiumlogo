<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Translate;

class Team extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'first_name', 'last_name', 'position', 'image' ];

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

	public function getFullNameAttribute()
	{
		return Translate::t($this->first_name) . ($this->last_name ? ' ' . Translate::t($this->last_name) : '');
	}
}
