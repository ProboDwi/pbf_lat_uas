<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/dosen');
        $dosen = $response->json();
        return view('dosen.index', compact('dosen'));
    }

    public function store(Request $request)
    {
        $response = Http::asForm()->post('http://localhost:8080/dosen', [
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'id_user' => $request->id_user
        ]);

        //  dd($response->status(), $response->body());

        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        } else {
            return redirect()->route('dosen.index')->with('error', 'Dosen gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:8080/dosen/{$id}", [
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'id_user' => $request->id_user,
        ]);

        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate');
        } else {
            return redirect()->route('dosen.index')->with('error', 'Dosen gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete('http://localhost:8080/dosen/' . $id);
        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
        } else {
            return redirect()->route('dosen.index')->with('error', 'Dosen gagal dihapus');
        }
    }

    public function exportPdfPerData($id)
    {
        $response = Http::get("http://localhost:8080/dosen/$id");

        if (!$response->successful()) {
            abort(404, 'Data dosen tidak ditemukan');
        }

        $data = $response->json();

        $dosen = $data[0];

        // Ambil elemen pertama dari array
        // $dosen = $data[0] ?? null;

        // if (!$dosen) {
        //     abort(404, 'Data dosen kosong');
        // }

        $pdf = Pdf::loadView('dosen.export_single', compact('dosen'));
        return $pdf->download('dosen_' . $dosen['nidn'] . '.pdf');
    }
}
