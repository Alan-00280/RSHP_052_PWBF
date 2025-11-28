<?php

namespace App\Http\Controllers;

use App\Models\jenisHewan;
use App\Models\Kategori;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\rasHewan;
use App\Models\UserRshp;
use App\View\Components\functionCard;
use Carbon\Carbon;
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

}
