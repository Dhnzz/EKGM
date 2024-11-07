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
                        <a href="{{ route('article.index') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="shop-detail">
        <div class="card shadow-none border">
            <div class="card-body p-4">
                <a href="{{ route('article.index') }}" class="btn btn-sm btn-dark mb-3"><i class="ti ti-arrow-left"></i>
                    Kembali ke {{ $title ?? '' }}</a>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="shop-content">

                            <h5>Nama Responden :</h5>
                            <h3 class="fw-semibold">{{ $ohis->responden->name ?? '' }}</h3>
                            <p>Dibuat tanggal : {{ $ohis->date ?? '' }}</p>

                            <hr class="divider">

                            <table id="dataTable3" class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle">Date</th>
                                        <th colspan="12" class="text-center align-middle">OHIS</th>
                                        <th rowspan="2" class="text-center align-middle">Total DI</th>
                                        <th rowspan="2" class="text-center align-middle">Total CI</th>
                                        <th rowspan="2" class="text-center align-middle">OHI</th>
                                        <th rowspan="2" class="text-center align-middle">Kesimpulan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">DI 1</th>
                                        <th class="text-center">DI 2</th>
                                        <th class="text-center">DI 3</th>
                                        <th class="text-center">DI 4</th>
                                        <th class="text-center">DI 5</th>
                                        <th class="text-center">DI 6</th>
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
                                        <td class="text-center">{{ $ohis->date }}</td>
                                        <td class="text-center">{{ $ohis->di_1 }}</td>
                                        <td class="text-center">{{ $ohis->di_2 }}</td>
                                        <td class="text-center">{{ $ohis->di_3 }}</td>
                                        <td class="text-center">{{ $ohis->di_4 }}</td>
                                        <td class="text-center">{{ $ohis->di_5 }}</td>
                                        <td class="text-center">{{ $ohis->ci_6 }}</td>
                                        <td class="text-center">{{ $ohis->ci_1 }}</td>
                                        <td class="text-center">{{ $ohis->ci_2 }}</td>
                                        <td class="text-center">{{ $ohis->ci_3 }}</td>
                                        <td class="text-center">{{ $ohis->ci_4 }}</td>
                                        <td class="text-center">{{ $ohis->ci_5 }}</td>
                                        <td class="text-center">{{ $ohis->ci_6 }}</td>
                                        <td class="text-center">{{ $ohis->total_di }}</td>
                                        <td class="text-center">{{ $ohis->total_ci }}</td>
                                        <td class="text-center">{{ number_format($ohis->ohi, 1) }}</td>
                                        <td class="text-center">{{ $ohis->kesimpulan }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-3">
                                <a href="{{ route('ohis.edit', $ohis->id) }}" class="btn btn-warning">
                                    <i class="ti ti-pencil"></i> Edit Artikel
                                </a>
                                <form action="{{ route('ohis.delete', $ohis->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="ti ti-trash"></i> Hapus OHIS
                                    </button>
                                </form>
                            </div>
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
