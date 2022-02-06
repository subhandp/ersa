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
        <form action="/suratmasuk/tambah" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tambah Data Surat Masuk</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input value="{{old('no_surat')}}" name="no_surat" type="text" class="form-control bg-light"
                        id="nomorsurat" placeholder="Nomor Surat" required>
                    <label for="asalsurat">Asal Surat</label>
                    <input value="{{old('asal_surat')}}" name="asal_surat" type="text" class="form-control bg-light"
                        id="asalsurat" placeholder="Asal Surat" required>
                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3"
                        placeholder="Isi Ringkas Surat Masuk" required>{{old('isi')}}</textarea>
                    <label for="kode">Kode Klasifikasi</label>
                    <select name="kode" class="custom-select my-1 mr-sm-2 bg-light" id="inlineFormCustomSelectPref"
                        required>
                        <option value="">-- Pilih Klasifikasi Surat --</option>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->kode}}">{{$klasifikasi->nama}} ( {{$klasifikasi->kode}} )
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input value="{{old('tgl_surat')}}" name="tgl_surat" type="date" class="form-control bg-light"
                        id="tglsurat" required>
                    <label for="tglditerima">Tanggal Diterima</label>
                    <input value="{{old('tgl_terima')}}" name="tgl_terima" type="date" class="form-control bg-light"
                        id="tglditerima" required>
                    <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light"
                        id="keterangan" placeholder="Keterangan" required>
                    

                </div>
                <div class="col-12">
                

                <div class="form-group">
                        <!-- <label for="exampleFormControlFile1">File</label>
                        <input name="filemasuk[]" type="file" class="form-control-file" id="exampleFormControlFile1" multiple required>
                        <small id="exampleFormControlFile1" class="text-danger">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small> -->
                    </div>

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
                                    <p class="text-danger mt-1" id="download-app" style="display:none;">No Scan app application found in your machine. Please download, install and open first then refresh the browser. <a href="Scan_App_SetUp.msi" download>Download app</a></p>
                                    <p class="mt-3">This expample shows how to make preview scanned images, rotate images if necessary and upload images to the server.</p>
                                </div>
                            </div>

                        </div>

                        <input name="upload[]" type="file" id="upload"  multiple/>

                        
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>



    </div>
    </div>
</section>
@endsection


@section('file-pond-create')
<script>
    FilePond.setOptions({
        server: {
            process:  '/filepond/process',
            revert: '/filepond/revert',
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            }
        },
        
    });
</script>
@endsection
