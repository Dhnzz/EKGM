<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Responden, Kuesioner, Article};

class DashboardController extends Controller
{
    public function index()
    {
        $countResponden = Responden::all()->count();
        $countKuesioner = Kuesioner::all()->count();
        $countArticle = Article::all()->count();

        $latest_kuesioner = Kuesioner::orderBy('created_at', 'desc')->take(5)->get();
        $latest_article = Article::orderBy('created_at','desc')->take(5)->get();
        return view('admin.dashboard', compact('countResponden','countKuesioner','countArticle','latest_kuesioner','latest_article'));
    }
}
