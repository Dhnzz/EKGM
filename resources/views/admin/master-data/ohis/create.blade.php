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
        <form action="{{ route('ohis.store', $responden->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h5>Nama Responden :</h5>
                <h3 class="fw-semibold">{{ $responden->name ?? '' }}</h3>
            </div>
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                @foreach (array_chunk(['date','di_1', 'di_2', 'di_3', 'di_4', 'di_5', 'di_6', 'ci_1', 'ci_2', 'ci_3', 'ci_4', 'ci_5', 'ci_6'], 3) as $fields)
                    <div class="row">
                        @foreach ($fields as $field)
                            <div class="col-md-4">
                                @error($field)
                                    <ul>
                                        <li class="text-danger">{{ $message }}</li>
                                    </ul>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" class="form-control" name="date" id="name">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">DI 1</th>
                                <th class="text-center">DI 2</th>
                                <th class="text-center">DI 3</th>
                                <th class="text-center">DI 4</th>
                                <th class="text-center">DI 5</th>
                                <th class="text-center">DI 6</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <select name="di_1" id="di_1" class="form-control @error('di_1') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="di_2" id="di_2" class="form-control @error('di_2') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="di_3" id="di_3" class="form-control @error('di_3') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="di_4" id="di_4" class="form-control @error('di_4') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="di_5" id="di_5" class="form-control @error('di_5') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="di_6" id="di_6" class="form-control @error('di_6') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">CI 1</th>
                                <th class="text-center">CI 2</th>
                                <th class="text-center">CI 3</th>
                                <th class="text-center">CI 4</th>
                                <th class="text-center">CI 5</th>
                                <th class="text-center">CI 6</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <select name="ci_1" id="ci_1" class="form-control @error('ci_1') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="ci_2" id="ci_2" class="form-control @error('ci_2') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="ci_3" id="ci_3" class="form-control @error('ci_3') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="ci_4" id="ci_4" class="form-control @error('ci_4') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="ci_5" id="ci_5" class="form-control @error('ci_5') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="ci_6" id="ci_6" class="form-control @error('ci_6') is-invalid @enderror">
                                        <option value="">Nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
