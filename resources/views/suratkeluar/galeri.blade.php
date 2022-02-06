@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-images my-1 btn-sm-1"></i> Galeri Surat Keluar</h3>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <div>
                    <div class="filter-container p-0 row">
                        <?php $no = 0;?>
                        @foreach($data_suratkeluar as $suratkeluar)
                        <?php $no++ ;?>
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <a href="{{URL::to('/')}}/datasuratkeluar/{{$suratkeluar->filekeluar}}"
                                        data-toggle="lightbox" data-title="Perbesar Gambar">
                                        @if ($fileIsPdf)
                                        <center>
                                        <img src="{{URL::to('/')}}/general/pdf-icon.jpg"
                                                width="100" height="150"
                                                alt="PDF is not loaded">
                                        </center>
                                        @else
                                        <center>
                                            <img src="{{URL::to('/')}}/datasuratkeluar/{{$suratkeluar->filekeluar}}"
                                                width="100" height="150"
                                                alt="Klik Lihat Detail File">
                                        </center>
                                        @endif
                                        
                                    </a>
                                </div>
                                <a href="/suratkeluar/{{$suratkeluar->id}}/tampil"
                                    class="small-box-footer bg-success">Lihat Detail File <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <small class="text-danger">
                    <b>Catatan : </b>File .doc, .docx, atau .pdf tidak dapat ditampilkan disini silahkan klik <b>Lihat
                        Detail File</b> !!!
                </small>
            </div>
        </div>
    </div>
    </div>
    @endsection
