@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #sync1 .btn-nav-dark {
            width: 20px;
            height: 20px;
            padding: 2px;
            background-color: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 12px;
        }

        #sync1 .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        table tr td {
            padding: 5px;
        }
    </style>
@endpush

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

    <div class="shop-detail">
        <div class="card shadow-none border">
            <div class="card-body p-4">
                <a href="{{ route('kuesioner.index') }}" class="btn btn-sm btn-dark mb-3"><i class="ti ti-arrow-left"></i>
                    Kembali ke {{ $title ?? '' }}</a>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="shop-content">

                            <h5>Nama Kuesioner :</h5>
                            <h3 class="fw-semibold">{{ $data->name ?? '' }}</h3>
                            <p>Dibuat tanggal : <span class="fw-bolder">{{ $data->created_at }}</span></p>

                            <hr class="divider">
                            <h5>Kuesioner yang diisi :</h5>
                            <table id="dataTable" class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Responden</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($responden as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <a href="{{ route('kuesioner.edit', $item->id) }}" class="btn btn-warning">
                                                    <i class="ti ti-pencil"></i> Edit Responden
                                                </a>
                                                <form action="{{ route('responden.delete', $item->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="ti ti-trash"></i> Hapus Responden
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // product detail
        $(function() {
            var sync1 = $("#sync1");

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-right"></i></span>'
                ],
            });
        })
    </script>
@endpush
