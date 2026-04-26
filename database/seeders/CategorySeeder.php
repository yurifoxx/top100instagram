<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'atleta',    'label' => 'Atleta',       'icon' => '⚽'],
            ['name' => 'musico',    'label' => 'Músico',       'icon' => '🎵'],
            ['name' => 'ator',      'label' => 'Ator/Atriz',   'icon' => '🎬'],
            ['name' => 'influencer','label' => 'Influencer',   'icon' => '📱'],
            ['name' => 'humorista', 'label' => 'Humorista',    'icon' => '😂'],
            ['name' => 'modelo',    'label' => 'Modelo',       'icon' => '💃'],
            ['name' => 'politico',  'label' => 'Político',     'icon' => '🏛️'],
            ['name' => 'outros',    'label' => 'Outros',       'icon' => '⭐'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
