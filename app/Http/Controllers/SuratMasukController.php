<?php

namespace App\Http\Controllers;
use App\SuratMasuk;
use App\SuratMasukFile;
use App\Instansi;
use App\Klasifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;


class SuratmasukController extends Controller
{

   
    public function index()
    {
        $data_suratmasuk = SuratMasuk::where('users_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        $class_menu_surat = "menu-open";
        $class_menu_surat_masuk = "sub-menu-open";
        $class_menu_surat_keluar = "";

        return view('suratmasuk.index', compact('data_suratmasuk','class_menu_surat','class_menu_surat_masuk','class_menu_surat_keluar'));

        // return view('suratmasuk.index',['data_suratmasuk'=> $data_suratmasuk]);
    }

    //function untuk masuk ke view Tambah
   

    public function create(Request $request)
    {
        $data_klasifikasi = Klasifikasi::where('users_id', Auth::id())->get();
        if($request->get("templateid")){
            if($suratmasuk = SuratMasuk::where('users_id', Auth::id())->find($request->get("templateid"))){
                return view('suratmasuk/create',compact('suratmasuk','data_klasifikasi'));
            }
        }
        return view('suratmasuk/create',compact('data_klasifikasi'));
        
        
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        //  return $request->post(); 
        $request->validate([
            // 'filemasuk.*'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat'   => 'unique:suratmasuk|min:5',
            'isi'        => 'required',
            'asal_surat' => 'required',
            'kode' => 'required',
            'tgl_surat' => 'required',
            'tgl_terima' => 'required'
        ]);

        $suratmasuk = new SuratMasuk();
        $suratMasukFile = new SuratMasukFile();

        $suratmasuk->no_surat   = $request->input('no_surat');
        $suratmasuk->asal_surat = $request->input('asal_surat');
        $suratmasuk->isi        = $request->input('isi');
        $suratmasuk->kode       = $request->input('kode');
        $suratmasuk->tgl_surat  = $request->input('tgl_surat');
        $suratmasuk->tgl_terima = $request->input('tgl_terima');
        $suratmasuk->keterangan = $request->input('keterangan');
        $suratmasuk->users_id = Auth::id();
        $suratmasuk->save();
        
        // $records = [];
        if($request->input('upload')){
            foreach($request->input('upload') as $uploads){
                $upload = json_decode($uploads, true);
                // return gettype($upload);
                //ganti path tmp dengan public path
                $finalpath = $upload['disk'].'/'.explode('/',$upload['filepath'])[1];
                $record = ['filename' => $upload['filename'], 'filepath' => $finalpath,
                'extension' => $upload['extension'], 'mimetypes' => $upload['mimetypes'],
                'disk' => $upload['disk'], 'expires_at' => $upload['expires_at'],
                'suratmasuk_id' => $suratmasuk->id ];
                SuratMasukFile::create($record);

                // pindahkan file upload di tmp folder ke final path (public)
                File::moveDirectory(storage_path('app/'.$upload['filepath']), storage_path('app/'.$finalpath));
            }

        }

        
        $link = url("/suratmasuk/{$suratmasuk->id}/edit");
        // $linktosurat = "<a href='{$link}'>Disini</a>";
        return redirect('/suratmasuk/index')->with("sukses", $link);
     }

    //function untuk melihat file
    // public function tampil($id_suratmasuk)
    // {
    //     $suratmasuk = \App\SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk);
    //     $fileIsPdf = str_contains($suratmasuk->filemasuk, '.pdf');
    //     return view('suratmasuk/tampil',compact('fileIsPdf','suratmasuk'));
    // }

    //function untuk download file
    // public function downfunc(){

    //     $downloads=DB::table('suratmasuk')->get();
    //     return view('suratmasuk.tampil',compact('downloads'));
    // }

    //function untuk masuk ke view edit
    public function edit ($id_suratmasuk)
    {
        $class_menu_surat = "menu-open";
        $class_menu_surat_masuk = "sub-menu-open";
        $class_menu_surat_keluar = "";

        $data_klasifikasi = Klasifikasi::where('users_id', Auth::id())->get();
        $suratmasuk = SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk);
        $suratfiles = SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk)->suratmasukfile;
        $type = 'masuk';
        return view('suratmasuk/edit',compact('class_menu_surat', 'class_menu_surat_masuk', 'class_menu_surat_keluar', 'type','suratfiles','suratmasuk','data_klasifikasi'));
    }

    public function update (Request $request, $id_suratmasuk)
    {
        //  return $request->post(); 
        $request->validate([
            'filemasuk' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratmasuk = SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk);
        $suratmasuk->update($request->all());
        //Untuk Update File
        
        if($request->input('upload')){
            foreach($request->input('upload') as $uploads){
                $upload = json_decode($uploads, true);
                // return gettype($upload);
                //ganti path tmp dengan public path
                if(isset($upload['filepath'])){
                    $finalpath = $upload['disk'].'/'.explode('/',$upload['filepath'])[1];
                    $record = ['filename' => $upload['filename'], 'filepath' => $finalpath,
                    'extension' => $upload['extension'], 'mimetypes' => $upload['mimetypes'],
                    'disk' => $upload['disk'], 'expires_at' => $upload['expires_at'],
                    'suratmasuk_id' => $id_suratmasuk];
                    SuratMasukFile::create($record);

                    // pindahkan file upload di tmp folder ke final path (public)
                    File::moveDirectory(storage_path('app/'.$upload['filepath']), storage_path('app/'.$finalpath));
                }
                
            }

        }
        

        return redirect('suratmasuk/'.$id_suratmasuk.'/edit') ->with('sukses','Data Surat Masuk Berhasil Diedit');
    }

    private function rrmdir($dir)
    {
        if (is_dir($dir))
        {
        $objects = scandir($dir);

        foreach ($objects as $object)
        {
            if ($object != '.' && $object != '..')
            {
                if (filetype($dir.'/'.$object) == 'dir') {rrmdir($dir.'/'.$object);}
                else {unlink($dir.'/'.$object);}
            }
        }

        reset($objects);
        rmdir($dir);
        }
    }

    //function untuk hapus
    public function delete($id_suratmasuk)
    {
        $suratmasuk= SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk);
        $suratfiles = SuratMasuk::where('users_id', Auth::id())->find($id_suratmasuk)->suratmasukfile;
        foreach($suratfiles as $suratfile => $folder){
            $suratfile=\App\SuratMasukFile::find($folder->id);
            $suratfile->delete();
            $path = storage_path('app/'.$folder->filepath);
            $this->rrmdir($path);
        }
        $suratmasuk->delete();
        return redirect('suratmasuk/index') ->with("sukseshapus","Data Surat Masuk Berhasil Dihapus. No {$suratmasuk->no_surat} ");
    }
   
}
