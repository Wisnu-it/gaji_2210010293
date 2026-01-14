<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanKaryawan;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Alert;


class JabatanKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JabatanKaryawan::with(['jabatan', 'karyawan'])->get();

        return view('jabatan_karyawan.index', [
            'items' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans  = Jabatan::all();
        $karyawans = Karyawan::all();

        return view('jabatan_karyawan.tambah', compact('jabatans', 'karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'jabatan_id'    => 'required|exists:jabatan,id',
            'karyawan_id'   => 'required|exists:karyawan,id',
            'tanggal_mulai' => 'required|date',
        ]);

        JabatanKaryawan::create([
            'jabatan_id'    => $request->jabatan_id,
            'karyawan_id'   => $request->karyawan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);

        Alert::success('Sukses', 'Berhasil Menambahkan Jabatan Karyawan Baru');
        return redirect()->route('jabatan-karyawan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JabatanKaryawan $jabatanKaryawan)
    {
        $jabatans  = Jabatan::all();
        $karyawans = Karyawan::all();

        return view('jabatan_karyawan.edit', [
            'jabatanKaryawan' => $jabatanKaryawan,
            'jabatans'        => $jabatans,
            'karyawans'       => $karyawans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JabatanKaryawan $jabatanKaryawan)
    {
        $this->validate($request, [
            'jabatan_id'    => 'required|exists:jabatan,id',
            'karyawan_id'   => 'required|exists:karyawan,id',
            'tanggal_mulai' => 'required|date',
        ]);

        $jabatanKaryawan->update([
            'jabatan_id'    => $request->jabatan_id,
            'karyawan_id'   => $request->karyawan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
        ]);

        Alert::success('Sukses', 'Berhasil Mengupdate Jabatan Karyawan');
        return redirect()->route('jabatan-karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JabatanKaryawan $jabatanKaryawan)
    {
        $jabatanKaryawan->delete();

        Alert::success('Sukses', 'Berhasil Menghapus Jabatan Karyawan');
        return redirect()->route('jabatan-karyawan.index');
    }

}

