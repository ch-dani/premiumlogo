<?php

namespace App\Models;

use App\Models\User;
use App\Models\LogoPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'amount',
        'currency',
        'type',
        'paymentId',
        'user_id',
        'logo_price_id'
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function logoPrice()
    {
        return $this->belongsTo(LogoPrice::class);
    }
}
