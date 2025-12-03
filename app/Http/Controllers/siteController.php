<?php

namespace App\Http\Controllers;

use App\Models\DetailRekamMedis;
use App\Models\Dokter;
use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pemilik;
use App\Models\Perawat;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\UserRshp;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use function Laravel\Prompts\select;

class siteController extends Controller
{
    public function maintenanced()  {
        return view('UnderMaintenance');
    }
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

    public function createUser() {
    }

    public function createJenisHewan() {
        return view('pages.CreateJenisHewan');
    }
    public function editPet(Request $request, $id) {
        return view('pages.editPet', [
            'id' => $id,
            'pet_detail' => Pet::with(['Pemilik.User', 'RasHewan.JenisHewan'])->get()->find((int) $id)
        ]);
    }

    public function rekamMedis(Request $request) {
        
        if (! Auth::check() ) {
            Session::flush();
            return redirect('/login')->with('akses anda ditolak');
        }
        
        $role_id = Session::get('role_id');
        if (! \in_array($role_id, [1, 2, 3])) {
            return redirect('/login')->with('akses anda ditolak');
        }

        if (\in_array($role_id, [1, 3])) {
            $rekam_medis_detail = RekamMedis::with(['TemuDokter.Pet.Pemilik.User', 'DokterPemeriksa.User'])->get();
        } else {
            $user_logged_in = Auth::user()->RoleUser()->where('status', 1)->first();
            // dd($user_logged_in);

            $rekam_medis_detail = RekamMedis::with(['TemuDokter.Pet.Pemilik.User', 'DokterPemeriksa.User'])->where('dokter_pemeriksa', $user_logged_in->idrole_user)->get();
        }
        

        return view('dokter.rekamMedis', [
            'role_id' => $role_id,
            'rekam_medis_detail' => $rekam_medis_detail
        ]);
        
    }

    public function detilRekamMedis(Request $request, $id) {
        if (! Auth::check() ) {
            Session::flush();
            return redirect('/login')->with('akses anda ditolak');
        }
        
        $role_id = Session::get('role_id');
        if (! \in_array($role_id, [1, 2, 3])) {
            return redirect('/login')->with('akses anda ditolak');
        }

        $rekam = RekamMedis::where('idrekam_medis', $id)->with(['DokterPemeriksa.User', 'TemuDokter.Pet.RasHewan.JenisHewan', 'TemuDokter.Pet.Pemilik.User'])->first();
        $detil_rekam_medis = DetailRekamMedis::where('idrekam_medis', $id)->with(['KodeTindakanTerapi.KategoriKlinis', 'KodeTindakanTerapi.Kategori'])->get();

        return view('dokter.detilRekamMedis', [
            'role_id' => $role_id,
            'rekam' => $rekam,
            'detil_rekam_medis' => $detil_rekam_medis,
            'tindakans' => DB::table('kode_tindakan_terapi')->join('kategori', 'kode_tindakan_terapi.idkategori', '=','kategori.idkategori')->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')->select('kode_tindakan_terapi.idkode_tindakan_terapi', 'kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi', 'kategori_klinis.nama_kategori_klinis', 'kategori.nama_kategori')->get()
        ]);

    }

    public function showKodeTindakan(Request $request, $id) {
        return view('pages.showKodeTindakanTerapi', [
            'tindakan_detail' => KodeTindakanTerapi::where('idkode_tindakan_terapi', $id)->with(['Kategori', 'KategoriKlinis'])->first(),
            'kategori_klinises' => KategoriKlinis::all(),
            'kategories' => Kategori::all()
        ]);
    }

    public function createRekamMedis(Request $request, $id) {
        $temu_dokter = TemuDokter::where('idreservasi_dokter', $id)->with(['Pet.RasHewan.JenisHewan', 'Pet.Pemilik.User'])->first();

        return view('perawat.create-rekam-medis', [
            'temu_dokter' => $temu_dokter,
            'dokters' => UserRshp::whereHas('RoleUser.Role', function ($q) {
                    $q->where('idrole', '2')->where('status', '1');
                })->with('RoleUser.Role')->get()
        ]);
    }

    public function viewPemilik(Request $request) {
        if (! Auth::check() ) {
            Session::flush();
            return redirect('/login')->with('akses anda ditolak');
        }
        
        $role_id = Session::get('role_id');
        if (! \in_array($role_id, [1, 2, 3])) {
            return back()->with('akses anda ditolak');
        }

        return view('pages.view_only.Pemilik', [
            'pemiliks' => Pemilik::with(['User'])->get()
        ]);
    }

    public function viewPet(Request $request) {
        if (! Auth::check() ) {
            Session::flush();
            return redirect('/login')->with('akses anda ditolak');
        }
        
        $role_id = Session::get('role_id');
        if (! \in_array($role_id, [1, 2, 3])) {
            return back()->with('akses anda ditolak');
        }

        return view('pages.view_only.pet', [
                'pets' => Pet::with(['Pemilik.User', 'RasHewan.JenisHewan'])->get(),
                'pemiliks' => Pemilik::with('User')->get(),
                'jeniss' => jenisHewan::all(),
        ]);
    }

    public function editProfileDoktor(Request $request) {
        $dokter_data = Dokter::where('id_user', Auth::user()->iduser)->with(['UserRshp'])->first();
        return view('dokter.edit-profile', [
            'dokter_data' => $dokter_data
        ]);
    }

    public function editProfilePerawat() {
        $perawat_data = Perawat::where('id_user', Auth::user()->iduser)->with(['UserRshp'])->first();
        return view('perawat.edit-profile', [
            'perawat_data' => $perawat_data
        ]);
    }

}
