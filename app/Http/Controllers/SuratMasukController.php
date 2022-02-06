<?php

namespace App\Http\Controllers;
use App\SuratMasuk;
use App\SuratMasukFile;
use App\Instansi;
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
        $data_suratmasuk = SuratMasuk::all();
        $class_menu_surat = "menu-open";
        $class_menu_surat_masuk = "sub-menu-open";
        $class_menu_surat_keluar = "";

        return view('suratmasuk.index', compact('data_suratmasuk','class_menu_surat','class_menu_surat_masuk','class_menu_surat_keluar'));

        // return view('suratmasuk.index',['data_suratmasuk'=> $data_suratmasuk]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        return view('suratmasuk/create', ['data_klasifikasi' => $data_klasifikasi]);
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
    public function tampil($id_suratmasuk)
    {
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
        $fileIsPdf = str_contains($suratmasuk->filemasuk, '.pdf');
        return view('suratmasuk/tampil',compact('fileIsPdf','suratmasuk'));
    }

    //function untuk download file
    public function downfunc(){

        $downloads=DB::table('suratmasuk')->get();
        return view('suratmasuk.tampil',compact('downloads'));
    }

    public function agendamasukdownload_excel(){
        $suratmasuk = \App\SuratMasuk::select('id', 'isi', 'asal_surat', 'kode', 'no_surat', 'tgl_surat', 'tgl_terima', 'keterangan')->get();
        return Excel::create('Agenda_Surat_Masuk', function($excel) use ($suratmasuk){
            $excel->sheet('Agenda_Surat_Masuk',function($sheet) use ($suratmasuk){
                $sheet->fromArray($suratmasuk);
            });
        })->download('xls');
    }

    //function untuk masuk ke view edit
    public function edit ($id_suratmasuk)
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        $suratmasuk = SuratMasuk::find($id_suratmasuk);
        $suratfiles = SuratMasuk::find($id_suratmasuk)->suratmasukfile;
        $type = 'masuk';
        return view('suratmasuk/edit',compact('type','suratfiles','suratmasuk','data_klasifikasi'));
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
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
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

    //function untuk hapus
    public function delete($id_suratmasuk)
    {
        $suratmasuk=\App\SuratMasuk::find($id_suratmasuk);
        $suratmasuk->delete();
        return redirect('suratmasuk/index')->with('sukses','Data Surat Masuk Berhasil Dihapus');
    }

    //Function Untuk Agenda Surat Masuk
    public function agenda(Request $request)
    {
        $data_suratmasuk = \App\SuratMasuk::all();
        $class_menu_agenda = "menu-open";
        $class_menu_agenda_surat_masuk = "sub-menu-open";
        $class_menu_agenda_surat_keluar = "";
        return view('suratmasuk.agenda', compact('data_suratmasuk','class_menu_agenda','class_menu_agenda_surat_masuk','class_menu_agenda_surat_keluar'));
    }

    //Function Untuk Download Agenda Surat Masuk
    public function agendamasukcetak_pdf(Request $request)
    {
        $inst = Instansi::first();
        $suratmasuk = SuratMasuk::all();
        $data = ['title' => 'Welcome to belajarphp.net'];

        $pdf = PDF::loadview('suratmasuk.cetakagendaPDF', compact('suratmasuk', 'inst'));
        return $pdf->stream();
    }

    //Function Untuk Galeri Surat Masuk
    public function galeri(Request $request)
    {
        $data_suratmasuk = \App\SuratMasuk::all();
        $class_menu_galeri = "menu-open";
        $class_menu_galeri_surat_masuk = "sub-menu-open";
        $class_menu_galeri_surat_keluar = "";
        $fileIsPdf = false;
        return view('suratmasuk.galeri', compact('fileIsPdf','data_suratmasuk','class_menu_galeri','class_menu_galeri_surat_masuk','class_menu_galeri_surat_keluar'));

    //    return view('suratmasuk.galeri',['data_suratmasuk'=> $data_suratmasuk]);
    }
}
