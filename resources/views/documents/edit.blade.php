<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('documents.edit') }}</title>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            background: #f3f6fa;
            color: #1f2937;
            min-height: 100vh;
        }

        .page-wrapper {
            min-height: 100vh;
            padding: 26px 20px;
        }

        .container {
            width: min(920px, 100%);
            margin: 0 auto;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: #7a8797;
        }

        .breadcrumb a {
            color: #356fa8;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb a:hover {
            color: #174a7a;
        }

        .breadcrumb svg {
            width: 14px;
            height: 14px;
        }

        .language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px;
            border: 1px solid #dfe7ef;
            border-radius: 7px;
            background: #ffffff;
            flex-shrink: 0;
        }

        .language-switcher a {
            padding: 4px 7px;
            border-radius: 5px;
            color: #8a96a4;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.18s ease;
        }

        .language-switcher a:hover {
            color: #246a9a;
            background: #f4f8fb;
        }

        .language-switcher a.active {
            background: #e7f1fa;
            color: #246a9a;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 22px;
        }

        .heading-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: #e5f0fb;
            color: #24649a;
        }

        .heading-icon svg {
            width: 24px;
            height: 24px;
            stroke-width: 1.8;
        }

        .page-title {
            color: #173b5f;
            font-size: 26px;
            font-weight: 700;
            line-height: 1.25;
        }

        .page-subtitle {
            margin-top: 5px;
            color: #788697;
            font-size: 13px;
            line-height: 1.5;
        }

        .form-card {
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
        }

        .form-section {
            padding: 22px 28px;
            border-bottom: 1px solid #e7edf3;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 18px;
        }

        .section-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #eef5fb;
            color: #2b6d9f;
        }

        .section-icon svg {
            width: 18px;
            height: 18px;
            stroke-width: 1.9;
        }

        .section-title {
            color: #244967;
            font-size: 15px;
            font-weight: 700;
        }

        .section-description {
            margin-top: 2px;
            color: #8a96a4;
            font-size: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
            color: #3d4d5e;
            font-size: 13px;
            font-weight: 600;
        }

        .required {
            color: #d45d5d;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d5dfe9;
            border-radius: 7px;
            background: #ffffff;
            color: #263746;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        input,
        select {
            height: 42px;
            padding: 0 12px;
        }

        textarea {
            min-height: 112px;
            padding: 11px 12px;
            resize: vertical;
            line-height: 1.5;
        }

        input::placeholder,
        textarea::placeholder {
            color: #a5afba;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4d8cbb;
            box-shadow: 0 0 0 3px rgba(77, 140, 187, 0.10);
        }

        .field-hint {
            margin-top: 7px;
            color: #8d99a6;
            font-size: 11px;
            line-height: 1.4;
        }

        .current-file {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            padding: 11px 13px;
            border: 1px solid #dfe7ef;
            border-radius: 8px;
            background: #f8fbfd;
            color: #68798a;
            font-size: 12px;
        }

        .current-file-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 7px;
            background: #e7f1fa;
            color: #3778a6;
        }

        .current-file-icon svg {
            width: 17px;
            height: 17px;
        }

        .current-file-content {
            min-width: 0;
        }

        .current-file-label {
            color: #40586d;
            font-size: 12px;
            font-weight: 600;
        }

        .current-file-status {
            margin-top: 2px;
            color: #8d99a6;
            font-size: 11px;
        }

        .upload-area {
            position: relative;
            border: 1px dashed #b9ccdd;
            border-radius: 9px;
            background: #f8fbfd;
            padding: 22px 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .upload-area:hover {
            border-color: #6597bb;
            background: #f4f9fc;
        }

        .upload-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            border-radius: 10px;
            background: #e7f1fa;
            color: #3778a6;
        }

        .upload-icon svg {
            width: 21px;
            height: 21px;
        }

        .upload-title {
            color: #40586d;
            font-size: 13px;
            font-weight: 600;
        }

        .upload-description {
            margin-top: 4px;
            color: #929eaa;
            font-size: 11px;
        }

        .file-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-name {
            margin-top: 9px;
            color: #8d99a6;
            font-size: 11px;
        }

        .file-name.selected {
            color: #3778a6;
            font-weight: 600;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 16px 28px;
            background: #fbfcfd;
        }

        .footer-note {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #8a96a3;
            font-size: 11px;
        }

        .footer-note svg {
            width: 14px;
            height: 14px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.18s ease;
        }

        .btn svg {
            width: 16px;
            height: 16px;
            stroke-width: 2;
        }

        .btn-secondary {
            border-color: #d5dfe8;
            background: #ffffff;
            color: #596b7c;
        }

        .btn-secondary:hover {
            background: #f4f7f9;
            border-color: #c4d0db;
        }

        .btn-primary {
            background: #246a9a;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #1d587f;
        }

        @media (max-width: 680px) {
            .page-wrapper {
                padding: 22px 14px;
            }

            .top-bar {
                align-items: flex-start;
            }

            .page-heading {
                align-items: flex-start;
            }

            .page-title {
                font-size: 22px;
            }

            .form-section {
                padding: 22px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-footer {
                flex-direction: column;
                align-items: stretch;
                padding: 18px;
            }

            .footer-note {
                justify-content: center;
            }

            .form-actions {
                width: 100%;
            }

            .form-actions .btn {
                flex: 1;
            }
        }

        @media (max-width: 480px) {
            .top-bar {
                flex-direction: column;
                gap: 10px;
            }

            .language-switcher {
                align-self: flex-end;
            }
        }
    </style>
</head>

<body>

    <main class="page-wrapper">
        <div class="container">

            <div class="top-bar">

                <nav class="breadcrumb">
                    <a href="{{ route('documents.index') }}">
                        {{ __('documents.title') }}
                    </a>

                    <i data-lucide="chevron-right"></i>

                    <span>
                        {{ __('documents.edit') }}
                    </span>
                </nav>

                <div class="language-switcher">
                    <a
                        href="{{ route('language.switch', 'id') }}"
                        class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">
                        ID
                    </a>

                    <a
                        href="{{ route('language.switch', 'en') }}"
                        class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
                        EN
                    </a>
                </div>

            </div>

            <header class="page-heading">
                <div class="heading-icon">
                    <i data-lucide="file-pen-line"></i>
                </div>

                <div>
                    <h1 class="page-title">
                        {{ __('documents.edit') }}
                    </h1>

                    <p class="page-subtitle">
                        {{ __('documents.edit_subtitle') }}
                    </p>
                </div>
            </header>

            <form
                action="{{ route('documents.update', $document->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="form-card">

                @csrf
                @method('PUT')

                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">
                            <i data-lucide="file-text"></i>
                        </div>

                        <div>
                            <h2 class="section-title">
                                {{ __('documents.document_information') }}
                            </h2>

                            <p class="section-description">
                                {{ __('documents.edit_document_information_description') }}
                            </p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group full">

                            <label for="title">
                                {{ __('documents.field_title') }}
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $document->title) }}"
                                placeholder="{{ __('documents.title_placeholder') }}"
                                required>

                        </div>

                        <div class="form-group">

                            <label for="category_id">
                                {{ __('documents.category') }}
                                <span class="required">*</span>
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                required>

                                <option value="">
                                    -- {{ __('documents.select_category') }} --
                                </option>

                                @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="document_number">
                                {{ __('documents.document_number') }}
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="document_number"
                                name="document_number"
                                value="{{ old('document_number', $document->document_number) }}"
                                placeholder="{{ __('documents.document_number_placeholder') }}"
                                required>

                        </div>

                        <div class="form-group">

                            <label for="version">
                                {{ __('documents.version') }}
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="version"
                                name="version"
                                value="{{ old('version', $document->version) }}"
                                placeholder="{{ __('documents.version_placeholder') }}"
                                required>

                        </div>

                        <div class="form-group">

                            <label for="status">
                                {{ __('documents.status') }}
                                <span class="required">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required>

                                <option
                                    value="draft"
                                    {{ old('status', $document->status) === 'draft' ? 'selected' : '' }}>
                                    {{ __('documents.draft') }}
                                </option>

                                <option
                                    value="published"
                                    {{ old('status', $document->status) === 'published' ? 'selected' : '' }}>
                                    {{ __('documents.published') }}
                                </option>

                                <option
                                    value="archived"
                                    {{ old('status', $document->status) === 'archived' ? 'selected' : '' }}>
                                    {{ __('documents.archived') }}
                                </option>

                            </select>

                        </div>

                        <div class="form-group full">

                            <label for="description">
                                {{ __('documents.description') }}
                                <span class="required">*</span>
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                placeholder="{{ __('documents.description_placeholder') }}"
                                required>{{ old('description', $document->description) }}</textarea>

                            <span class="field-hint">
                                {{ __('documents.description_hint') }}
                            </span>

                        </div>

                    </div>

                </section>

                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">
                            <i data-lucide="paperclip"></i>
                        </div>

                        <div>
                            <h2 class="section-title">
                                {{ __('documents.document_file') }}
                            </h2>

                            <p class="section-description">
                                {{ __('documents.document_file_management_description') }}
                            </p>
                        </div>

                    </div>

                    @if ($document->file_path)

                    <div class="current-file">

                        <div class="current-file-icon">
                            <i data-lucide="file-text"></i>
                        </div>

                        <div class="current-file-content">

                            <div class="current-file-label">
                                {{ __('documents.current_file') }}
                            </div>

                            <div class="current-file-status">
                                {{ __('documents.current_file_status') }}
                            </div>

                        </div>

                    </div>

                    @endif

                    <div class="upload-area">

                        <div class="upload-icon">
                            <i data-lucide="upload"></i>
                        </div>

                        <p class="upload-title">
                            {{ __('documents.replace_file') }}
                        </p>

                        <p class="upload-description">
                            {{ __('documents.replace_file_description') }}
                        </p>

                        <input
                            type="file"
                            id="file"
                            name="file"
                            accept=".pdf"
                            class="file-input">

                        <p class="file-name" id="file-name">
                            {{ __('documents.no_new_file_selected') }}
                        </p>

                    </div>

                    <p class="field-hint">
                        {{ __('documents.replace_file_hint') }}
                    </p>

                </section>

                <footer class="form-footer">

                    <div class="footer-note">
                        <i data-lucide="info"></i>

                        <span>
                            {{ __('documents.form_note') }}
                        </span>
                    </div>

                    <div class="form-actions">

                        <a
                            href="{{ route('documents.index') }}"
                            class="btn btn-secondary">

                            <i data-lucide="arrow-left"></i>

                            {{ __('documents.back') }}

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i data-lucide="save"></i>

                            {{ __('documents.update') }}

                        </button>

                    </div>

                </footer>

            </form>

        </div>
    </main>

    <script>
        lucide.createIcons();

        const fileInput = document.getElementById('file');
        const fileName = document.getElementById('file-name');
        const defaultFileName = document.getElementById('file-name').textContent;

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileName.classList.add('selected');
            } else {
                fileName.textContent = defaultFileName;
                fileName.classList.remove('selected');
            }
        });
    </script>

</body>

</html>