<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with('category')->latest()->get();

        return view('documents.index', compact('documents'));
    }

    public function export()
    {
        $documents = Document::with('category')->get();

        $filename = 'documents-' . date('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = [
            'ID',
            'Category',
            'Title',
            'Document Number',
            'Version',
            'Status',
            'Description',
        ];

        $callback = function () use ($documents, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($documents as $document) {
                fputcsv($file, [
                    $document->id,
                    $document->category->name,
                    $document->title,
                    $document->document_number,
                    $document->version,
                    $document->status,
                    $document->description,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            Document::create([
                'category_id' => Category::where('name', $row[1])->value('id'),
                'title' => $row[2],
                'document_number' => $row[3],
                'version' => $row[4],
                'status' => $row[5],
                'description' => $row[6],
            ]);
        }

        fclose($handle);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document berhasil diimport.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('documents.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'document_number' => 'nullable|string|max:255',
            'version' => 'required|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        Document::create($validated);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = Document::findOrFail($id);
        $categories = Category::all();

        return view('documents.edit', compact('document', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'document_number' => 'nullable|string|max:255',
            'version' => 'required|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $document->update($validated);

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);

        $document->delete();

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}
