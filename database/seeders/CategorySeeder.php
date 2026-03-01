<?php
// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['key'=>'personaje', 'label'=>'Personaje principal', 'emoji'=>'EE80A0',
             'prompt_key'=>'{personaje}', 'default_text'=>'un personaje misterioso',      'order'=>1],
            ['key'=>'estilo',    'label'=>'Estilo visual',       'emoji'=>'EE80A1',
             'prompt_key'=>'{estilo}',    'default_text'=>'estilo realista',               'order'=>2],
            ['key'=>'escenario', 'label'=>'Escenario',           'emoji'=>'EE8393',
             'prompt_key'=>'{escenario}', 'default_text'=>'en un lugar especial',          'order'=>3],
            ['key'=>'emocion',   'label'=>'Emocion / Actitud',   'emoji'=>'EE9294',
             'prompt_key'=>'{emocion}',   'default_text'=>'con una expresion especial',    'order'=>4],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['key' => $cat['key']], $cat);
        }
    }
}