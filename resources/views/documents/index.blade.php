<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('documents.title') }}</title>
</head>

<body>

    <h1>{{ __('documents.title') }}</h1>

    <a href="{{ route('documents.create') }}">
        {{ __('documents.add') }}
    </a>

    <a href="{{ route('documents.export') }}">
        {{ __('documents.export') }}
    </a>

    <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" accept=".csv" required>

        <button type="submit">{{ __('documents.import') }}</button>
    </form>

    <br><br>

    @foreach ($documents as $document)

    <div>

        <h2>{{ $document->title }}</h2>

        <p>
            {{ __('documents.category') }}: {{ $document->category->name }}
        </p>

        <p>
            {{ __('documents.document_number') }}: {{ $document->document_number }}
        </p>

        <p>
            {{ __('documents.version') }}: {{ $document->version }}
        </p>

        <p>
            {{ __('documents.status') }}: {{ __('documents.' . $document->status) }}
        </p>

        @if ($document->file_path)
        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">
            {{ __('documents.view') }}
        </a>
        @endif

        <br>

        <a href="{{ route('documents.edit', $document->id) }}">
            {{ __('documents.edit') }}
        </a>

        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button
                type="submit"
                data-confirm="{{ __('documents.delete_confirmation') }}"
                onclick="return confirm(this.dataset.confirm);">
                {{ __('documents.delete') }}
            </button>
        </form>

        <hr>

    </div>

    @endforeach

</body>

</html>