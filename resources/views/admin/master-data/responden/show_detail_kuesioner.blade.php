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

                            <h5>Nama Kuesioner :</h5>
                            <h3 class="fw-semibold">{{ $kuesioner->first()->kuesioner->name ?? '' }}</h3>
                            <p>Dibuat tanggal : <span
                                class="fw-bolder">{{ $kuesioner->first()->kuesioner->created_at }}</span></p>

                            <hr class="divider">
                            <h5>Pertanyaan :</h5>
                            <ol>
                                @foreach ($kuesioner as $item)
                                    <form action="{{ route('responden.update_respond', $item->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <li>
                                            <input type="hidden" name="responden_id" value="{{ $item->responden_id }}">
                                            {{ $item->question->question }} <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="answers[{{ $item->question->id }}]" id="inlineRadio1"
                                                    value="1" {{ $item->answer == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="answers[{{ $item->question->id }}]" id="inlineRadio2"
                                                    value="0" {{ $item->answer == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </li>
                                @endforeach
                            </ol>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-warning">
                                    <i class="ti ti-pencil"></i> Edit Kuesioner
                                </button>
                                </form>
                                <form action="{{ route('responden.destroy_respond', $kuesioner->first()->responden->id) }}"
                                    method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="ti ti-trash"></i> Hapus Kuesioner
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
