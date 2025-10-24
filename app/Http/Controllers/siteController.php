<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteController extends Controller
{
    public function home() {
        return view('site.home');
    }
    public function layanan() {
        return view('site.layanan');
    }
    public function visiMisi() {
        return view('site.visiMisi');
    }
    public function organisasi() {
        return view('site.organisasi');
    }

    public function dashboard() {
        
    }
}
