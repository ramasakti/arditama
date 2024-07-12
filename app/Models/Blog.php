<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    use HasFactory;

    protected $hidden = [], $table = 'blogs';

    public function uploader(): HasOne
    {
        return $this->hasOne(User::class, 'created_by');
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
