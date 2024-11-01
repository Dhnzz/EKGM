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
                        <a href="{{ route('article.index') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="..." value="{{ old('title') }}" />
                            @error('title')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3 d-flex flex-row gap-5 align-items-center" width="100">
                            <div class="card mb-0">
                                <div class="card-body p-2">
                                    <img id="cover-preview" src="{{ asset('uploads/article/image/default.jpg') }}"
                                        width="200px" alt="">
                                </div>
                            </div>
                            <div class="flex-fill">
                                <label class="control-label mb-1">Cover Artikel<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="cover" id="cover-input"
                                        class="form-control @error('cover') is-invalid @enderror" placeholder="..." />
                                </div>
                                @error('cover')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <script>
                            document.getElementById('cover-input').addEventListener('change', function(event) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('cover-preview').src = e.target.result;
                                }
                                reader.readAsDataURL(event.target.files[0]);
                            });
                        </script>
                        <div class="mb-3">
                            <label class="control-label mb-1">URL Video</label>
                            <input type="text" name="videoUrl" class="form-control @error('videoUrl') is-invalid @enderror"
                                placeholder="..." value="{{ old('videoUrl') }}" />
                            @error('videoUrl')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Isi konten<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <textarea name="content" id="" cols="30" class="form-control @error('content') is-invalid @enderror"
                                    rows="10">{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
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
