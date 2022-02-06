<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FilepondController extends Controller
{

    private function putFile(string $filename, string $disk = 'local')
    {
        $contents = Storage::disk('local')->get('/tmp/'.$fileName);
        Storage::disk($disk)->put($filename, $contents);

        return [
            "url" => Storage::disk($disk)->url($filename)
        ];
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

    public function getfile($request){
        // index 0 = type file surat (masuk/keluar), index 1 = id file
        $type = explode('-',$request)[0];
        $id = explode('-',$request)[1];

        if($type = 'masuk')
            $suratfile=\App\SuratMasukFile::find($id);
        else if($type = 'keluar')
            $suratfile=\App\SuratKeluarFile::find($id);
            
        $pathToFile = storage_path('app/'.$suratfile->filepath.'/'.$suratfile->filename);
        
        $headers = ['Content-Disposition' => 'inline; filename='.$suratfile->filename];
        return response()->file($pathToFile, $headers);
    }

    public function revert(Request $request){
        $path = json_decode(request()->getContent());
        $this->rrmdir(storage_path('app/'.$path->filepath));
        return $path->filepath;
        // return 'revert';
    }

    public function remove($request){
        // return $filepath;
        // index 0 = type file surat (masuk/keluar), index 1 = id file
        $type = explode('-',$request)[0];
        $id = explode('-',$request)[1];

        if($type = 'masuk'){
            $suratmasukfile=\App\SuratMasukFile::find($id);
            $filepath = $suratmasukfile->filepath;
            $this->rrmdir(storage_path('app/'.$filepath));
            $suratmasukfile->delete();
        }
        else if($type = 'keluar'){
            $suratkeluarfile=\App\SuratKeluarFile::find($id);
            $suratkeluarfile->delete();
        }

        return 'sukses remove file: '.$id;

        
        // $path = json_decode(request()->getContent());
        // $this->rrmdir(storage_path('app/'.$path->filepath));
        // return $path->filepath;
        // return 'revert';
    }
    
    private function replace_extension($filename, $new_extension) {
        $info = pathinfo($filename);
        return $info['dirname']."/".$info['filename'] . '.' . $new_extension;
    }

     public function process (Request $request)
     {
        //  return $request->post();
        if($request->hasFile('upload')){
            $files = $request->file('upload');
            $folder = uniqid().'-'.now()->timestamp;
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $allowed = array('pdf', 'png', 'jpg', 'jpeg','doc', 'docx',);
                $ext = $file->getClientOriginalExtension();
                $mimetypes = $file->getClientMimeType();
                if (!in_array($ext, $allowed)) {
                    $filename = $filename.'.jpg';
                }
                $file->storeAs('tmp/'.$folder,$filename);
                // return 'tes';
            }

            $data = [
                'filename' => $filename,
                'extension' => $ext,
                'filepath' => 'tmp/'.$folder,
                'disk' => 'public',
                'mimetypes' => $mimetypes,
                'expires_at' => strval(now()->addMinutes(30))
              ];
            return json_encode($data);
            // return $filename;
        }

        return 'gagal';

     }

    
}
