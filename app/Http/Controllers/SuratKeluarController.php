<?php

namespace App\Http\Controllers;
use App\SuratKeluar;
use App\SuratKeluarFile;
use App\Klasifikasi;
use App\Http\Controllers\Input;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;  
use Excel;
use App\Instansi;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data_suratkeluar = SuratKeluar::where('users_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        $class_menu_surat = "menu-open";
        $class_menu_surat_masuk = "";
        $class_menu_surat_keluar = "sub-menu-open";
        return view('suratkeluar.index', compact('data_suratkeluar','class_menu_surat','class_menu_surat_masuk','class_menu_surat_keluar'));


        // return view('suratkeluar.index', ['data_suratkeluar' => $data_suratkeluar]);
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
    //function untuk masuk ke view Tambah
    public function create(Request $request)
    {
        $data_klasifikasi = Klasifikasi::where('users_id', Auth::id())->get();
        if($request->get("templateid")){
            if($suratkeluar = SuratKeluar::where('users_id', Auth::id())->find($request->get("templateid"))){
                return view('suratkeluar/create',compact('suratkeluar','data_klasifikasi'));
            }
            // if(!$suratkeluar)
                
        }
        return view('suratkeluar/create',compact('data_klasifikasi'));
        
        
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
       $request->validate([
            'no_surat' => 'unique:suratkeluar|min:5',
            'isi' => 'required',
            'keterangan' => 'required',
            'tgl_surat' => 'required',
            'tgl_catat' => 'required'
       ]);
       $suratkeluar = new SuratKeluar();
       $suratkeluar->no_surat     = $request->input('no_surat');
       $suratkeluar->tujuan_surat = $request->input('tujuan_surat');
       $suratkeluar->isi          = $request->input('isi');
       $suratkeluar->kode         = $request->input('kode');
       $suratkeluar->tgl_surat    = $request->input('tgl_surat');
       $suratkeluar->tgl_catat    = $request->input('tgl_catat');
       $suratkeluar->keterangan   = $request->input('keterangan');
       $suratkeluar->users_id = Auth::id();
       $suratkeluar->save();

       if($request->input('upload')){
        foreach($request->input('upload') as $uploads){
            $upload = json_decode($uploads, true);
            // return gettype($upload);
            //ganti path tmp dengan public path
            $finalpath = $upload['disk'].'/'.explode('/',$upload['filepath'])[1];
            $record = ['filename' => $upload['filename'], 'filepath' => $finalpath,
            'extension' => $upload['extension'], 'mimetypes' => $upload['mimetypes'],
            'disk' => $upload['disk'], 'expires_at' => $upload['expires_at'],
            'suratkeluar_id' => $suratkeluar->id ];
            SuratKeluarFile::create($record);

            // pindahkan file upload di tmp folder ke final path (public)
            File::moveDirectory(storage_path('app/'.$upload['filepath']), storage_path('app/'.$finalpath));
        }

    }

        $link = url("/suratkeluar/{$suratkeluar->id}/edit");
        return redirect('/suratkeluar/index')->with("sukses", $link);
    }

    //function untuk melihat file
    // public function tampil($id_suratkeluar)
    // {
    //     $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
    //     $fileIsPdf = str_contains($suratkeluar->filekeluar, '.pdf');
    //     return view('suratkeluar/tampil',compact('fileIsPdf', 'suratkeluar'));
    // }

    //function untuk download file
    // public function downfunc(){

    //     $downloads=DB::table('suratkeluar')->get();
    //     return view('suratkeluar.tampil',compact('downloads'));
    // }

    // public function agendakeluardownload_excel(){
    //     $suratkeluar = SuratKeluar::select('id', 'isi', 'tujuan_surat', 'kode', 'no_surat', 'tgl_surat', 'tgl_catat', 'keterangan')->get();
    //     return Excel::create('Agenda_Surat_Keluar', function($excel) use ($suratkeluar){
    //         $excel->sheet('Agenda_Surat_Keluar',function($sheet) use ($suratkeluar){
    //             $sheet->fromArray($suratkeluar);
    //         });
    //     })->download('xls');
    // }

    //function untuk ke view edit
    public function edit ($id_suratkeluar)
    {
        $class_menu_surat = "menu-open";
        $class_menu_surat_masuk = "";
        $class_menu_surat_keluar = "sub-menu-open";

        $data_klasifikasi = Klasifikasi::where('users_id', Auth::id())->get();
        $suratkeluar = SuratKeluar::where('users_id', Auth::id())->find($id_suratkeluar);
        $suratfiles = SuratKeluar::where('users_id', Auth::id())->find($id_suratkeluar)->suratkeluarfile;
        $type = 'keluar';
        return view('suratkeluar/edit',compact('class_menu_surat', 'class_menu_surat_masuk', 'class_menu_surat_keluar', 'type','suratfiles','suratkeluar','data_klasifikasi'));
    }
    public function update (Request $request, $id_suratkeluar)
    {
        $request->validate([
            'filekeluar' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratkeluar = SuratKeluar::where('users_id', Auth::id())->find($id_suratkeluar);
        $suratkeluar->update($request->all());
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
                    'suratkeluar_id' => $id_suratkeluar];
                    SuratKeluarFile::create($record);

                    // pindahkan file upload di tmp folder ke final path (public)
                    File::moveDirectory(storage_path('app/'.$upload['filepath']), storage_path('app/'.$finalpath));
                }
                
            }

        }

        return redirect('suratkeluar/'.$id_suratkeluar.'/edit') ->with('sukses','Data Surat Keluar Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_suratkeluar)
    {
        $suratkeluar= SuratKeluar::where('users_id', Auth::id())->find($id_suratkeluar);
        $suratfiles = SuratKeluar::where('users_id', Auth::id())->find($id_suratkeluar)->suratkeluarfile;
        foreach($suratfiles as $suratfile => $folder){
            $suratfile=\App\SuratKeluarFile::find($folder->id);
            $suratfile->delete();
            $path = storage_path('app/'.$folder->filepath);
            $this->rrmdir($path);
        }
        $suratkeluar->delete();
        return redirect('suratkeluar/index') ->with("sukseshapus","Data Surat Keluar Berhasil Dihapus. No {$suratkeluar->no_surat} ");
    }

     //Function Untuk Agenda Surat keluar
    //  public function agenda(Request $request)
    //  {
    //     $data_suratkeluar = \App\SuratKeluar::all();
    //     $class_menu_agenda = "menu-open";
    //     $class_menu_agenda_surat_masuk = "";
    //     $class_menu_agenda_surat_keluar = "sub-menu-open";
    //     return view('suratkeluar.agenda', compact('data_suratkeluar','class_menu_agenda','class_menu_agenda_surat_masuk','class_menu_agenda_surat_keluar'));
    //  }

    //  public function agendakeluarcetak_pdf()
    //  {
    //     $inst = Instansi::first();
    //      $suratkeluar = SuratKeluar::all();
    //      $pdf = PDF::loadview('suratkeluar.cetakagendaPDF', compact('inst','suratkeluar'));
    //      return $pdf->stream();
    //  }


    // public function galeri(Request $request)
    // {
    //     $data_suratkeluar = \App\SuratKeluar::all();
    //     $class_menu_galeri = "menu-open";
    //     $class_menu_galeri_surat_masuk = "";
    //     $class_menu_galeri_surat_keluar = "sub-menu-open";
    //     $fileIsPdf = false;
    //     // $fileIsPdf = str_contains($suratkeluar->filekeluar, '.pdf');
    //     // foreach ($data_suratkeluar as $p) {
    //     //     echo $p->sku;
    //     //     }
    //     return view('suratkeluar.galeri', compact('fileIsPdf','data_suratkeluar','class_menu_galeri','class_menu_galeri_surat_masuk','class_menu_galeri_surat_keluar'));

    //     // return view('suratkeluar.galeri',['data_suratkeluar'=> $data_suratkeluar]);
    // }

}
