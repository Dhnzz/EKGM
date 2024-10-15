@extends('admin.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kuesioner.index') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('kuesioner.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama Kuesioner <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $data->name }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="..."
                                value="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mt-1 mb-3"
                            onclick="addQuestionField()">Tambah
                            Pertanyaan</button>
                        <div class="questionContainer">
                            @foreach ($data->question as $item)
                                <div class="mb-3">
                                    <label class="control-label mb-1">Pertanyaan 1<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="questions[{{$loop->index}}][id]" class="form-control" value="{{$item->id}}" placeholder="..." />
                                        <input type="text" name="questions[{{$loop->index}}][question]" class="form-control" value="{{$item->question}}" placeholder="..." />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeQuestionField(this)">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            function addQuestionField() {
                                const questionField = document.createElement('div');
                                questionField.classList.add('mb-3');
                                // Menghitung jumlah pertanyaan yang ada saat ini
                                const questionCount = document.querySelectorAll('.questionsContainer .mb-3').length + 1;
                                questionField.innerHTML = `
                                    <label class="control-label mb-1">Pertanyaan ${questionCount} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="questions[]" class="form-control" placeholder="..." />
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeQuestionField(this)">Hapus</button>
                                    </div>
                                `;

                                // Menambahkan elemen baru di bawah elemen terakhir mb-3
                                const lastElement = document.querySelector('.questionContainer .mb-3');
                                if (lastElement) {
                                    lastElement.insertAdjacentElement('afterend', questionField);
                                } else {
                                    // Jika tidak ada elemen mb-3, tambahkan ke parent
                                    document.querySelector('.form-actions').before(questionField);
                                }

                                // Memperbarui penomoran semua pertanyaan
                                updateQuestionNumbers();
                            }

                            function removeQuestionField(element) {
                                element.parentNode.parentNode.remove();
                                // Memperbarui penomoran setelah penghapusan
                                updateQuestionNumbers();
                            }

                            function updateQuestionNumbers() {
                                // Ambil semua elemen pertanyaan
                                const questions = document.querySelectorAll('.questionsContainer .mb-3');
                                questions.forEach((question, index) => {
                                    // Temukan label dalam pertanyaan dan perbarui teks
                                    const label = question.querySelector('label');
                                    label.innerHTML = `Pertanyaan ${index + 1} <span class="text-danger">*</span>`;
                                });
                            }
                        </script>

                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-device-floppy me-1 fs-4"></i>
                            Save
                        </div>
                    </button>
                    <button type="reset" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
