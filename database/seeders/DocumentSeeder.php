<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $sop = Category::where('name', 'Standard Operating Procedure')->first();
        $policy = Category::where('name', 'Policy')->first();
        $guideline = Category::where('name', 'Guideline')->first();

        Document::create([
            'category_id' => $sop->id,
            'title' => 'SOP Pengajuan Cuti',
            'document_number' => 'SOP-HR-001',
            'version' => '1.0',
            'description' => 'Prosedur pengajuan cuti karyawan.',
            'status' => 'published',
        ]);

        Document::create([
            'category_id' => $policy->id,
            'title' => 'Kebijakan Keamanan Informasi',
            'document_number' => 'POL-IT-001',
            'version' => '2.0',
            'description' => 'Kebijakan mengenai keamanan informasi perusahaan.',
            'status' => 'published',
        ]);

        Document::create([
            'category_id' => $guideline->id,
            'title' => 'Panduan Penggunaan Sistem',
            'document_number' => 'GUI-IT-001',
            'version' => '3.0',
            'description' => 'Panduan penggunaan sistem internal.',
            'status' => 'draft',
        ]);
    }
}
