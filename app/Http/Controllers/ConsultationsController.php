<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    // 相談画面の表示
    public function index()
    {
        return view('consultations.index');
    }

    public function chooseCategory()
    {
        return view('consultations.choose-category');
    }

    public function chooseExpert()
    {
        return view('consultations.choose-expert');
    }
}
