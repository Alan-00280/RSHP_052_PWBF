<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pemilik;
use App\Models\Perawat;
use App\Models\Pet;
use App\Models\rasHewan;
use App\Models\RekamMedis;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\TemuDokter;
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
                'jenisHewans' => jenisHewan::with(['RasHewan'])->get()
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
                'therapies' => KodeTindakanTerapi::with(['Kategori', 'KategoriKlinis'])->paginate(10),
                'kategories' => Kategori::all(),
                'kategori_klinises' => KategoriKlinis::all()
            ]
        );
    }

    public function Pet() {
        return view(
            'pages.pet',
            [
                'pets' => Pet::with(['Pemilik.User', 'RasHewan.JenisHewan'])->get(),
                'pemiliks' => Pemilik::with('User')->get(),
                'jeniss' => jenisHewan::all(),
            ]
        );
    }

    public function Role() {
        return view(
            'pages.role',
            [
                'roles' => Role::all(),
                'user_role' => UserRshp::with('RoleUser.Role')->get()
            ]
        );
    }

    public function Pemilik() {
        return view (
            'pages.pemilik',
            [
                'pemiliks' => Pemilik::with(['User'])->get()
            ]
        );
    }

    public function TemuDokter() {
        $temu_dokter_detail = TemuDokter::with(['Pet.RasHewan.JenisHewan', 'Pet.Pemilik.User', 'Resepsionis.User'])->orderBy('status', 'desc')->get();
        
        return view (
            'pages.temuDokter',
            [
                'temu_dokter_details' => $temu_dokter_detail,
                'login_user_role' => Auth::user()->load([
                                        'RoleUser' => function ($q) {
                                            $q->where('status', 1);
                                        }
                                    ]),
                'resepsionises' => UserRshp::whereHas('RoleUser.Role', function ($q) {
                    $q->where('idrole', '4')->where('status', '1');
                })->with('RoleUser.Role')->get(),
                'pemiliks' => Pemilik::with('User')->get()
            ]
        );
    }

    public function profileDoktor()  {
        $dokter_data = Dokter::where('id_user', Auth::user()->iduser)->with(['UserRshp'])->first();
        return view('dokter.profile', [
            'dokter_data' => $dokter_data
        ]);
    }

    public function profilePerawat()  {
        $perawat_data = Perawat::where('id_user', Auth::user()->iduser)->with(['UserRshp'])->first();
        return view('perawat.profile', [
            'perawat_data' => $perawat_data
        ]);
    }

    public function profilPemilik() {
        $pemilik_data = Pemilik::where('iduser', Auth::user()->iduser)->with(['UserRshp'])->first();
        return view('pemilik.profile', [
            'pemilik_data' => $pemilik_data
        ]);
    }
}
