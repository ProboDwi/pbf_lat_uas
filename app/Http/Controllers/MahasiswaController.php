<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/mahasiswa');
        $mahasiswa = $response->json();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $response = Http::asForm()->post('http://localhost:8080/mahasiswa', [
            'npm' => $request->npm,
            'id_user' => $request->id_user,
            'id_dosen' => $request->id_dosen,
            'id_kajur' => $request->id_kajur,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'angkatan' => $request->angkatan,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        //  dd($response->status(), $response->body());

        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:8080/mahasiswa/{$id}", [
            'npm' => $request->npm,
            'id_user' => $request->id_user,
            'id_dosen' => $request->id_dosen, 
            'id_kajur' => $request->id_kajur,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'angkatan' => $request->angkatan,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete('http://localhost:8080/mahasiswa/' . $id);
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa gagal dihapus');
        }
    }
}
