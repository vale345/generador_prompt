<?php
// database/seeders/CategoryOptionSeeder.php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryOption;
use Illuminate\Database\Seeder;

class CategoryOptionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
          'personaje' => [
            ['option_key'=>'gato',   'icon'=>'EE8183', 'label'=>'Gato',   'prompt_text'=>'un gato tierno',    'order'=>1],
            ['option_key'=>'perro',  'icon'=>'EE8186', 'label'=>'Perro',  'prompt_text'=>'un perro jugueton', 'order'=>2],
            ['option_key'=>'nena',   'icon'=>'EE8187', 'label'=>'Nena',   'prompt_text'=>'una nina pequena',  'order'=>3],
            ['option_key'=>'robot',  'icon'=>'EE839E', 'label'=>'Robot',  'prompt_text'=>'un robot amigable', 'order'=>4],
            ['option_key'=>'dragon', 'icon'=>'EE8392', 'label'=>'Dragon', 'prompt_text'=>'un dragon pequeno', 'order'=>5],
          ],
          'estilo' => [
            ['option_key'=>'infantil', 'icon'=>'EE9297', 'label'=>'Infantil',  'prompt_text'=>'estilo infantil y colorido', 'order'=>1],
            ['option_key'=>'acuarela', 'icon'=>'EE8188', 'label'=>'Acuarela',  'prompt_text'=>'estilo acuarela suave',      'order'=>2],
            ['option_key'=>'pixel',    'icon'=>'EE839E', 'label'=>'Pixel Art', 'prompt_text'=>'estilo pixel art retro',     'order'=>3],
            ['option_key'=>'manga',    'icon'=>'EE9281', 'label'=>'Manga',     'prompt_text'=>'estilo manga japones',       'order'=>4],
          ],
          'escenario' => [
            ['option_key'=>'playa',    'icon'=>'EE81A0', 'label'=>'Playa',    'prompt_text'=>'en una playa tropical',   'order'=>1],
            ['option_key'=>'bosque',   'icon'=>'EE8CB2', 'label'=>'Bosque',   'prompt_text'=>'en un bosque encantado',  'order'=>2],
            ['option_key'=>'espacio',  'icon'=>'EE9A80', 'label'=>'Espacio',  'prompt_text'=>'en el espacio exterior',  'order'=>3],
            ['option_key'=>'castillo', 'icon'=>'EE81B0', 'label'=>'Castillo', 'prompt_text'=>'en un castillo medieval', 'order'=>4],
          ],
          'emocion' => [
            ['option_key'=>'feliz',       'icon'=>'EE9884', 'label'=>'Feliz',       'prompt_text'=>'con expresion feliz y radiante',  'order'=>1],
            ['option_key'=>'sorprendido', 'icon'=>'EE9882', 'label'=>'Sorprendido', 'prompt_text'=>'con cara de sorpresa total',      'order'=>2],
            ['option_key'=>'enamorado',   'icon'=>'EE99B0', 'label'=>'Enamorado',   'prompt_text'=>'con expresion enamorada y dulce', 'order'=>3],
            ['option_key'=>'dormido',     'icon'=>'EE9894', 'label'=>'Dormido',     'prompt_text'=>'durmiendo placidamente',          'order'=>4],
          ],
        ];

        foreach ($data as $catKey => $options) {
            $category = Category::where('key', $catKey)->first();
            if (!$category) continue;
            foreach ($options as $opt) {
                CategoryOption::updateOrCreate(
                    ['category_id' => $category->id, 'option_key' => $opt['option_key']],
                    $opt
                );
            }
        }
    }
}
