<?php

namespace App\Http\Controllers;

use App\Models\DetailRekamMedis;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use App\Models\RekamMedis;
use Auth;
use Illuminate\Http\Request;
use Session;

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

        return view('dokter.rekamMedis', [
            'role_id' => $role_id,
            'rekam_medis_detail' => RekamMedis::with(['TemuDokter.Pet.Pemilik.User', 'DokterPemeriksa.User'])->get()
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
            'rekam' => $rekam,
            'detil_rekam_medis' => $detil_rekam_medis
        ]);

    }

    public function showKodeTindakan(Request $request, $id) {
        return view('pages.showKodeTindakanTerapi', [
            'tindakan_detail' => KodeTindakanTerapi::where('idkode_tindakan_terapi', $id)->with(['Kategori', 'KategoriKlinis'])->first(),
            'kategori_klinises' => KategoriKlinis::all(),
            'kategories' => Kategori::all()
        ]);
    }
}
