<?php
   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZipArchive;
use App\SuratKeluar;
use App\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

class DownloadController extends Controller
{

    private function beautify_filename($filename) {
        // reduce consecutive characters
        $filename = preg_replace(array(
            // "file   name.zip" becomes "file-name.zip"
            '/ +/',
            // "file___name.zip" becomes "file-name.zip"
            '/_+/',
            // "file---name.zip" becomes "file-name.zip"
            '/-+/'
        ), '-', $filename);
        $filename = preg_replace(array(
            // "file--.--.-.--name.zip" becomes "file.name.zip"
            '/-*\.-*/',
            // "file...name..zip" becomes "file.name.zip"
            '/\.{2,}/'
        ), '.', $filename);
        // lowercase for windows/unix interoperability http://support.microsoft.com/kb/100625
        $filename = mb_strtolower($filename, mb_detect_encoding($filename));
        // ".file-name.-" becomes "file-name"
        $filename = trim($filename, '.-');
        return $filename;
    }

    private function filter_filename($filename, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $filename);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = $this->beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function zip(Request $request)
    {
        $zip = new ZipArchive;
        
        if($request->get("type") && $request->get("id")){
            
            $type = $request->get("type");
            $id = $request->get("id");

            if($type == "masuk"){
                $surat = SuratMasuk::where('users_id', Auth::id())->find($id);
                if($surat)
                    $suratfiles = SuratMasuk::where('users_id', Auth::id())->find($id)->suratmasukfile;
                
            }
            
    
            if ($type == "keluar"){
                $surat = SuratKeluar::where('users_id', Auth::id())->find($id);
                if($surat)
                    $suratfiles = SuratKeluar::where('users_id', Auth::id())->find($id)->suratkeluarfile;
            }
            

            $fileName = $this->filter_filename($surat->no_surat).'.zip';
            
            
        }
        
        

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            foreach($suratfiles as $suratfile => $folder){
                $files = File::files(storage_path('app/'.$folder->filepath));
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }
             
            $zip->close();
        }
    
        return response()->download(public_path($fileName));
    }
}