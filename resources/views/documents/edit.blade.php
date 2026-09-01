<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
</head>

<body>

    <h1>Edit Document</h1>

    <form action="{{ route('documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ $document->title }}"
                required>
        </div>

        <br>

        <div>
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ $document->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="document_number">Document Number</label>
            <input
                type="text"
                id="document_number"
                name="document_number"
                value="{{ $document->document_number }}">
        </div>

        <br>

        <div>
            <label for="version">Version</label>
            <input
                type="text"
                id="version"
                name="version"
                value="{{ old('version', $document->version) }}"
                required>
        </div>

        <br>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description">{{ $document->description }}</textarea>
        </div>

        <br>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="draft" {{ $document->status === 'draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="published" {{ $document->status === 'published' ? 'selected' : '' }}>
                    Published
                </option>

                <option value="archived" {{ $document->status === 'archived' ? 'selected' : '' }}>
                    Archived
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Update Document</button>
    </form>

    <br>

    <a href="{{ route('documents.index') }}">Back to Documents</a>

</body>

</html>