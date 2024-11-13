<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TbQuestion;

class TbQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ENGAGING
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa nyaman ngoni rasa waktu ada berbicara tentang masalah gigi dengan dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa mudah ngoni mau menceritakan masalah ngoni tentang kesehatan gigi?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Kalau ngoni merasakan sakit atau masalah di gigi, seberapa besar kemungkinan ngoni mau menceritakan itu ke dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa besar rasa percaya ngoni waktu bercerita dengan dokter soal gigi dan mulut?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa sering ngoni bercerita ke dokter kalau ngoni merasakan kurang nyaman di gigi atau mulut?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Saat dokter bertanya soal kebiasaan ngoni menjaga kesehatan gigi, seberapa jujur ngoni akan menjawab?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa nyaman ngoni mau memberi tahu kebiasaan atau tantangan ngoni dalam menjaga kebersihan gigi dengan dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa sering ngoni bercerita soal kebiasaan makan atau minum yang bisa berpengaruh ke gigi waktu melakukan pemeriksaan ke dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Jika ngoni mendapatkan saran dari dokter tentang manjaga gigi, seberapa terbuka ngoni mau menerima saran itu?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner keterbukaan diri',
            'question_sub' => 'Kuesioner keterbukaan diri',
            'question_text' => 'Seberapa besar niat ngoni mau bercerita soal kebiasaan sikat gigi jika ditanya dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        

        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Observasi dan Catatan Lapangan',
            'question_text' => 'Nama Remaja',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Observasi dan Catatan Lapangan',
            'question_text' => 'Usia',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Observasi dan Catatan Lapangan',
            'question_text' => 'Tanggal Observasi',
            'question_type' => 'date',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Observasi dan Catatan Lapangan',
            'question_text' => 'Nama Pengamat',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);

        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Ngoni rasa remaja nyaman atau kurang nyaman waktu bicara?',
            'question_type' => 'json',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Ekspresi wajah atau gestur yang muncul selama sesi. Apakah remaja senyum, cemberut, atau terlihat canggung?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Respon terhadap pertanyaan tentang kebiasaan menjaga gigi Apakah remaja nampak tertarik atau malah cuek waktu ditanya soal sikat gigi?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Partisipasi Aktif dalam Sesi MI. Respon terhadap pertanyaan. Apakah ngoni melihat remaja dalam menjawab pertanyaan dengan semangat kah atau cuma seadanya?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Kesediaan buat cerita soal tantangan pribadi. Apakah remaja terbuka buat cerita masalahnya atau lebih menutup diri?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Ngoni-ngoni Resistensi atau Kenyamanan. Ngoni-ngoni resistensi. Apa remaja kelihatan resistensi atau menolak waktu dokter jelasin sesuatu?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Ngoni-ngoni kenyamanan. Apakah remaja terlihat nyaman bicara dan percaya sama dokter?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Reaksi terhadap saran dari dokter. Apakah remaja mau denger saran atau malah cuek pas dengar saran dari dokter?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Evaluasi Pendekatan strategi engaging. Efektivitas strategi engaging. Menurut Ngoni, strategi yang dipake apakah efektif atau kurang pas buat remaja ini?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Respons Emosional Remaja',
            'question_text' => 'Rekomendasi perbaikan strategi. Apakah ada hal yang bisa diperbaiki dari cara dokter gigi/kader untuk pendekatan ke remaja?',
            'question_type' => 'text',
            'category' => 'engaging',
        ]);

        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Seberapa percaya ngoni sama dokter untuk menjaga kesehatan gigi ngoni?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Kalau dokter memberikan saran soal gigi, seberapa yakin ngoni ingin mengikuti saran tersebut?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Seberapa nyaman ngoni bercerita jujur soal masalah gigi ke dokter?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Ngoni merasa dokter benar-benar peduli dengan kesehatan gigi ngoni?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Kalau ada masalah gigi, seberapa besar kemungkinan ngoni mau datang ke dokter ini lagi?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Seberapa besar kepercayaan ngoni kalau dokter ini tahu cara terbaik buat jaga kesehatan gigi ngoni?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Ngoni rasa dokter bisa memberikan solusi yang tepat kalau ada masalah gigi?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Kalau dokter memberikan penjelasan, seberapa percaya ngoni dengan informasi yang dokter sampaikan?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Ngoni merasa dokter ini bisa membantu ngoni buat jaga kesehatan gigi dengan lebih baik?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);
        TbQuestion::create([
            'instrument' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_sub' => 'Kepercayaan terhadap dokter / Kader Kesehatan',
            'question_text' => 'Seberapa percaya ngoni kalau dokter ini akan menjaga rahasia soal kesehatan gigi ngoni?',
            'question_type' => 'integer',
            'category' => 'engaging',
        ]);

        // FOCUSING
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa penting menurut ngoni punya gigi yang bersih dan sehat?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa besar alasan ngoni menjaga kesehatan gigi agar nafas tetap segar?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Kalau bicara soal kesehatan, seberapa penting ngoni menganggap kebersihan gigi dibanding hal lain?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa besar keinginan ngoni untuk menjaga kesehatan gigi supaya bisa senyum lebih percaya diri?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa penting menurut ngoni untuk sikat gigi dua kali sehari untuk mencegah sakit gigi?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa besar motivasi ngoni buat menjaga gigi agar tidak gampang rusak atau bolong?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Kalau ngoni lagi kumpul sama teman-teman, seberapa penting bagi ngoni untuk mempunyai gigi yang bersih?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa penting menurut ngoni ikut saran dokter buat rajin sikat gigi?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Kalau mikir soal kesehatan masa depan, seberapa besar niat ngoni menjaga kesehatan gigi?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);
        TbQuestion::create([
            'instrument' => 'Kuesioner Motivasi Kesehatan Gigi ',
            'question_sub' => 'Kuesioner Motivasi Kesehatan Gigi',
            'question_text' => 'Seberapa penting menurut ngoni buat rajin menjaga kebersihan gigi biar tidak ada plak yang nempel?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);

        TbQuestion::create([
            'instrument' => 'Skala Kesiapan untuk berubah',
            'question_sub' => 'Skala Kesiapan untuk berubah',
            'question_text' => 'Seberapa siap ngoni untuk mulai ubah kebiasaan menyikat gigi supaya lebih teratur dan benar?',
            'question_type' => 'integer',
            'category' => 'focusing',
        ]);

        // EVOKING
        TbQuestion::create([
            'instrument' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_sub' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_text' => 'Seberapa yakin ngoni bisa sikat gigi dua kali sehari secara konsisten?',
            'question_type' => 'integer',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_sub' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_text' => 'Seberapa yakin ngoni bisa mengatur waktu buat sikat gigi meski sibuk atau capek?',
            'question_type' => 'integer',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_sub' => 'Mengukur kepercayaan diri remaja untuk berubah',
            'question_text' => 'Seberapa yakin ngoni bisa melakukan kebiasaan sikat gigi ini jadi bagian rutin sehari-hari?',
            'question_type' => 'integer',
            'category' => 'evoking',
        ]);

        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Pernyataan atau ucapan yang menunjukkan keinginan remaja untuk berubah “Apakah remaja menyatakan keinginan untuk lebih rajin sikat gigi?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Pernyataan mengenai pentingnya menjaga kesehatan gigi “Apakah remaja menyebutkan alasan yang kuat kenapa penting menjaga gigi tetap sehat?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Komitmen yang diucapkan secara langsung “Apakah remaja secara langsung mengatakan akan mencoba perubahan?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Non-Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Ekspresi wajah yang menunjukkan antusiasme atau keseriusan. “Apakah remaja tampak antusias atau serius waktu bicara tentang rencana perubahan?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Non-Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Bahasa tubuh yang menunjukkan keterlibatan atau kesiapan “Apakah remaja tampak terlibat aktif, seperti mengangguk, tersenyum, atau duduk lebih tegak?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Ekspresi Non-Verbal yang Menunjukkan Motivasi dan Komitmen',
            'question_text' => 'Perubahan nada suara yang menunjukkan keyakinan “Apakah nada suara remaja terdengar lebih yakin atau bersemangat saat bicara tentang perubahan?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Indikator Motivasi Internal',
            'question_text' => 'Ngoni-ngoni motivasi yang muncul secara spontan “Apakah remaja secara spontan menyebutkan alasan pribadi yang membuat mereka ingin berubah?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Indikator Motivasi Internal',
            'question_text' => 'Respon terhadap saran tenaga kesehatan "Apakah remaja tampak setuju atau menerima saran dengan antusias?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Indikator Motivasi Internal',
            'question_text' => 'Kesediaan bertanya atau meminta saran lebih lanjut “Apakah remaja aktif bertanya atau minta tips buat mulai kebiasaan sikat gigi yang lebih baik?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Evaluasi Keberhasilan Sesi Evoking',
            'question_text' => 'Apakah sesi ini membangkitkan motivasi internal remaja untuk berubah?',
            'question_type' => 'boolean',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Evaluasi Keberhasilan Sesi Evoking',
            'question_text' => 'Apakah remaja menunjukkan kesiapan atau komitmen untuk memulai perubahan?',
            'question_type' => 'boolean',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Observasi dan Catatan Lapangan',
            'question_sub' => 'Evaluasi Keberhasilan Sesi Evoking',
            'question_text' => 'Rekomendasi untuk sesi berikutnya. Apakah ada strategi tambahan yang bisa diterapkan untuk membantu meningkatkan motivasi remaja?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);

        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Checklist Rencana Aksi',
            'question_text' => 'Nama Remaja',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Checklist Rencana Aksi',
            'question_text' => 'Usia',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Checklist Rencana Aksi',
            'question_text' => 'Tanggal Rencana Aksi',
            'question_type' => 'date',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Tujuan mengikuti konseling',
            'question_text' => 'Apa tujuan utama ngoni ikut konseling?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Langkah-langkah Konkret untuk Mencapai Tujuan',
            'question_text' => 'Tuliskan langkah-langkah yang ngoni mau lakukan supaya bisa capai tujuan tersebut.',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Waktu Pelaksanaan',
            'question_text' => '“Kapan ngoni akan mulai langkah-langkah ini?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Waktu Pelaksanaan',
            'question_text' => 'Berapa kali dalam sehari atau seminggu ngoni akan melakukan langkah-langkah ini?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Sumber Dukungan yang Diperlukan',
            'question_text' => 'Siapa atau apa saja yang bisa bantu ngoni buat tetap rajin jaga kesehatan gigi?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Kendala yang Mungkin Dihadapi',
            'question_text' => 'Apa yang mungkin bikin ngoni susah buat jaga kebiasaan ini?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Kendala yang Mungkin Dihadapi',
            'question_text' => 'Cara mengatasi kendala ini?”',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Checklist Harian Rencana Aksi',
            'question_json' => [
                'senin' => 0,
                'selasa' => 0,
                'rabu' => 0,
                'kamis' => 0,
                'jumat' => 0,
                'sabtu' => 0,
                'minggu' => 0,
            ],
            'question_type' => 'json',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Refleksi mingguan',
            'question_text' => 'Bagaimana perasaan ngoni setelah coba rencana ini selama seminggu?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist Rencana Aksi',
            'question_sub' => 'Refleksi mingguan',
            'question_text' => 'Apa yang bisa ditingkatkan atau diperbaiki?',
            'question_type' => 'text',
            'category' => 'evoking',
        ]);

        // PLANNING
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Checklist atau Lembar Pemantauan Harian',
            'question_text' => 'Nama Remaja',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Checklist atau Lembar Pemantauan Harian',
            'question_text' => 'Usia',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Checklist atau Lembar Pemantauan Harian',
            'question_text' => 'Tanggal Mulai',
            'question_type' => 'date',
            'category' => 'planning',
        ]);

        
        $activities = ['Sikat gigi pagi', 'Sikat gigi malam', 'Menggunakan benang gigi', 'Berkumur dengan mouthwash'];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        
        $checklistAtauLembarPemantauanHarianArray = [];
        foreach ($activities as $activity) {
            foreach ($days as $day) {
                $checklistAtauLembarPemantauanHarianArray[] = "{$activity} - {$day}";
            }
        }
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Checklist atau Lembar Pemantauan Harian',
            'question_json' => json_encode($checklistAtauLembarPemantauanHarianArray),
            'question_type' => 'json',
            'category' => 'planning',
        ]);

        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Refleksi Mingguan',
            'question_text' => 'Apakah ngoni merasa lebih baik dengan kebiasaan yang dilakukan minggu ini?',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Refleksi Mingguan',
            'question_text' => 'Apakah ada tantangan yang ngoni hadapi dalam menjalankan rencana ini?',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Checklist atau Lembar Pemantauan Harian',
            'question_sub' => 'Refleksi Mingguan',
            'question_text' => 'Apa yang ngoni rencanakan untuk minggu depan? Apakah ada aktivitas yang mau ditambah atau diperbaiki?',
            'question_type' => 'text',
            'category' => 'planning',
        ]);

        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Skala Kepatuhan Rencana',
            'question_text' => 'Seberapa konsisten ngoni dalam menjalankan kebiasaan menyikat gigi dua kali sehari?',
            'question_type' => 'integer',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Skala Kepatuhan Rencana',
            'question_text' => 'Seberapa konsisten ngoni dalam menggunakan benang gigi sesuai rencana?',
            'question_type' => 'integer',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Skala Kepatuhan Rencana',
            'question_text' => 'Seberapa sering ngoni mematuhi jadwal berkumur dengan mouthwash sesuai rencana?”',
            'question_type' => 'integer',
            'category' => 'planning',
        ]);

        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Catatan Evaluasi',
            'question_text' => 'Apa tantangan utama yang ngoni hadapi dalam menjalankan rencana ini?',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Catatan Evaluasi',
            'question_text' => 'Langkah apa yang bisa membantu ngoni lebih konsisten ke depannya?',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
        TbQuestion::create([
            'instrument' => 'Skala Kepatuhan Rencana',
            'question_sub' => 'Catatan Evaluasi',
            'question_text' => 'Rekomendasi tambahan dari tenaga kesehatan',
            'question_type' => 'text',
            'category' => 'planning',
        ]);
    }
}
