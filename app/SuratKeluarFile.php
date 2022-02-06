<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluarFile extends Model
{
    protected $table = 'suratkeluar_files';
    protected $fillable = ['suratkeluar_id', 'filepath', 'filename', 'extension', 'mimetypes', 'disk', 'expires_at'];

        //function relasi ke disposisi
        public function suratkeluar()
        {
            return $this->belongsTo('App\SuratKeluar');
        }

}
