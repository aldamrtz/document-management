<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('documents.edit') }}</title>
</head>

<body>

    <h1>{{ __('documents.edit') }}</h1>

    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="title">{{ __('documents.field_title') }}</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ $document->title }}"
                required>
        </div>

        <br>

        <div>
            <label for="category_id">{{ __('documents.category') }}</label>

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
            <label for="document_number">
                {{ __('documents.document_number') }}
            </label>

            <input
                type="text"
                id="document_number"
                name="document_number"
                value="{{ $document->document_number }}">
        </div>

        <br>

        <div>
            <label for="version">{{ __('documents.version') }}</label>

            <input
                type="text"
                id="version"
                name="version"
                value="{{ old('version', $document->version) }}"
                required>
        </div>

        <br>

        <div>
            <label for="description">
                {{ __('documents.description') }}
            </label>

            <textarea
                id="description"
                name="description">{{ $document->description }}</textarea>
        </div>

        <br>

        <div>
            <label for="file">{{ __('documents.file') }}</label>

            <input
                type="file"
                id="file"
                name="file"
                accept=".pdf">
        </div>

        <br>

        <div>
            <label for="status">{{ __('documents.status') }}</label>

            <select id="status" name="status" required>
                <option
                    value="draft"
                    {{ $document->status === 'draft' ? 'selected' : '' }}>
                    {{ __('documents.draft') }}
                </option>

                <option
                    value="published"
                    {{ $document->status === 'published' ? 'selected' : '' }}>
                    {{ __('documents.published') }}
                </option>

                <option
                    value="archived"
                    {{ $document->status === 'archived' ? 'selected' : '' }}>
                    {{ __('documents.archived') }}
                </option>
            </select>
        </div>

        <br>

        <button type="submit">
            {{ __('documents.update') }}
        </button>
    </form>

    <br>

    <a href="{{ route('documents.index') }}">
        {{ __('documents.back') }}
    </a>

</body>

</html>