<?php

namespace App\Http\Controllers;

use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\rasHewan;
use App\Models\RoleUser;
use App\Models\UserRshp;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index() {
        $user = UserRshp::find('15');
        return view(
            'pages.index',
            [
                'user' => $user,
                'role_aktif' => RoleUser::RoleAktif($user->iduser)
            ]
        );
    }

    public function user() {
        return view(
            'pages.userData',
            [
                'users' => UserRshp::with(['RoleUser.Role'])->get()
            ]
        );
    }

    public function jenisHewan() {
        return view(
            'pages.jenisHewan',
            [
                'jenisHewans' => jenisHewan::all()
            ]
        );
    }

    public function rasHewan() {
        return view(
            'pages.rasHewan',
            [
                'rasHewans' => rasHewan::with(['JenisHewan'])->get()
            ]
        );
    }

    public function kategori() {
        return view(
            'pages.kategori',
            [
                'categories' => Kategori::all()
            ]
        );
    }

    public function kategoriKlinis() {
        return view(
            'pages.kategoriKlinis',
            [
                'kategoriClinises' => KategoriKlinis::all()
            ]
        );
    }

    public function kodeTindakanTerapi() {
        return view(
            'pages.kodeTindakanTerapi',
            [
                'therapies' => KodeTindakanTerapi::with(['Kategori', 'KategoriKlinis'])->get()
            ]
        );
    }
}
