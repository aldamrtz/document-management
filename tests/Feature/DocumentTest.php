<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    private function createCategory(): Category
    {
        return Category::create([
            'name' => 'Test Category',
        ]);
    }

    private function createDocument(Category $category): Document
    {
        return Document::create([
            'category_id' => $category->id,
            'title' => 'Dokumen Testing',
            'document_number' => 'DOC-TEST-001',
            'version' => '1.0',
            'description' => 'Dokumen untuk pengujian.',
            'status' => 'draft',
        ]);
    }

    public function test_user_can_view_documents(): void
    {
        $category = $this->createCategory();
        $document = $this->createDocument($category);

        $response = $this->get('/documents');

        $response->assertStatus(200);
        $response->assertSee($document->title);
        $response->assertSee($document->document_number);
    }

    public function test_user_can_create_document(): void
    {
        $category = $this->createCategory();

        $response = $this->post('/documents', [
            'category_id' => $category->id,
            'title' => 'Dokumen Baru',
            'document_number' => 'DOC-NEW-001',
            'version' => '1.0',
            'description' => 'Dokumen baru untuk testing.',
            'status' => 'draft',
        ]);

        $response->assertRedirect('/documents');

        $this->assertDatabaseHas('documents', [
            'title' => 'Dokumen Baru',
            'document_number' => 'DOC-NEW-001',
            'status' => 'draft',
        ]);
    }

    public function test_user_can_update_document(): void
    {
        $category = $this->createCategory();
        $document = $this->createDocument($category);

        $response = $this->put("/documents/{$document->id}", [
            'category_id' => $category->id,
            'title' => 'Dokumen Diperbarui',
            'document_number' => 'DOC-UPDATED-001',
            'version' => '2.0',
            'description' => 'Dokumen telah diperbarui.',
            'status' => 'published',
        ]);

        $response->assertRedirect('/documents');

        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'title' => 'Dokumen Diperbarui',
            'document_number' => 'DOC-UPDATED-001',
            'version' => '2.0',
            'status' => 'published',
        ]);
    }

    public function test_user_can_delete_document(): void
    {
        $category = $this->createCategory();
        $document = $this->createDocument($category);

        $response = $this->delete("/documents/{$document->id}");

        $response->assertRedirect('/documents');

        $this->assertDatabaseMissing('documents', [
            'id' => $document->id,
        ]);
    }

    public function test_document_validation_works(): void
    {
        $response = $this->post('/documents', [
            'category_id' => null,
            'title' => null,
            'version' => null,
            'status' => null,
        ]);

        $response->assertSessionHasErrors([
            'category_id',
            'title',
            'version',
            'status',
        ]);
    }
}