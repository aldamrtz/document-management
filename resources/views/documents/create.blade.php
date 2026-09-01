<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document</title>
</head>

<body>

    <h1>Create Document</h1>

    <form action="{{ route('documents.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>

        <br>

        <div>
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Select Category --</option>

                @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="document_number">Document Number</label>
            <input type="text" id="document_number" name="document_number">
        </div>

        <br>

        <div>
            <label for="version">Version</label>
            <input
                type="text"
                id="version"
                name="version"
                value="{{ old('version', '1.0') }}"
                required>
        </div>

        <br>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <br>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <br>

        <button type="submit">Save Document</button>
    </form>

    <br>

    <a href="{{ route('documents.index') }}">Back to Documents</a>

</body>

</html>