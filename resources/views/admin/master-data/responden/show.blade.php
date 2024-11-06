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
                        <a href="{{ route('responden.index') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
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
    
    <div class="shop-detail">
        <div class="card shadow-none border">
            <div class="card-body p-4">
                <a href="{{ route('responden.index') }}" class="btn btn-sm btn-dark mb-3"><i class="ti ti-arrow-left"></i>
                    Kembali ke {{ $title ?? '' }}</a>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="shop-content">

                            <h5>Nama :</h5>
                            <h3 class="fw-semibold">{{ $responden->name ?? '' }}</h3>
                            <h5 class="mt-4">Nomor Telepon :</h5>
                            <h3 class="fw-semibold">{{ $responden->phone ?? '' }}</h3>
                            <p>Tanggal lahir : <span class="fw-bolder">{{ $responden->birth_date }}</span></p>

                            <hr class="divider">
                            <h5>Kuesioner yang diisi :</h5>
                            <table id="dataTable" class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kuesioner</th>
                                        <th class="text-center">Jumlah Pertanyaan</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kuesioner as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->questions->count() }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('responden.show_detail_kuesioner', $item->id) }}"
                                                    class="btn btn-sm btn-primary">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr class="divider">
                            <h5>Todo :</h5>
                            <table id="dataTable2" class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($todo as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('todo.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr class="divider">
                            <h5>Hasil OHIS :</h5>
                            <table id="dataTable3" class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle">No</th>
                                        <th rowspan="2" class="text-center align-middle">Date</th>
                                        <th colspan="12" class="text-center align-middle">OHIS</th>
                                        <th rowspan="2" class="text-center align-middle">Total DI</th>
                                        <th rowspan="2" class="text-center align-middle">Total CI</th>
                                        <th rowspan="2" class="text-center align-middle">OHI</th>
                                        <th rowspan="2" class="text-center align-middle">Kesimpulan</th>
                                        <th rowspan="2" class="text-center align-middle">Aksi</th>
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
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($ohis as $item)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-center">{{$item->date}}</td>
                                            <td class="text-center">{{$item->di_1}}</td>
                                            <td class="text-center">{{$item->di_2}}</td>
                                            <td class="text-center">{{$item->di_3}}</td>
                                            <td class="text-center">{{$item->di_4}}</td>
                                            <td class="text-center">{{$item->di_5}}</td>
                                            <td class="text-center">{{$item->ci_6}}</td>
                                            <td class="text-center">{{$item->ci_1}}</td>
                                            <td class="text-center">{{$item->ci_2}}</td>
                                            <td class="text-center">{{$item->ci_3}}</td>
                                            <td class="text-center">{{$item->ci_4}}</td>
                                            <td class="text-center">{{$item->ci_5}}</td>
                                            <td class="text-center">{{$item->ci_6}}</td>
                                            <td class="text-center">{{$item->total_di}}</td>
                                            <td class="text-center">{{$item->total_ci}}</td>
                                            <td class="text-center">{{ number_format($item->ohi, 1) }}</td>
                                            <td class="text-center">{{$item->kesimpulan}}</td>
                                            <td class="text-center">
                                                <a href="{{route('ohis.show', $item->id)}}" class="btn btn-sm btn-primary">Detail</a>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script>
        new DataTable('#dataTable');
        new DataTable('#dataTable2');
        new DataTable('#dataTable3');
    </script>
@endpush
