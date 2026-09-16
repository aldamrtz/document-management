<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Document;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_document_belongs_to_category(): void
    {
        $category = new Category([
            'name' => 'Test Category',
        ]);

        $document = new Document([
            'title' => 'Dokumen Testing',
        ]);

        $document->category()->associate($category);

        $this->assertSame($category, $document->category);
    }

    public function test_document_has_expected_attributes(): void
    {
        $document = new Document([
            'title' => 'Dokumen Testing',
            'document_number' => 'DOC-TEST-001',
            'version' => '1.0',
            'status' => 'draft',
        ]);

        $this->assertSame('Dokumen Testing', $document->title);
        $this->assertSame('DOC-TEST-001', $document->document_number);
        $this->assertSame('1.0', $document->version);
        $this->assertSame('draft', $document->status);
    }
}