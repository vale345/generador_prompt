<?php
// app/Services/PromptBuilderService.php

namespace App\Services;

use App\Models\Category;

class PromptBuilderService
{
    /**
     * @param array $selections  ['personaje' => 3, 'estilo' => 7, ...]
     *                           clave = category->key, valor = category_option->id
     * @return string  El prompt listo para usar
     */
    public function build(array $selections): string
    {
        $categories = Category::active()->with('options')->get();

        $slots = [];
        foreach ($categories as $category) {
            $selectedId = $selections[$category->key] ?? null;

            if ($selectedId) {
                $option = $category->options->firstWhere('id', $selectedId);
                $slots[$category->prompt_key] = $option?->prompt_text ?? $category->default_text;
            } else {
                $slots[$category->prompt_key] = $category->default_text;
            }
        }

        return $this->fillTemplate($slots);
    }

    private function fillTemplate(array $slots): string
    {
        $template = config('prompt.template');

        foreach ($slots as $key => $value) {
            $template = str_replace($key, $value, $template);
        }

        return $template;
    }
}
