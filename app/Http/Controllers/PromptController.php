<?php
// app/Http/Controllers/PromptController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\PromptBuilderService;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function __construct(
        private PromptBuilderService $builder
    ) {}

    // GET /   -- Pantalla principal con los iconos
    public function index()
    {
        $categories = Category::active()->with('options')->get();
        return view('prompt.index', compact('categories'));
    }

    // POST /generate  -- Construye el prompt (llamado via fetch desde Alpine)
    public function generate(Request $request)
    {
        $request->validate([
            'selections'   => 'array',
            'selections.*' => 'nullable|exists:category_options,id',
        ]);

        $prompt = $this->builder->build(
            $request->input('selections', [])
        );

        return response()->json(['prompt' => $prompt]);
    }
}
