<?php

namespace App\Http\Controllers;

use App\Klasifikasi;
use App\Imports\KlasifikasiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class KlasifikasiController extends Controller
{
    public function index()
    {
        $class_menu_klasifikasi = "menu-open";
        $data_klasifikasi = Klasifikasi::where('users_id', Auth::id())->get();
        return view('klasifikasi.index',compact('data_klasifikasi', 'class_menu_klasifikasi'));
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        return view('klasifikasi/create');
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'nama' => 'unique:klasifikasi|min:5',
            'kode' => 'unique:klasifikasi|max:2',
            'uraian' => 'min:5',
        ]);
       $klasifikasi = new Klasifikasi();
       $klasifikasi->nama   = $request->input('nama');
       $klasifikasi->kode   = $request->input('kode');
       $klasifikasi->uraian = $request->input('uraian');
       $klasifikasi->users_id = Auth::id();
       $klasifikasi->save();
       return redirect('/klasifikasi/index')->with("sukses", "Data Klasifikasi Berhasil Ditambahkan");
    }

    //function untuk masuk ke view edit
    public function edit ($id_klasifikasi)
    {
        $klasifikasi = Klasifikasi::where('users_id', Auth::id())->find($id_klasifikasi);
        return view('klasifikasi/edit',['klasifikasi'=>$klasifikasi]);
    }
    public function update (Request $request, $id_klasifikasi)
    {
        $request->validate([
            'nama' => 'min:5',
            'kode' => 'max:2',
            'uraian' => 'min:5',
        ]);
        $klasifikasi = Klasifikasi::where('users_id', Auth::id())->find($id_klasifikasi);
        $klasifikasi->update($request->all());
        $klasifikasi->save();
        return redirect('klasifikasi/index') ->with('sukses','Data Klasifikasi Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_klasifikasi)
    {
        $klasifikasi= Klasifikasi::where('users_id', Auth::id())->find($id_klasifikasi);
        $klasifikasi->delete();
        return redirect('klasifikasi/index') ->with('sukses','Data Klasifikasi Berhasil Dihapus');
    }

    //function untuk import excel
    // public function import(){
    //     // Excel::import(new KlasifikasiImport, 'data_klasifikasi.xls');
    //     Excel::import(new KlasifikasiImport)->import('data_klasifikasi.xls', null, \Maatwebsite\Excel\Excel::XLS);
    //     return redirect('klasifikasi/index')->with('sukses', 'Import Klasifikasi Berhasil');

    //     // Excel::import(new ImportKlasifikasi,$request->file('data_klasifikasi'));
    //     // return back()->with('sukses','Import Klasifikasi Sukses');
    //     // // dd($request->all());
    // }
}
