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
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row w-100">
                <div class="col-12 d-flex justify-content-md-end justify-content-end mt-3 mt-md-0">
                    <a href="{{ route('category.create') }}" class="btn btn-info d-flex align-items-center">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah Kategori
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert"
            id="success-alert">
            <div class="d-flex gap-2 align-items-center">
                <div>
                    <span class="d-inline-flex p-1 rounded-circle border-2 border-white mb-0">
                        <i class="fs-5 ti ti-check"></i>
                    </span>
                </div>
                <div>
                    {{ $message ?? '' }}
                </div>
            </div>
        </div>
    @endif

    <table id="dataTable" class="table table-sm table-bordered" width="100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($category_data as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center align-middle d-flex flex-row justify-content-center gap-2">
                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{route('category.delete', $item->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script>
        new DataTable('#dataTable');
    </script>
@endpush
