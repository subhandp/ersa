@extends('layouts.master')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    Data Surat Keluar Berhasil Ditambahkan <a href="{{session('sukses')}}">Lihat</a>
                </div>
                @endif

                @if(session('sukseshapus'))
                <div class="alert alert-success" role="alert">
                    {{session('sukseshapus')}}
                </div>
                @endif
            <div class="row">
                <div class="col">
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Surat Keluar</h3>
                <hr>
            </div>
            </div>
            <div>
                <div class="col">
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                    <br>
                </div>
            </div>
            <div class="row table-responsive">
                <div class="col">
                <table class="table table-hover table-head-fixed" id="tabelSuratkeluar" style="width:100%">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Isi Ringkas</th>
                        <th>Tujuan Surat</th>
                        <th>Kode</th>
                        <th>No. Surat</th>
                        <th>Tgl. Surat</th>
                        <th>Tgl. Catat</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($data_suratkeluar as $suratkeluar)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$suratkeluar->isi}}</td>
                            <td>{{$suratkeluar->tujuan_surat}}</td>
                            <td>{{$suratkeluar->kode}}</td>
                            <td>{{$suratkeluar->no_surat}}</td>
                            <td>{{$suratkeluar->tgl_surat}}</td>
                            <td>{{$suratkeluar->tgl_catat}}</td>
                            <td>{{$suratkeluar->keterangan}}</td>
                            <td>
                                <a href="/suratkeluar/{{$suratkeluar->id}}/edit" class="btn btn-success btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-pencil-alt"></i> Edit / Lihat</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/suratkeluar/{{$suratkeluar->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                                @endif
                                <a href="/suratkeluar/create?templateid={{$suratkeluar->id}}" class="btn btn-default btn-sm my-1 mr-sm-1 btn-block">duplikat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>
 @endsection

