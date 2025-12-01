<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class validationController extends Controller
{
    protected function validateJenisHewan(Request $request, $id = null) {
        $uniqueRule = $id ? 'unique:jenis_hewan,nama_jenis_hewan,'.$id.',idjenis_hewan' : 'unique:jenis_hewan,nama_jenis_hewan';
        return $request->validate([
            "nama_jenis_hewan" => [
                'string',
                'required',
                'max:255',
                'min:3',
                $uniqueRule
            ]
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan tidak boleh kosong',
            'nama_jenis_hewan.string' => 'Nama jenis hewan hanya berisi teks',
            'nama_jenis_hewan.max' => 'Nama jenis hewan tidak melebihi 255 karakter',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);
    }
    
    protected function validatePatchPet(Request $request) {
        return $request->validate([
            'nama' => 'string|min:3|required|max:255',
            'tanggal_lahir' => 'date|required',
            'warna_tanda' => 'string|min:3|required|max:255',
            'jenis_kelamin' => 'string|size:1|required'
        ]);
    }

    protected function validatePetCreate(Request $request) {
        return $request->validate([
            'nama_pet' => 'string|min:3|required|max:255',
            'idJenis' => 'string|required',
            'idRas' => 'string|required',
            'datepick' => 'date|required',
            'warna_jenis' => 'string|min:3|required|max:50',
            'kelamin' => 'string|size:1|required'
        ]);
    }

    protected function validatePemilik(Request $request, $id=null) {
        $uniqueRuleNama = $id ? 'unique:user,nama,'.$id.'iduser' : 'unique:user,nama';
        $uniqueRuleEmail = $id ? 'unique:user,email,'.$id.'iduser' : 'unique:user,email';
        return $request->validate([
            'nama' => 'string|min:3|required|max:255|'.$uniqueRuleNama,
            'email' => 'email|required|'.$uniqueRuleEmail,
            'no_wa' => 'required|digits_between:10,14',
            'alamat' => 'required|min:3|max:255|string',
        ]);
    }

    protected function validateTindakan(Request $request) {
        return $request->validate([
            'deskripsi_tindakan_terapi' => 'min:3|required|max:255|string',
            'idkategori' => 'string|required',
            'idkategori_klinis' => 'string|required',
        ]);
    }

    protected function validateRekamMedis(Request $request) {
        return $request->validate([
            'anamnesa' => 'required|min:3|max:365|string',
            'temu_klinis' => 'required|min:3|max:365|string',
            'diagnosa' => 'required|min:3|max:365|string'
        ]);
    }

    protected function validateDetilRekam(Request $request) {
        return $request->validate([
            'idkode_tindakan_terapi' => 'required|string',
            'detail' => 'required|min:3|max:255|string'
        ]);
    }
}
