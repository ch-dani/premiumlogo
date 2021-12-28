<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model{
    use HasFactory;
    
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
				'data'=> 'price',
				'bSortable'=> true,
				"title"=>"Price"

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
}
