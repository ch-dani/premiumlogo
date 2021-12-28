<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BillingDetail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_user_id',
        'social_provider',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * @var array[]
     */
    public static $table_columns_order = [
        [0, "desc"]
    ];

    /**
     * @return mixed
     */
    public function billingDetails()
    {
        return $this->hasOne(BillingDetail::class);
    }
}
