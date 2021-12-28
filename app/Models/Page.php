<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public const STATIC_OPTIONS = [
        'static'     => '1',
        'not_static' => '0',
    ];

    public const STATUS_OPTIONS = [
        'published' => 'published',
        'hidden'    => 'hidden',
    ];

    public const IMG_UPLOAD_PATH = 'uploads/pages';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'slug',
        'title',
        'content',
        'content2',
        'meta_title',
        'meta_description',
        'data',
        'status',
        'static',
        'editable',
        'published_at',
    ];

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $casts = ['data' => 'array'];
    
    public static $table_columns = [
        [
            'data'      => 'id',
            'bSortable' => true,
            'title'     => "ID"
        ],
        [
            'data'      => 'title',
            'bSortable' => true,
            "title"     => "Title"
        ],
        [
            'data'       => 'created_at',
            'searchable' => false,
            'bSortable'  => true,
            "title"      => "Create at"

        ],
        [
            'data'       => 'action',
            'searchable' => false,
            'bSortable'  => false,
            "title"      => "Actions"
        ]
    ];
}
