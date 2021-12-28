<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @param $name
     * @return |null
     */
    public static function getIdByName($name)
    {
        return self::where('name', $name)->first()->id ?? null;
    }

    /**
     * @param $id
     * @return |null
     */
    public static function getNameById($id)
    {
        return self::find($id)->first()->name ?? null;
    }
}
