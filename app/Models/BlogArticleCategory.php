<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

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

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'category_id');
    }
}
