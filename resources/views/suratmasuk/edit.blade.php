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
        <form action="/suratmasuk/{{$suratmasuk->id}}/update" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Edit Surat Masuk</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input name="no_surat" type="text" class="form-control bg-light" id="nomorsurat"
                        placeholder="Nomor Surat" value="{{$suratmasuk->no_surat}}" required>
                    <label for="asalsurat">Asal Surat</label>
                    <input name="asal_surat" type="text" class="form-control bg-light" id="asalsurat"
                        placeholder="Asal Surat" value="{{$suratmasuk->asal_surat}}" required>
                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3"
                        placeholder="Isi Ringkas Surat Masuk" value="{{$suratmasuk->isi}}"
                        required>{{$suratmasuk->isi}}</textarea>
                    <label for="kode">Kode Klasifikasi</label>
                    <select name="kode" class="custom-select my-1 mr-sm-2 bg-light" id="kode"
                        value="{{$suratmasuk->kode}}" required>
                        <option selected>{{$suratmasuk->kode}}</option>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->kode}}">{{$klasifikasi->nama}} ( {{$klasifikasi->kode}} )
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input name="tgl_surat" type="date" class="form-control bg-light" id="tglsurat"
                        value="{{$suratmasuk->tgl_surat}}" required>
                    <label for="tglditerima">Tanggal Diterima</label>
                    <input name="tgl_terima" type="date" class="form-control bg-light" id="tglditerima"
                        value="{{$suratmasuk->tgl_terima}}" required>
                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control bg-light" id="keterangan"
                        placeholder="Keterangan" value="{{$suratmasuk->keterangan}}" required>
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
           
            
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/suratmasuk/index" role="button"><i class="fas fa-undo"></i>
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
                // xhr.onload = function(){
                //     const removeItemButtons = document.querySelectorAll('.filepond--action-remove-item');
                //     removeItemButtons.forEach(removeItemButton => {
                //         removeItemButton.disabled = false;
                //     });
                // }
                xhr.onloadend = function (response) {
                    
                    load();
                    // console.log(response);
                    // const removeItemButtons = document.querySelectorAll('.filepond--action-remove-item');
                    // removeItemButtons.forEach(removeItemButton => {
                    //     removeItemButton.disabled = true;
                    // });
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

