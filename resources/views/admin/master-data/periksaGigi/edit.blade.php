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
        <form action="{{ route('periksaGigi.update', $periksaGigi->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ $periksaGigi->date }}"
                                class="form-control @error('date') is-invalid @enderror" placeholder="..."
                                value="{{ old('date') }}" />
                            @error('date')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3 d-flex flex-row gap-5 align-items-center" width="100">
                            <div class="card mb-0">
                                <div class="card-body p-2">
                                    <img id="cover-preview"
                                        src="{{ asset('uploads/periksaGigi/image/' . $periksaGigi->image) }}"
                                        width="200px" alt="">
                                </div>
                            </div>
                            <div class="flex-fill">
                                <label class="control-label mb-1">Cover Artikel<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="image" id="cover-input"
                                        class="form-control @error('image') is-invalid @enderror" placeholder="..." />
                                    <input type="hidden" name="current_cover" value="{{ $periksaGigi->image ?? '' }}" />
                                </div>
                                @error('image')
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
                            <label class="control-label mb-1">Hasil Pemeriksaan</label>
                            <input type="text" name="result" value="{{$periksaGigi->result}}" class="form-control @error('result') is-invalid @enderror"
                                placeholder="..." value="{{ old('result') }}" />
                            @error('result')
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
