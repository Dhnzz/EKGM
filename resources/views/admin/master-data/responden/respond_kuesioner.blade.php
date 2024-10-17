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
                        <a href="{{ route('responden.index') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('responden.respond', $responden->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Pilih Kuesioner <span class="text-danger">*</span></label>
                            <select name="kuesioner_id" id="kuesionerSelect" class="form-control">
                                <option value="">Pilih Kuesioner</option>
                                @foreach ($kuesioner as $item)
                                    <option value="{{$item->id}}" data-questions="{{ $item->question->pluck('question') }}">
                                        {{$item->name}} - Jumlah Pertanyaan: {{$item->question->count()}}
                                    </option>
                                @endforeach
                            </select>
                            <div id="kuesionerDetail" style="display: none; margin-top: 10px;">
                                <p>Detail Kuesioner:</p>
                                <p id="kuesionerName"></p>
                                <p id="kuesionerQuestions"></p>
                                <ol id="questionList"></ol>
                            </div>
                            <script>
                                document.getElementById('kuesionerSelect').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    if (selectedOption.value) {
                                        document.getElementById('kuesionerDetail').style.display = 'block';
                                        document.getElementById('kuesionerName').innerText = 'Nama: ' + selectedOption.text.split(' - ')[0];
                                        document.getElementById('kuesionerQuestions').innerText = 'Jumlah Pertanyaan: ' + selectedOption.text.split(' - ')[1].split(': ')[1];

                                        var questions = JSON.parse(selectedOption.getAttribute('data-questions'));
                                        console.log(questions);

                                        var questionList = document.getElementById('questionList');
                                        questionList.innerHTML = '';
                                        questions.forEach(function(question) {
                                            var li = document.createElement('li');
                                            li.innerText = question;
                                            questionList.appendChild(li);
                                        });
                                    } else {
                                        document.getElementById('kuesionerDetail').style.display = 'none';
                                    }
                                });
                            </script>
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
