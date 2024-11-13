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
                            <!-- Question Section -->
                            <div id="questionSection">
                                <!-- This section will be populated dynamically -->
                            </div>

                            <script>
                                // Data questions assumed to be passed from backend (replace this example with your real data)
                                window.allQuestions = @json($tb_question);

                                document.getElementById('categorySelect').addEventListener('change', function() {
                                    var selectedCategory = this.value;
                                    if (selectedCategory) {
                                        fetchQuestionsByCategory(selectedCategory);
                                    } else {
                                        document.getElementById('questionSection').innerHTML = ''; // Clear questions
                                    }
                                });

                                function fetchQuestionsByCategory(category) {
                                    var questions = window.allQuestions || [];
                                    var filteredQuestions = questions.filter(function(question) {
                                        return question.category === category;
                                    });

                                    // Group questions by instrument
                                    var groupedByInstrument = filteredQuestions.reduce(function(acc, question) {
                                        acc[question.instrument] = acc[question.instrument] || [];
                                        acc[question.instrument].push(question);
                                        return acc;
                                    }, {});

                                    displayQuestions(groupedByInstrument);
                                }

                                function displayQuestions(groupedQuestions) {
                                    var questionSection = document.getElementById('questionSection');
                                    questionSection.innerHTML = '';

                                    for (var instrument in groupedQuestions) {
                                        if (groupedQuestions.hasOwnProperty(instrument)) {
                                            // Create instrument header
                                            var instrumentHeader = document.createElement('h4');
                                            instrumentHeader.textContent = `Instrument: ${instrument}`;
                                            instrumentHeader.className = 'mb-3 mt-4 text-primary border-bottom pb-2';
                                            questionSection.appendChild(instrumentHeader);

                                            // Tambahkan informasi pengisian kuesioner
                                            var infoDiv = document.createElement('div');
                                            infoDiv.className = 'alert alert-info mb-4';

                                            var infoText = '';
                                            var category = document.getElementById('categorySelect').value;

                                            switch (category) {
                                                case 'engaging':
                                                    switch (instrument) {
                                                        case 'Kuesioner keterbukaan diri':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Engaging - Kuesioner Keterbukaan Diri:</h5>
                                                                <p>Untuk setiap pertanyaan, pilih angka 1-5 yang paling sesuai dengan kondisi Anda:</p>
                                                                <ul>
                                                                    <li>1 = Tidak pernah</li>
                                                                    <li>2 = Jarang</li>
                                                                    <li>3 = Kadang-kadang</li>
                                                                    <li>4 = Sering</li>
                                                                    <li>5 = Selalu</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                        case 'Observasi dan Catatan Lapangan':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Engaging - Observasi:</h5>
                                                                <p>Silakan isi setiap pertanyaan dengan detail berdasarkan pengamatan awal terhadap keterbukaan responden.</p>
                                                            `;
                                                            break;
                                                        case 'Kepercayaan terhadap dokter / Kader Kesehatan':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Engaging - Kuesioner Kepercayaan terhadap dokter / Kader Kesehatan:</h5>
                                                                <p>Untuk setiap pertanyaan, pilih angka 1-5 yang paling sesuai dengan kondisi Anda:</p>
                                                                <ul>
                                                                    <li>1 = Sangat Tidak Percaya</li>
                                                                    <li>2 = Tidak Percaya</li>
                                                                    <li>3 = Netral</li>
                                                                    <li>4 = Percaya</li>
                                                                    <li>5 = Sangat Percaya</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                    }
                                                    break;

                                                case 'focusing':
                                                    switch (instrument) {
                                                        case 'Kuesioner Motivasi Kesehatan Gigi ':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Focusing - Kuesioner Motivasi Kesehatan Gigi:</h5>
                                                                <p>Untuk setiap pertanyaan, pilih angka 1-5 yang paling sesuai dengan kondisi Anda:</p>
                                                                <ul>
                                                                    <li>1 = Tidak Penting Sekali</li>
                                                                    <li>2 = Tidak Penting</li>
                                                                    <li>3 = Cukup Penting</li>
                                                                    <li>4 = Penting</li>
                                                                    <li>5 = Sangat Penting</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                        case 'Skala Kesiapan untuk berubah':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Focusing - Skala Kesiapan untuk berubah:</h5>
                                                                <p>Beri tanda pada skala dari 1 sampai 10 yang menggambarkan seberapa yakin ngoni (remaja) bisa melakukan perubahan: </p>
                                                                <ul>
                                                                    <li>1-3   = Tidak Siap Sekali</li>
                                                                    <li>4-7   = Setengah-tengah</li>
                                                                    <li>8-10  = Sangat Siap</li>
                                                            `;
                                                            break;
                                                        case 'Checklist Rencana Aksi':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Rencana Aksi:</h5>
                                                                <p>Dokumentasikan rencana dan komitmen spesifik yang disampaikan responden.</p>
                                                            `;
                                                            break;
                                                    }
                                                    break;

                                                case 'evoking':
                                                    switch (instrument) {
                                                        case 'Mengukur kepercayaan diri remaja untuk berubah':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Mengukur kepercayaan diri remaja untuk berubah:</h5>
                                                                <p>Beri tanda pada skala dari 1 sampai 10 yang menggambarkan seberapa yakin ngoni (remaja) bisa melakukan perubahan.</p>
                                                                <ul>
                                                                    <li>1 - 4 = Tidak Yakin Sama Sekali</li>
                                                                    <li>5 - 8 = Setengah yakin</li>
                                                                    <li>9 - 10 = Sangat Yakin</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                        case 'Observasi dan Catatan Lapangan':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Observasi dan Catatan Lapangan:</h5>
                                                                <p>Silakan isi setiap pertanyaan dengan detail berdasarkan pengamatan awal terhadap ekspresi verbal dan non-verbal remaja selama sesi Motivational Interviewing (MI).</p>
                                                            `;
                                                            break;
                                                        case 'Checklist Rencana Aksi':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Checklist Rencana Aksi:</h5>
                                                                <p>Silakan isi setiap bagian dengan:</p>
                                                                <ul>
                                                                    <li>Rencana aksi yang spesifik dan terukur</li>
                                                                    <li>Target waktu pelaksanaan yang jelas</li>
                                                                    <li>Langkah-langkah konkret yang akan dilakukan</li>
                                                                    <li>Hambatan yang mungkin dihadapi</li>
                                                                    <li>Strategi mengatasi hambatan</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                    }
                                                    break;
                                                case 'planning':
                                                    switch (instrument) {
                                                        case 'Checklist atau Lembar Pemantauan Harian':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Observasi dan Catatan Lapangan:</h5>
                                                                <p>Silakan isi setiap pertanyaan dengan detail berdasarkan daftar tugas terkait kebersihan gigi, seperti menyikat gigi pagi dan malam, serta penggunaan benang gigi.</p>
                                                            `;
                                                            break;
                                                        case 'Observasi dan Catatan Lapangan':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Observasi dan Catatan Lapangan:</h5>
                                                                <p>Silakan isi setiap pertanyaan dengan detail berdasarkan pengamatan awal terhadap ekspresi verbal dan non-verbal remaja selama sesi Motivational Interviewing (MI).</p>
                                                            `;
                                                            break;
                                                        case 'Checklist Rencana Aksi':
                                                            infoText = `
                                                                <h5 class="alert-heading">Petunjuk Pengisian Evoking - Checklist Rencana Aksi:</h5>
                                                                <p>Silakan isi setiap bagian dengan:</p>
                                                                <ul>
                                                                    <li>Rencana aksi yang spesifik dan terukur</li>
                                                                    <li>Target waktu pelaksanaan yang jelas</li>
                                                                    <li>Langkah-langkah konkret yang akan dilakukan</li>
                                                                    <li>Hambatan yang mungkin dihadapi</li>
                                                                    <li>Strategi mengatasi hambatan</li>
                                                                </ul>
                                                            `;
                                                            break;
                                                    }
                                                    break;
                                            }

                                            infoDiv.innerHTML = infoText;
                                            questionSection.appendChild(infoDiv);

                                            // Create list of questions for the instrument
                                            groupedQuestions[instrument].forEach(function(question) {
                                                var questionDiv = document.createElement('div');
                                                questionDiv.className = 'mb-3';

                                                var questionText = `
                                                    <label class="form-label"><strong>${question.question_text}</strong></label><br>
                                                `;

                                                var inputField = '';

                                                // Custom input berdasarkan teks pertanyaan
                                                switch (true) {
                                                    case question.question_text.includes(
                                                        'Ngoni rasa remaja nyaman atau kurang nyaman waktu bicara?'):
                                                        inputField = `
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="4>
                                                                <label class="form-check-label">Nyaman banget</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="3">
                                                                <label class="form-check-label">Agak nyaman</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="2">
                                                                <label class="form-check-label">Kurang nyaman</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="1">
                                                                <label class="form-check-label">Tidak nyaman sama sekali</label>
                                                            </div>
                                                            <div class="mt-2">
                                                                <label class="form-label">Catatan:</label>
                                                                <textarea class="form-control" name="reasons[${question.id}]" rows="2"></textarea>
                                                            </div>
                                                        `;
                                                        break;

                                                    case question.question_text.includes(
                                                        'Apakah ngoni melihat remaja dalam menjawab pertanyaan dengan semangat kah atau cuma seadanya?'
                                                    ):
                                                        inputField = `
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="4>
                                                                <label class="form-check-label">Aktif banget</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="3">
                                                                <label class="form-check-label">Lumayan aktif</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="2">
                                                                <label class="form-check-label">Biasa saja</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answers[${question.id}]" value="1">
                                                                <label class="form-check-label">Kurang aktif</label>
                                                            </div>
                                                            <div class="mt-2">
                                                                <label class="form-label">Catatan:</label>
                                                                <textarea class="form-control" name="reasons[${question.id}]" rows="2"></textarea>
                                                            </div>
                                                        `;
                                                        break;
                                                    case question.question_text.includes(
                                                        'Seberapa siap ngoni untuk mulai ubah kebiasaan menyikat gigi supaya lebih teratur dan benar?'
                                                    ):
                                                        inputField = `
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" class="text-center bg-light">Tidak Siap Sekali</th>
                                                                        <th colspan="4" class="text-center bg-light">Setengah-tengah</th>
                                                                        <th colspan="3" class="text-center bg-light">Sangat Siap</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center small">1</td>
                                                                        <td class="text-center small">2</td>
                                                                        <td class="text-center small">3</td>
                                                                        <td class="text-center small">4</td>
                                                                        <td class="text-center small">5</td>
                                                                        <td class="text-center small">6</td>
                                                                        <td class="text-center small">7</td>
                                                                        <td class="text-center small">8</td>
                                                                        <td class="text-center small">9</td>
                                                                        <td class="text-center small">10</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="2">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="3">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="4">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="5">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="6">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="7">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="8">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="9">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="10">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="mt-2">
                                                                <label class="form-label">Catatan:</label>
                                                                <textarea class="form-control" name="reasons[${question.id}]" rows="2"></textarea>
                                                            </div>
                                                        `;
                                                        break;
                                                    case question.question_text.includes(
                                                        'Seberapa yakin ngoni bisa sikat gigi dua kali sehari secara konsisten?'):
                                                    case question.question_text.includes(
                                                        'Seberapa yakin ngoni bisa mengatur waktu buat sikat gigi meski sibuk atau capek?'):
                                                    case question.question_text.includes(
                                                        'Seberapa yakin ngoni bisa melakukan kebiasaan sikat gigi ini jadi bagian rutin sehari-hari?'
                                                    ):
                                                        inputField = `
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" class="text-center bg-light">Tidak Yakin Sama Sekali</th>
                                                                        <th colspan="4" class="text-center bg-light">Setengah Yakin</th>
                                                                        <th colspan="3" class="text-center bg-light">Sangat Yakin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center small">1</td>
                                                                        <td class="text-center small">2</td>
                                                                        <td class="text-center small">3</td>
                                                                        <td class="text-center small">4</td>
                                                                        <td class="text-center small">5</td>
                                                                        <td class="text-center small">6</td>
                                                                        <td class="text-center small">7</td>
                                                                        <td class="text-center small">8</td>
                                                                        <td class="text-center small">9</td>
                                                                        <td class="text-center small">10</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="2">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="3">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="4">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="5">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="6">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="7">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="8">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="9">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="10">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        `;
                                                        break;
                                                    case question.question_text.includes(
                                                        'Seberapa yakin ngoni bisa melakukan kebiasaan sikat gigi ini jadi bagian rutin sehari-hari?'
                                                    ):
                                                        inputField = `
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" class="text-center bg-light">Tidak Yakin Sama Sekali</th>
                                                                        <th colspan="4" class="text-center bg-light">Setengah Yakin</th>
                                                                        <th colspan="3" class="text-center bg-light">Sangat Yakin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center small">1</td>
                                                                        <td class="text-center small">2</td>
                                                                        <td class="text-center small">3</td>
                                                                        <td class="text-center small">4</td>
                                                                        <td class="text-center small">5</td>
                                                                        <td class="text-center small">6</td>
                                                                        <td class="text-center small">7</td>
                                                                        <td class="text-center small">8</td>
                                                                        <td class="text-center small">9</td>
                                                                        <td class="text-center small">10</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="2">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="3">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="4">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="5">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="6">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="7">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="8">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="9">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center p-2">
                                                                            <div class="form-check d-flex justify-content-center m-0">
                                                                                <input type="radio" class="form-check-input" name="answers[${question.id}]" value="10">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        `;
                                                        break;

                                                    default:
                                                        switch (question.question_type) {
                                                            case 'text':
                                                                inputField = `
                                                                    <input type="text" name="answers[${question.id}]" class="form-control">
                                                                `;
                                                                break;
                                                            case 'integer':
                                                                inputField = generateIntegerRadioButtons(question.id);
                                                                break;
                                                            case 'json':
                                                                inputField = `
                                                                    <textarea name="answers[${question.id}]" class="form-control" rows="3" placeholder="Tuliskan detail pengamatan">${question.question_json || ''}</textarea>
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
                                                                    <div class="form-group mt-3">
                                                                        <textarea name="reason[${question.id}]" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                                                                    </div>
                                                                `;
                                                        }
                                                }

                                                questionDiv.innerHTML = questionText + inputField;
                                                questionSection.appendChild(questionDiv);
                                            });
                                        }
                                    }
                                }

                                function generateIntegerRadioButtons(questionId) {
                                    var radioButtons = '';
                                    for (var i = 1; i <= 5; i++) {
                                        radioButtons += `
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="answers[${questionId}]" id="radio_${questionId}_${i}" value="${i}">
                                                    <label class="form-check-label" for="radio_${questionId}_${i}">${i}</label>
                                                </div>
                                            `;
                                    }
                                    return radioButtons;
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
