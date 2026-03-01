<?php
// app/Models/CategoryOption.php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategoryOption extends Model
{
    protected $fillable = [
        'category_id', 'option_key', 'icon', 'label', 'prompt_text', 'order', 'active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
