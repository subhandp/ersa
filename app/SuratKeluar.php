<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suratkeluar extends Model
{
    protected $table = 'suratkeluar';
    protected $fillable = ['no_surat','tujuan_surat','isi','kode','tgl_surat','tgl_catat','keterangan','users_id'];

    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function suratkeluarfile()
    {
        return $this->hasMany('App\SuratKeluarFile');
    }


}
