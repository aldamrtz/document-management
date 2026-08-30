<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Standard Operating Procedure',
            'description' => 'Dokumen yang berisi prosedur dan instruksi kerja.',
        ]);

        Category::create([
            'name' => 'Policy',
            'description' => 'Dokumen yang berisi kebijakan organisasi.',
        ]);

        Category::create([
            'name' => 'Guideline',
            'description' => 'Dokumen yang berisi panduan pelaksanaan kegiatan.',
        ]);
    }
}
