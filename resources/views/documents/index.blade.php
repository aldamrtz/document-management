<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
</head>

<body>

    <h1>Document List</h1>

    <a href="{{ route('documents.create') }}">
        Add Document
    </a>

    <a href="{{ route('documents.export') }}">
        Export CSV
    </a>

    <br><br>

    @foreach ($documents as $document)

    <div>

        <h2>{{ $document->title }}</h2>

        <p>
            Category: {{ $document->category->name }}
        </p>

        <p>
            Document Number: {{ $document->document_number }}
        </p>

        <p>
            Version: {{ $document->version }}
        </p>

        <p>
            Status: {{ $document->status }}
        </p>

        <a href="{{ route('documents.edit', $document->id) }}">
            Edit
        </a>

        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Are you sure you want to delete this document?')">
                Delete
            </button>
        </form>

        <hr>

    </div>

    @endforeach

</body>

</html>