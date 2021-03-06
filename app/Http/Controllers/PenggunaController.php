<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $pengguna)
    {
        $data_pengguna = $pengguna->all();
        $class_menu_pengaturan = "menu-open";
        $class_menu_pengaturan_pengguna = "sub-menu-open";
        $class_menu_pengaturan_instansi = "";
        return view('pengguna.index', compact('data_pengguna','class_menu_pengaturan','class_menu_pengaturan_pengguna','class_menu_pengaturan_instansi'));

        // return view('pengguna.index', compact('data_pengguna'));
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',

        ]);

        $pengguna = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'account_year' => 2021,
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pengguna= User::findorfail($id);
        return view('pengguna.edit', compact('data_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengguna = User::findorfail($id);

        $this->validate($request, [
            'username' => 'required',
            'name' => 'required|min:5',
            'email' => 'required|email',
        ]);

        $data_pengguna = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
        ];

        $pengguna->update($data_pengguna);

        return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pengguna = User::findorfail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('sukses','Data Berhasil di Hapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('sukses','Maaf, Masih ada data yang terpaut dengan user ini.');
        }
    }
}
