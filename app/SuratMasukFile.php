<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratMasukFile extends Model
{
    protected $table = 'suratmasuk_files';
    protected $fillable = ['suratmasuk_id', 'filepath', 'filename', 'extension', 'mimetypes', 'disk', 'expires_at'];

    //function relasi ke disposisi
    public function suratmasuk()
    {
        return $this->belongsTo('App\SuratMasuk');
    }

}
