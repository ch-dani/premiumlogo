<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireDesignerMessage extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'message',
        'email',
        'name',
        'answered',
        'answer_message'
    ];

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
        [
            'data'      => 'email',
            'bSortable' => true,
            "title"     => "Email"
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
