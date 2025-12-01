<?php

namespace App\Http\Controllers;

use App\Models\DetailRekamMedis;
use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\rasHewan;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\UserRshp;
use App\View\Components\functionCard;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class masterController extends validationController
{
    public function createUser() {
        // UserRshp::created()
    }

    public function updateUser(Request $request){
        
    }

    public function createJenisHewan(Request $request) {
        $validated = $this->validateJenisHewan($request);
        try {
            jenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
            ]);
            return redirect()->route('create-jenishewan-page')->with('success', 'Berhasil menambahkan jenis hewan');
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan: '. $e->getMessage());
        }
    }

    protected function formatNamaJenisHewan($nama)  {
        return trim(ucwords(strtolower($nama)));
    }

    public function patchPet(Request $request, $id) {
        $validated = $this->validatePatchPet($request);
        try {
            $findPet = Pet::findOrFail($id);
            $findPet->update([
                'nama' => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'warna_tanda' => $validated['warna_tanda'],
                'jenis_kelamin' => $validated['jenis_kelamin']
            ]);
            return redirect()->route('edit-pet', ['id'=>$id])->with('success', 'Berhasil Mengupdate Pet');
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan: '. $e->getMessage());
        }
    }

    public function patchPemilik(Request $request, $id) {
        $validated = $this->validatePemilik($request);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
        ]);

        $user = UserRshp::findOrFail($pemilik->User->iduser);
        $user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email']
        ]);

        return redirect()->route('pemilik-resep')->with('success', 'Berhasil Update Data Pemilik');
    }

    public function postPemilik(Request $request) {
        $validated = $this->validatePemilik($request);

        // $request->validate([
        //     'password' => 'min:3|required|max:126|string'
        // ]);
        // $password = $request->get('password');
        // $password = bcrypt($password);

        try {
            $user_create = UserRshp::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => 'null'
            ]);

            $pemilik_create = Pemilik::create([
                'no_wa' => $validated['no_wa'],
                'alamat' => $validated['alamat'],
                'iduser' => $user_create->iduser
            ]);

            return redirect()->route('pemilik-resep')->with('success', 'Berhasil menambahkan pemilik');
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan: '. $e->getMessage());
        }
    }

    public function getRasbyJenis(Request $request, $idjenis) {
        return response()->json(rasHewan::where('idjenis_hewan', $idjenis)->get());
    }

    public function createPet(Request $request) {
        $validated = $this->validatePetCreate($request);
        $dateFormatted = Carbon::createFromFormat('m/d/Y', $validated['datepick'])->format('Y-m-d');

        try {
            Pet::create([
                'nama' => $validated['nama_pet'],
                'tanggal_lahir' => $dateFormatted,
                'warna_tanda' => $validated['warna_jenis'],
                'jenis_kelamin' => $validated['kelamin'],
                'idpemilik' => $request->get('idPemilik'),
                'idras_hewan' => $validated['idRas']
            ]);

            return redirect()->route('pet')->with('success', 'Berhasil menambahkan Pet');
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan: '. $e->getMessage());
        }
    }

    public function updateKategori(Request $request, $id) {
        $request->validate([
            'nama' => 'string|required|min:3|max:255|unique:kategori,nama_kategori,'.$id.',idkategori'
        ]);

        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->get('nama')
            ]);

            return redirect()->route('kategori-data')->with('success', 'Berhasil mengupdate kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function createKategori(Request $request) {
        $request->validate([
            'nama' => 'string|required|min:3|max:255|unique:kategori,nama_kategori'
        ]);
        try {
            Kategori::create([
                'nama_kategori' => $request->get('nama')
            ]);

            return redirect()->route('kategori-data')->with('success', 'Berhasil menambah kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function deleteKategori(Request $request, $id) {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function updateKategoriKlinis(Request $request, $id) {
        $request->validate([
            'nama' => 'string|required|min:3|max:255|unique:kategori_klinis,nama_kategori_klinis,'.$id.',idkategori_klinis'
        ]);

        try {
            $kategori_klinis = KategoriKlinis::findOrFail($id);
            $kategori_klinis->update([
                'nama_kategori_klinis' => $request->get('nama')
            ]);

            return redirect()->back()->with('success', 'Berhasil mengupdate kategori klinis');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function createKategoriKlinis(Request $request) {
        $request->validate([
            'nama' => 'string|required|min:3|max:255|unique:kategori_klinis,nama_kategori_klinis'
        ]);
        try {
            KategoriKlinis::create([
                'nama_kategori_klinis' => $request->get('nama')
            ]);

            return redirect()->back()->with('success', 'Berhasil menambah kategori klinis');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function deleteKategoriKlinis(Request $request, $id) {
        try {
            $kategori_klinis = KategoriKlinis::findOrFail($id);
            $kategori_klinis->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function updateKodeTindakan(Request $request, $id) {
        $validated = $this->validateTindakan($request);
        try {
            $tindakan = KodeTindakanTerapi::findOrFail($id);
            $tindakan->update([
                'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'],
                'idkategori' => $validated['idkategori'],
                'idkategori_klinis' => $validated['idkategori_klinis']
            ]);
            return redirect()->back()->with('success', 'Berhasil mengupdate kode tindakan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function createKodeTindakan(Request $request) {
        $validated = $this->validateTindakan($request);
        try {
            KodeTindakanTerapi::create([
                'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'],
                'idkategori' => $validated['idkategori'],
                'idkategori_klinis' => $validated['idkategori_klinis']
            ]);
            return redirect()->route('kategori-tindakan-terapi')->with('success', 'Berhasil membuat kode tindakan');
        } catch (\Exception $e) {
            return redirect()->route('kategori-tindakan-terapi')->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function deleteKodeTindakan(Request $request, $id)  {
        try {
            $tindakan = KodeTindakanTerapi::findOrFail($id);
            $tindakan->delete();
            return redirect()->route('kategori-tindakan-terapi')->with('success', 'Berhasil menghapus kode tindakan');
        } catch (\Exception $e) {
            return redirect()->route('kategori-tindakan-terapi')->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function getPetbyPemilik(Request $request, $id) {
        return response()->json(Pet::where('idpemilik', $id)->with(['RasHewan'])->get());
    }

    public function createTemuDokter(Request $request) {
        $request->validate([
            'idResepsionis' => 'required|string',
            'idPemilik' => 'required|string',
            'idPet' => 'required|string'
        ]);

        try {
            TemuDokter::create([
                'idpet' => $request->get('idPet'),
                'iddokter' => $request->get('idResepsionis')
            ]);

            return redirect()->route('temu-dokter')->with('success', 'Berhasil membuat temu dokter');
        } catch (\Exception $e) {
            return redirect()->route('temu-dokter')->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function deleteTemuDokter(Request $request, $id) {
        try {
            $temu_dokter = TemuDokter::where('idreservasi_dokter', $id)->where('status', 'W')->firstOrFail();
            $temu_dokter->delete();
            return redirect()->route('temu-dokter')->with('success', 'Berhasil menghapus temu dokter');
        } catch (\Exception $e) {
            return redirect()->route('temu-dokter')->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function getTemuDokterbyID(Request $request, $id) {
        try {
            return response()->json(
                DB::select('SELECT * FROM temu_dokter_detail WHERE status = "W" AND idreservasi_dokter LIKE CONCAT("%", ?, "%")', [$id])
            );
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function createRekamMedis(Request $request) {
        $validated = $this->validateRekamMedis($request);
        $request->validate([
            'idreservasi_dokter' => 'required|string',
            'iddokter' => 'required|string'
        ]);

        try {
            $temu_dokter = TemuDokter::findOrFail($request->get('idreservasi_dokter'));
            $temu_dokter->update([
                'status' => 'R'
            ]);
            RekamMedis::create([
                'anamnesa' => $validated['anamnesa'],
                'temuan_klinis' => $validated['temu_klinis'],
                'diagnosa' => $validated['diagnosa'],
                'idreservasi_dokter' => $request->get('idreservasi_dokter'),
                'dokter_pemeriksa' => $request->get('iddokter')
            ]);

            return redirect()->route('rekam-medis')->with('success', 'Berhasil membuat rekam medis');
        } catch (\Exception $e) {
            return redirect()->route('create-rekam', ['id' => $request->get('idreservasi_dokter')])->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function updateRekamMedis(Request $request, $id) {
        $validated = $this->validateRekamMedis($request);
        try {
            $rekam_medis = RekamMedis::findOrFail($id);
            $rekam_medis->update([
                'anamnesa' => $validated['anamnesa'],
                'temuan_klinis' => $validated['temu_klinis'],
                'diagnosa' => $validated['diagnosa']
            ]);
            return redirect()->route('detil-rkm-medis', ['id' => $id])->with('success', 'Berhasil mengupdate rekam medis');
        } catch (\Exception $e) {
            return redirect()->route('detil-rkm-medis', ['id' => $id])->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function updateDetilRekam(Request $request, $id) {
        $validated = $this->validateDetilRekam($request);
        try {
            $detil_rekam = DetailRekamMedis::findOrFail($id);
            $detil_rekam->update([
                'idkode_tindakan_terapi' => $validated['idkode_tindakan_terapi'],
                'detail' => $validated['detail']
            ]);

            return redirect()->route('detil-rkm-medis', ['id' => $request->get('idrekam_medis')])->with('success', 'Berhasil mengupdate detil rekam medis');
        } catch (\Exception $e) {
            return redirect()->route('detil-rkm-medis', ['id' => $request->get('idrekam_medis')])->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

}
