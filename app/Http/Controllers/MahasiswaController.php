<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $mahasiswas = Mahasiswa::where('Nama', 'like', '%'.$search.'%')->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'Kelas' => 'required',
                'Jurusan' => 'required',
                'No_Handphone' => 'required',
                'Email' => 'required',
                'Tanggal_lahir' => 'required',
            ]);
            
            //fungsi eloquent untuk menambah data
            Mahasiswa::create($request->all());
            
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
   
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::where('Nim', $Nim)->first();
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::where('Nim', $Nim)->first();
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
                $request->validate([
                    'Nim' => 'required',
                    'Nama' => 'required',
                    'Kelas' => 'required',
                    'Jurusan' => 'required',
                    'No_Handphone' => 'required',
                    'Email' => 'required',
                    'Tanggal_lahir' => 'required',
                ]);
        //fungsi eloquent untuk mengupdate data inputan kita
                $data = $request->except(['_token', '_method']);
                Mahasiswa::where('Nim', $Nim)->update($data);
        //jika data berhasil diupdate, akan kembali ke halaman utama
                return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::where('Nim', $Nim)->delete();
        return redirect()->route('mahasiswas.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
};
