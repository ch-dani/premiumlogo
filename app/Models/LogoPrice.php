<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoPrice extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'price',
        'currency',
        'symbol',
        'advantages',
    ];

    /**
     * @var array[]
     */
    public static $table_columns = [
        [
            'data'=> 'id',
            'bSortable'=> true,
            'title'=>"ID"
        ],
        [
            'data'=> 'title',
            'bSortable'=> true,
            "title"=>"Title"
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
