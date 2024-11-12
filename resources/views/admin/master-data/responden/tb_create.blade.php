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
                            <div class="mb-3">
                                <label class="control-label mb-1">Pilih Kategori Pertanyaan <span
                                        class="text-danger">*</span></label>
                                <select name="category" id="categorySelect" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <option value="engaging">Engaging</option>
                                    <option value="focusing">Focusing</option>
                                    <option value="evoking">Evoking</option>
                                    <option value="planning">Planning</option>
                                </select>
                            </div>
                            <div id="kuesionerDetail" style="display: none; margin-top: 10px;">
                                <p>Detail Pertanyaan:</p>
                                <ol id="questionList"></ol>
                            </div>
                            <script>
                                window.allQuestions = @json($tb_question);

                                document.getElementById('categorySelect').addEventListener('change', function() {
                                    var selectedCategory = this.value;
                                    if (selectedCategory) {
                                        fetchQuestionsByCategory(selectedCategory);
                                    } else {
                                        document.getElementById('kuesionerDetail').style.display = 'none';
                                    }
                                });

                                function fetchQuestionsByCategory(category) {
                                    // Assuming you have a global variable `allQuestions` containing all questions data.
                                    // In practice, you might fetch this data via an API call or already have it available.
                                    var questions = window.allQuestions || []; // Replace this with your data source if needed
                                    var filteredQuestions = questions.filter(function(question) {
                                        return question.category === category;
                                    });

                                    displayQuestions(filteredQuestions);
                                }

                                function displayQuestions(questions) {
                                    var questionList = document.getElementById('questionList');
                                    questionList.innerHTML = '';
                                    if (questions.length > 0) {
                                        document.getElementById('kuesionerDetail').style.display = 'block';
                                        questions.forEach(function(question) {
                                            var li = document.createElement('li');
                                            var questionText = `
                                                <strong>${question.question_text}</strong>
                                                <br><em>${question.category} - ${question.instrument}</em><br>
                                            `;

                                            var inputField = '';
                                            switch (question.question_type) {
                                                case 'text':
                                                    inputField = `
                                                        <input type="text" name="answers[${question.id}]" class="form-control" placeholder="${question.question_text}">
                                                    `;
                                                    break;
                                                case 'integer':
                                                    inputField = `
                                                        <input type="number" name="answers[${question.id}]" class="form-control" placeholder="${question.question_text}">
                                                    `;
                                                    break;
                                                case 'json':
                                                    inputField = `
                                                        <textarea name="answers[${question.id}]" class="form-control" placeholder="${question.question_text}">${question.question_json || ''}</textarea>
                                                    `;
                                                    break;
                                                case 'date':
                                                    inputField = `
                                                        <input type="date" name="answers[${question.id}]" class="form-control">
                                                    `;
                                                    break;
                                                default:
                                                    inputField = `
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="answers[${question.id}]" value="1">
                                                            <label class="form-check-label">Ya</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="answers[${question.id}]" value="0">
                                                            <label class="form-check-label">Tidak</label>
                                                        </div>
                                                    `;
                                            }

                                            li.innerHTML = questionText + inputField;
                                            questionList.appendChild(li);
                                        });
                                    } else {
                                        document.getElementById('kuesionerDetail').style.display = 'none';
                                    }
                                }
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
