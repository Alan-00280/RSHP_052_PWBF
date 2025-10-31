<?php

namespace App\Http\Controllers;

use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use App\Models\rasHewan;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\UserRshp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class dashboardController extends Controller
{
    public function index() {

        if (! Auth::check()) {
            Session::flush();
            return redirect(route('login'));
        }

        $role_id = Session::get('role_id');
        return view('pages.index', [
            'role_id' => $role_id
        ]);
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

    public function Pet() {
        return view(
            'pages.pet',
            [
                'pets' => Pet::with(['Pemilik.User'])->get()
            ]
        );
    }

    public function Role() {
        return view(
            'pages.role',
            [
                'roles' => Role::all()
            ]
        );
    }
}
