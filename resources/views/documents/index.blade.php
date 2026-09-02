<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('documents.title') }}</title>

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
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 14px;
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px;
            border: 1px solid #dfe7ef;
            border-radius: 7px;
            background: #ffffff;
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

        .import-card {
            margin-bottom: 22px;
            padding: 18px 20px;
            background: #ffffff;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
        }

        .import-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 14px;
        }

        .import-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 8px;
            background: #eef5fb;
            color: #2b6d9f;
        }

        .import-icon svg {
            width: 18px;
            height: 18px;
            stroke-width: 1.9;
        }

        .import-title {
            color: #244967;
            font-size: 15px;
            font-weight: 700;
        }

        .import-description {
            margin-top: 2px;
            color: #8a96a4;
            font-size: 12px;
        }

        .import-form {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .csv-upload {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex: 1;
            min-width: 0;
            min-height: 40px;
            padding: 0 12px;
            border: 1px solid #d5dfe9;
            border-radius: 7px;
            background: #ffffff;
            cursor: pointer;
            transition: 0.18s ease;
        }

        .csv-upload:hover {
            border-color: #b9ccdd;
            background: #fafdff;
        }

        .csv-upload.has-file {
            border-color: #8db6d3;
            background: #f8fbfd;
        }

        .csv-upload-content {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .csv-upload-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            flex-shrink: 0;
            border-radius: 6px;
            background: #eef5fb;
            color: #3778a6;
        }

        .csv-upload-icon svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
        }

        .csv-file-name {
            min-width: 0;
            color: #7b8794;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .csv-file-name.selected {
            color: #405261;
            font-weight: 600;
        }

        .csv-upload-action {
            flex-shrink: 0;
            color: #3778a6;
            font-size: 12px;
            font-weight: 600;
        }

        .csv-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .documents-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .documents-title {
            color: #244967;
            font-size: 15px;
            font-weight: 700;
        }

        .document-count {
            color: #8a96a4;
            font-size: 11px;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 16px;
        }

        .document-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 18px;
            background: #ffffff;
            border: 1px solid #dfe7ef;
            border-radius: 10px;
            transition: 0.18s ease;
        }

        .document-card:hover {
            border-color: #c9d8e5;
            box-shadow: 0 6px 18px rgba(27, 73, 101, 0.07);
        }

        .document-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .document-title {
            min-width: 0;
            color: #173b5f;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;
        }

        .document-file {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 8px;
            background: #eef5fb;
            color: #3778a6;
        }

        .document-file svg {
            width: 17px;
            height: 17px;
        }

        .document-info {
            display: grid;
            gap: 8px;
            margin-bottom: 16px;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-height: 28px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eef2f6;
            font-size: 12px;
        }

        .info-label {
            color: #7b8794;
        }

        .info-value {
            min-width: 0;
            max-width: 65%;
            color: #405261;
            font-weight: 600;
            text-align: right;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .status {
            display: inline-flex;
            align-items: center;
            padding: 4px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .status-draft {
            background: #fff4d6;
            color: #946200;
        }

        .status-published {
            background: #dcfce7;
            color: #166534;
        }

        .status-archived {
            background: #e5e7eb;
            color: #4b5563;
        }

        .card-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: auto;
            padding-top: 2px;
        }

        .action-link,
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 34px;
            padding: 0 10px;
            border-radius: 7px;
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.18s ease;
        }

        .action-link svg,
        .action-button svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
        }

        .action-view {
            background: #eef5fb;
            color: #2d6d9f;
        }

        .action-view:hover {
            background: #e2eef8;
        }

        .action-edit {
            background: #f1f4f7;
            color: #596b7c;
        }

        .action-edit:hover {
            background: #e6ebf0;
        }

        .action-delete {
            background: #fdf0f0;
            color: #c45757;
        }

        .action-delete:hover {
            background: #fae2e2;
        }

        .empty-state {
            padding: 50px 20px;
            background: #ffffff;
            border: 1px dashed #c7d5e1;
            border-radius: 10px;
            text-align: center;
        }

        .empty-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            border-radius: 10px;
            background: #eef5fb;
            color: #7a9ab4;
        }

        .empty-icon svg {
            width: 22px;
            height: 22px;
        }

        .empty-title {
            color: #536577;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-description {
            margin-top: 4px;
            color: #929eaa;
            font-size: 11px;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(20, 42, 61, 0.42);
            opacity: 0;
            visibility: hidden;
            transition: 0.2s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .delete-modal {
            width: min(400px, 100%);
            padding: 24px;
            background: #ffffff;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
            box-shadow: 0 18px 50px rgba(23, 59, 95, 0.18);
            transform: translateY(8px) scale(0.98);
            transition: 0.2s ease;
        }

        .modal-overlay.show .delete-modal {
            transform: translateY(0) scale(1);
        }

        .modal-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            border-radius: 10px;
            background: #fdf0f0;
            color: #c45757;
        }

        .modal-icon svg {
            width: 21px;
            height: 21px;
            stroke-width: 1.9;
        }

        .modal-title {
            color: #173b5f;
            font-size: 17px;
            font-weight: 700;
        }

        .modal-description {
            margin-top: 7px;
            color: #788697;
            font-size: 12px;
            line-height: 1.6;
        }

        .modal-document {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 7px;
            background: #f5f8fb;
            color: #405261;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 20px;
        }

        .modal-btn {
            min-height: 36px;
            padding: 0 13px;
            border-radius: 7px;
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.18s ease;
        }

        .modal-btn-cancel {
            border-color: #d5dfe8;
            background: #ffffff;
            color: #596b7c;
        }

        .modal-btn-cancel:hover {
            background: #f4f7f9;
        }

        .modal-btn-delete {
            background: #c45757;
            color: #ffffff;
        }

        .modal-btn-delete:hover {
            background: #ad4747;
        }

        @media (max-width: 850px) {
            .page-header {
                align-items: flex-start;
            }

            .header-actions {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }

        @media (max-width: 700px) {
            .page-wrapper {
                padding: 22px 14px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .import-form {
                flex-direction: column;
                align-items: stretch;
            }

            .csv-upload {
                width: 100%;
            }

            .import-form .btn {
                width: 100%;
            }

            .document-grid {
                grid-template-columns: 1fr;
            }

            .modal-actions {
                flex-direction: column-reverse;
            }

            .modal-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .page-heading {
                align-items: flex-start;
            }

            .heading-icon {
                width: 42px;
                height: 42px;
            }

            .page-title {
                font-size: 22px;
            }

            .language-switcher {
                margin-left: auto;
            }

            .card-actions {
                flex-wrap: wrap;
            }

            .action-link,
            .action-button {
                flex: 1;
            }
        }
    </style>
</head>

<body>

    <main class="page-wrapper">
        <div class="container">

            <header class="page-header">

                <div class="page-heading">

                    <div class="heading-icon">
                        <i data-lucide="files"></i>
                    </div>

                    <div>
                        <h1 class="page-title">
                            {{ __('documents.title') }}
                        </h1>

                        <p class="page-subtitle">
                            {{ __('documents.page_list_subtitle') }}
                        </p>
                    </div>

                </div>

                <div class="header-actions">

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

                    <a
                        href="{{ route('documents.export') }}"
                        class="btn btn-secondary">
                        <i data-lucide="download"></i>
                        {{ __('documents.export') }}
                    </a>

                    <a
                        href="{{ route('documents.create') }}"
                        class="btn btn-primary">
                        <i data-lucide="plus"></i>
                        {{ __('documents.add') }}
                    </a>

                </div>

            </header>

            <section class="import-card">

                <div class="import-heading">

                    <div>
                        <h2 class="import-title">
                            {{ __('documents.import') }}
                        </h2>

                        <p class="import-description">
                            {{ __('documents.import_description') }}
                        </p>
                    </div>

                </div>

                <form
                    action="{{ route('documents.import') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="import-form">

                    @csrf

                    <label class="csv-upload" id="csv-upload">

                        <div class="csv-upload-content">

                            <div class="csv-upload-icon">
                                <i data-lucide="file-spreadsheet"></i>
                            </div>

                            <span
                                class="csv-file-name"
                                id="csv-file-name">
                                {{ __('documents.no_csv_selected') }}
                            </span>

                        </div>

                        <span class="csv-upload-action">
                            {{ __('documents.select_file') }}
                        </span>

                        <input
                            type="file"
                            name="file"
                            id="csv-file"
                            accept=".csv"
                            required
                            class="csv-input">

                    </label>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        <i data-lucide="upload"></i>
                        {{ __('documents.import') }}
                    </button>

                </form>

            </section>

            @if ($documents->count())

            <div class="documents-header">

                <h2 class="documents-title">
                    {{ __('documents.document_list') }}
                </h2>

                <span class="document-count">
                    {{ $documents->count() }}
                    {{ __('documents.document_count') }}
                </span>

            </div>

            <section class="document-grid">

                @foreach ($documents as $document)

                <article class="document-card">

                    <div class="document-header">

                        <h2 class="document-title">
                            {{ $document->title }}
                        </h2>

                        @if ($document->file_path)
                        <div class="document-file">
                            <i data-lucide="file-text"></i>
                        </div>
                        @endif

                    </div>

                    <div class="document-info">

                        <div class="info-row">
                            <span class="info-label">
                                {{ __('documents.category') }}
                            </span>

                            <span class="info-value">
                                {{ $document->category->name }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">
                                {{ __('documents.document_number') }}
                            </span>

                            <span class="info-value">
                                {{ $document->document_number ?: '-' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">
                                {{ __('documents.version') }}
                            </span>

                            <span class="info-value">
                                v{{ $document->version }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">
                                {{ __('documents.status') }}
                            </span>

                            <span class="info-value">
                                <span class="status status-{{ $document->status }}">
                                    {{ __('documents.' . $document->status) }}
                                </span>
                            </span>
                        </div>

                    </div>

                    <div class="card-actions">

                        @if ($document->file_path)

                        <a
                            href="{{ route('documents.file', $document->id) }}"
                            target="_blank"
                            class="action-link action-view">

                            <i data-lucide="eye"></i>
                            {{ __('documents.view') }}

                        </a>

                        @endif

                        <a
                            href="{{ route('documents.edit', $document->id) }}"
                            class="action-link action-edit">

                            <i data-lucide="pencil"></i>
                            {{ __('documents.edit') }}

                        </a>

                        <form
                            action="{{ route('documents.destroy', $document->id) }}"
                            method="POST"
                            class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button
                                type="button"
                                class="action-button action-delete delete-trigger"
                                data-document="{{ $document->title }}">

                                <i data-lucide="trash-2"></i>
                                {{ __('documents.delete') }}

                            </button>

                        </form>

                    </div>

                </article>

                @endforeach

            </section>

            @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i data-lucide="file-search"></i>
                </div>

                <p class="empty-title">
                    {{ __('documents.empty_title') }}
                </p>

                <p class="empty-description">
                    {{ __('documents.empty_description') }}
                </p>

            </div>

            @endif

        </div>
    </main>

    <div
        class="modal-overlay"
        id="delete-modal">

        <div
            class="delete-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-modal-title">

            <div class="modal-icon">
                <i data-lucide="trash-2"></i>
            </div>

            <h3
                class="modal-title"
                id="delete-modal-title">
                {{ __('documents.delete_title') }}
            </h3>

            <p class="modal-description">
                {{ __('documents.delete_description') }}
            </p>

            <div
                class="modal-document"
                id="delete-document-name">
            </div>

            <div class="modal-actions">

                <button
                    type="button"
                    class="modal-btn modal-btn-cancel"
                    id="cancel-delete">
                    {{ __('documents.cancel') }}
                </button>

                <button
                    type="button"
                    class="modal-btn modal-btn-delete"
                    id="confirm-delete">
                    {{ __('documents.delete_document') }}
                </button>

            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();

        const csvInput = document.getElementById('csv-file');
        const csvFileName = document.getElementById('csv-file-name');
        const csvUpload = document.getElementById('csv-upload');

        const defaultCsvFileName = csvFileName.textContent.trim();

        csvInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                csvFileName.textContent = this.files[0].name;
                csvFileName.classList.add('selected');
                csvUpload.classList.add('has-file');
            } else {
                csvFileName.textContent = defaultCsvFileName;
                csvFileName.classList.remove('selected');
                csvUpload.classList.remove('has-file');
            }
        });

        const deleteModal = document.getElementById('delete-modal');
        const deleteDocumentName = document.getElementById('delete-document-name');
        const confirmDelete = document.getElementById('confirm-delete');
        const cancelDelete = document.getElementById('cancel-delete');

        let selectedDeleteForm = null;

        document.querySelectorAll('.delete-trigger').forEach(button => {
            button.addEventListener('click', function() {
                selectedDeleteForm = this.closest('.delete-form');

                deleteDocumentName.textContent = this.dataset.document;

                deleteModal.classList.add('show');
            });
        });

        function closeDeleteModal() {
            deleteModal.classList.remove('show');
            selectedDeleteForm = null;
        }

        cancelDelete.addEventListener('click', closeDeleteModal);

        confirmDelete.addEventListener('click', function() {
            if (selectedDeleteForm) {
                selectedDeleteForm.submit();
            }
        });

        deleteModal.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>

</body>

</html>