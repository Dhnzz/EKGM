@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                            class="icon icon-tabler icon-tabler-box mb-3 text-primary" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        <p class="fw-semibold fs-3 text-primary mb-1"> Responden </p>
                        <h5 class="fw-semibold text-primary mb-0">{{ $countResponden ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                            class="icon icon-tabler icon-tabler-box mb-3 text-warning" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                        </svg>
                        <p class="fw-semibold fs-3 text-warning mb-1"> Kuesioner </p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $countKuesioner ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                            class="icon icon-tabler icon-tabler-box mb-3 text-danger" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-article">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                            <path d="M7 8h10" />
                            <path d="M7 12h10" />
                            <path d="M7 16h10" />
                        </svg>
                        <p class="fw-semibold fs-3 text-danger mb-1"> Artikel </p>
                        <h5 class="fw-semibold text-danger mb-0">{{ $countArticle ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="position-relative">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Kuesioner Terakhir</h5>
                                <p class="card-subtitle mb-0">Lima kuesioner terakhir</p>
                            </div>
                            <div>
                                <a href="{{route('kuesioner.index')}}" class="btn btn-sm btn-light-primary">Lihat selengkapnya</a>
                            </div>
                        </div>
                        <div>
                            @if (count($latest_kuesioner) > 0)
                                @foreach ($latest_kuesioner as $item)
                                    <div class="d-flex align-items-center pb-2">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div>
                                                <h5 class="fw-semibold fs-4 mb-2"> {{ $item->name }} </h5>
                                                Jumlah Pertanyaan : {{ $item->questions->count() }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning mb-0" role="alert">
                                    <div class="d-flex gap-2 align-items-center">
                                        <span
                                            class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block"
                                            style="font-size: 16px;">
                                            <i class="ti ti-alert-circle"></i>
                                        </span>
                                        <p class="mb-0">
                                            Belum ada kuesioner. <a href="{{ route('kuesioner.create') }}">Add</a> now.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold mb-0">Artikel terakhir</h5>
                            </div>
                            <div>
                                <a href="{{route('article.index')}}" class="btn btn-sm btn-light-primary">Lihat selengkapnya</a>
                            </div>
                        </div>
                        <div>
                            @if (count($latest_article) > 0)
                                @foreach ($latest_article as $item)
                                    <div class="d-flex align-items-center pb-2">
                                        <div class="me-3 pe-1">
                                            <img src="{{ asset('uploads/article/image/' . $item->cover) }}"
                                                class="shadow-warning rounded-2" alt="" width="72"
                                                height="72" style="object-fit: cover;" />
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div>
                                                <h5 class="fw-semibold fs-4 mb-2"> {{ $item->title }} </h5>
                                                <p>{{ Str::limit($item->content, 30) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning mb-0" role="alert">
                                    <div class="d-flex gap-2 align-items-center">
                                        <span
                                            class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block"
                                            style="font-size: 16px;">
                                            <i class="ti ti-alert-circle"></i>
                                        </span>
                                        <p class="mb-0">
                                            Belum ada artikel. <a href="{{ route('article.create') }}">Add</a> now.
                                        </p>
                                    </div>
                                </div>
                            @endif
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
        $(function() {
            $(".counter-carousel").owlCarousel({
                loop: true,
                margin: 30,
                mouseDrag: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplaySpeed: 2000,
                nav: false,
                responsive: {
                    0: {
                        items: 2,
                    },
                    576: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    }
                },
            });
        });
    </script>
@endpush
