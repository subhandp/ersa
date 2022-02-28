@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/suratkeluar/{{$suratkeluar->id}}/update" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Edit Surat Keluar</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input name="no_surat" type="text" class="form-control bg-light" id="nomorsurat"
                        placeholder="Nomor Surat" value="@if($suratkeluar){{$suratkeluar->no_surat}}@endif" required>
                    <label for="asalsurat">Tujuan Surat</label>
                    <input name="tujuan_surat" type="text" class="form-control bg-light" id="tujuansurat"
                        placeholder="Tujuan Surat" value="{{$suratkeluar->tujuan_surat}}" required>
                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3"
                        placeholder="Isi Ringkas Surat Keluar" value="{{$suratkeluar->isi}}"
                        required>{{$suratkeluar->isi}}</textarea>
                    <label for="kode">Kode Klasifikasi</label>
                    <select name="kode" class="custom-select my-1 mr-sm-2 bg-light" id="kode"
                        value="{{$suratkeluar->kode}}" required>
                        <option selected>{{$suratkeluar->kode}} </option>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->kode}}">{{$klasifikasi->nama}} ( {{$klasifikasi->kode}} )
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input name="tgl_surat" type="date" class="form-control bg-light" id="tglsurat"
                        value="{{$suratkeluar->tgl_surat}}" required>
                    <label for="tglditerima">Tanggal Catat</label>
                    <input name="tgl_catat" type="date" class="form-control bg-light" id="tglcatat"
                        value="{{$suratkeluar->tgl_catat}}" required>
                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control bg-light" id="keterangan"
                        placeholder="Keterangan" value="{{$suratkeluar->keterangan}}" required>

                </div>


                <div class="col-12">
                    <div class="form-group">
                            <label for="scan">Scan berkas</label>
                            <div class="container">
                                <div class="row" id="th_container">
                                    <div class="col-md-12 mb-1 text-secondary" id="th_container_empty">No scanned images</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="btn-scan">Scan</button>
                                        <button class="btn btn-success" id="btn-upload" style="display:none;">Upload image(s)</button>
                                        <p class="text-danger mt-1" id="download-app" style="display:none;">Aplikasi Scan tidak ditemukan. Tolong download, install kemudian buka aplikasi dan refresh browser
                <a href="{{url('/Scan_App_SetUp.msi')}}" download>Download File</a></p>
                                        <br><br>
                                    </div>
                                </div>

                            </div>

                            <input name="upload[]" type="file" id="upload"  multiple/>  
                    </div>
                </div>

            </div>
            <a href="/download/zip?type=keluar&id={{$suratkeluar->id}}" class="btn btn-default btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-download"></i> Download semua file</a>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/suratkeluar/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>

    </div>

    
</section>
@endsection


@section('file-pond-edit')
<!-- edit -->
<script>


    FilePond.setOptions({
        files: [
            @foreach($suratfiles as $suratfile) 
               
                {
                    source:  '{{ $type }}-{{ $suratfile->id }}',
                    options: {
                        type: "local",
                    },
                },
            @endforeach
                
            
            ],
        server: {
            load: '/filepond/getfile/',
            process:  '/filepond/process',
            revert: '/filepond/revert',
            remove: (src, load) => {
                console.log("remove", src);
                const xhr = new XMLHttpRequest();
                xhr.onloadend = function (response) {
                    load();
                };
                xhr.open('GET', '/filepond/remove/' + src);
                xhr.send();
                
            },
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            }
        }
    });

</script>
@endsection

