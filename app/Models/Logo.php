<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'image', 'in_slider', 'in_home'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name_translate'];

    /**
     * The categories that belong to the logo.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\LogoCategory');
    }

    /**
     * Get translated name.
     *
     * @return string
     */
    public function getNameTranslateAttribute()
    {
        return \App\Helpers\Translate::t($this->name);
    }
}
