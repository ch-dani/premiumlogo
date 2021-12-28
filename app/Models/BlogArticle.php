<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'title_image', 'category_id', 'content', 'is_published', 'slug'];

    /**
     * @var array[]
     */
    public static $table_columns = [
        [
            'data'      => 'id',
            'bSortable' => true,
            'title'     => "ID"
        ],
        [
            'data'      => 'name',
            'bSortable' => true,
            "title"     => "Name"
        ],
       /* [
            'data'      => 'content',
            'bSortable' => true,
            "title"     => "Content"
        ],*/
        [
            'data'      => 'is_published',
            'bSortable' => true,
            "title"     => "Is published"
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogArticleCategory::class, 'category_id');
    }
}
