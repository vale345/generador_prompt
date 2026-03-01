<?php
// app/Models/Category.php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'key', 'label', 'emoji', 'prompt_key', 'default_text', 'order', 'active'
    ];

    // Relacion: una categoria tiene muchas opciones
    public function options()
    {
        return $this->hasMany(CategoryOption::class)
                    ->where('active', true)
                    ->orderBy('order');
    }

    // Scope para traer solo categorias activas, ordenadas
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}

