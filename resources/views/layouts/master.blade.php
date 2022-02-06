<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eRSA Bimas Hindu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
    <!-- DataTable -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <link rel="stylesheet" href="/adminlte/css/sidebar-menu-feature.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous"> -->
 
    <!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
    <!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
    
    <!-- the fileinput plugin styling CSS file -->
    <!-- <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> -->

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
        rel="stylesheet"
    />

    <link
    href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css"
    rel="stylesheet"
/>

<link
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"
    rel="stylesheet"
/>


    <style>
		.ex_caption {
			font-weight: 300;
		}
		.th_rotate {
			position: absolute;
			top: 40%;
			left: 50%;
			margin: -16px 0 0 -16px;
			width: 32px;
			height: 32px;
			cursor: pointer;
			background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAACBjSFJN AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAC2VBMVEX////r7+oeHx4dHR0i IiIcHRwlJiUmJiYcHBwbHBsoKSgbGxsZGRkgICAZGhkYGBgfIB8YGRgXGBcfHx8aGhoXFxceHh4W FxYWFhYVFhUVFRUUFRQUFBQTExMTFBMSExISEhIREREQERAREhEQEBAgICAeHx4wMDAqKiogICBA QEAuLi4jJCMeHh5ERUQnKCcfHx9DREMrLCshISEdHh0gISAjIyMlJSUkJSQeHh4dHh0iIiIqKiog ICAfIB8oKSgiIiIgISCipKEfIB/U2NPr7+orKyvj5+Lr7+owMTDO0s3r7+rr7+o/QD/r7+rr7+oe Hh4tLi3o7Ofr7+o7PDvFycTr7+o8PTzZ3djr7+o6Ozrc4Nvr7+pAQT+EhoPr7+o5Ojno7Oc1NjWl p6RBQkHr7+rQ1M/R1dDr7+odHh2ZnJg2NzZXWFZAQUAWFxYaGhoZGhl1d3QrLSsXGBcnJydjZWO4 u7ciIyIYGBifoZ4YGRgTFBMWFhYjJCPj5+LFyMQaGhoUFRQTFBMXFxerrqrr7+qWmZYYGRgXFxcX FxcXGBfr7+rn6+br7+rr7+rr7+rJzcjr7+rr7+rr7+rr7+rr7+rr7+rr7+rr7+rr7+o4OThCQ0I8 PTwxMjFERUQ/QD82NzYlJiUtLS07PDtDRENBQUE5OjkvLy8oKSg0NTQ3ODdAQUBBQkEzMzMxMTE9 Pj0+Pz43NzcsLCwrKytFRUUrLCs/Pz9fYF+Pko/DxsLr7+pFR0V+gH4zNDNfYV+jpaI4ODhmZ2VN Tk06Ozo/QT9naWeOkY41NjW0t7MsLSwwMTAtLi0uLy45OjgyMzIbHBsvMC8qKyopKSkuLi4nJyci IyJhY2FJSkkwMC8gISAdHh0mJyYjIyMcHRwbGxt8fnuDhYIpKikkJSQiIiIjJCNqbGqgo6CHiode YF5RUlC8v7uFh4VKTEpERUN5fHm1uLTi5eHd4dz///81j6aBAAAAmnRSTlMAAAAAAAAAAAAAAAAA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAigz44Dn+/YQG/tAn/vdyKn7D9robJKjyWlf3pXi+VO9I +c4eufeEOf6cCR7+yif++GaDwgP+4zPc+RL+u/um/YFD5UsDDyn7fhX85OHvD6H1maVFvocGSO1K v9M8GJnhJPznzLrSbJGHqGD6KrfJPNLbk0UMUbL0YwAAAAFiS0dEAIgFHUgAAAAHdElNRQfjBQMG IweiEX1iAAACVElEQVQ4y2NgYGBgRAZMqmrMMMAABSgKWNQ1NJlZIQCrAjatWdo6ungUsOvNnjNX 34CVAwiwm2A4b978BUbGzFgUmJiamS9ctHjJvCVLly23sOTkRFVgZb1i+cpVyxavXgIEa+astbFF NcHOft2s9fPXzIaCNRs2bnJAVuC4ecH61WuQwfwtTkgKnLeuWj8fBWzb7uKKUGDltmD9hg0bluzY uWvX7g0gsH6PuwdSSHruXbx+/fp9Xt4+jFy+QNb6Nfv9/Ll54AoCAg8sXrz4YFAw0DLeECDzUGgY Ex8/P1xB+Nxlhw8fiYgEuVYg6vDho9ExHIJCQkJwBbErly2bFRcP9q5wwqpjifEiQqJAAFeQdHzV qr3JkPASSzmRGskvLgECcAUnjy9YcCoNooAzPYNbVEICRUHm6ePHj5/JgigQ8uCRkIQCmILIs3v3 7j2ZDVEgJSUlDQNwK3Lmnjt3MheiQAYEpPPyz58/XwBXUHhh7tzTRcUIBVIlCy9evFQKV1C29cKF y1fKwQpkgUCu4urJCxdOVsIVBF87febM1qtV1UAF8vLysjW1K4AC1+sQcVF/4/TpkytuNjQyMirI NzXfur319OmtLZEIBa1tW0+e3Lrizt32js6uezdvg3j3XWWQ0kP3g4tbt259ePvR1cdPFq4Asi8+ 7ZFQQE5Rvc/OXASChw8vPQTTz/siFRRR0mT/hBcP4eDlq1QJBSUl1FQ9cdLO129Asm/fvZ88RVpZ CV0BI2OM99RdHz7umjZ9hqSCkgoQYMtZM+PFpeQg0ggFeAEAzmwM75REXZ4AAAAldEVYdGRhdGU6 Y3JlYXRlADIwMTktMDUtMDNUMTM6MzU6MDctMDc6MDASd+GQAAAAJXRFWHRkYXRlOm1vZGlmeQAy MDE5LTA1LTAzVDEzOjM1OjA3LTA3OjAwYypZLAAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VS ZWFkeXHJZTwAAAAASUVORK5CYII=");
		}
		.th_remove {
			position: absolute;
			top: .5rem;
			right: .5rem;
			font-size: 2em;
			opacity: 0.8;
		}
		.th_progress {
			position: absolute;
			top: 4rem;
			right: 1rem;
			left: 1rem;
			height: .4rem;
			display: none;
		}
		.th_progress .progress-bar {
			width: 0%;
		}
	</style>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <h3 class="font-weight-bold">eRSA BIMAS HINDU</h3>
                

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user mr-2"></i> &nbsp;<span>{{auth()->user()->name}}</span> &nbsp;<i
                            class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Profil</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#lihatprofile">
                            <i class="fas fa-user mr-2"></i> Lihat Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="mt-3 pb-3 mb-1">
                    <div></div><br>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Beranda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview 
                        @isset($class_menu_surat)
                            {{ $class_menu_surat }}
                        @endisset
                        ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                                <p>
                                    Transaksi Surat
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/suratmasuk/index" class="nav-link 
                                    @isset($class_menu_surat_masuk)
                                        {{ $class_menu_surat_masuk }}
                                    @endisset
                                    ">
                                        <i class="far fa-envelope nav-icon"></i>
                                        <p>Surat Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/suratkeluar/index" class="nav-link 
                                    @isset($class_menu_surat_keluar)
                                        {{ $class_menu_surat_keluar }}
                                    @endisset
                                    ">
                                        <i class="far fa-envelope-open nav-icon"></i>
                                        <p>Surat Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview 
                        @isset($class_menu_agenda)
                            {{ $class_menu_agenda }}
                        @endisset
                        ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Buku Agenda
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/suratmasuk/agenda" class="nav-link 
                                    @isset($class_menu_agenda_surat_masuk)
                                        {{ $class_menu_agenda_surat_masuk }}
                                    @endisset
                                    ">
                                        <i class="far fa-envelope nav-icon"></i>
                                        <p>Agenda Surat Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/suratkeluar/agenda" class="nav-link 
                                    
                                    @isset($class_menu_agenda_surat_keluar)
                                        {{ $class_menu_agenda_surat_keluar }}
                                    @endisset
                                    
                                    ">
                                        <i class="far fa-envelope-open nav-icon"></i>
                                        <p>Agenda Surat Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview 
                        @isset($class_menu_galeri)
                            {{ $class_menu_galeri }}
                        @endisset
                        ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    Galeri File
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/suratmasuk/galeri" class="nav-link 
                                    @isset($class_menu_galeri_surat_masuk)
                                        {{ $class_menu_galeri_surat_masuk }}
                                    @endisset
                                    ">
                                        <i class="fas fa-sign-in-alt nav-icon"></i>
                                        <p>File Surat Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/suratkeluar/galeri" class="nav-link
                                    @isset($class_menu_galeri_surat_keluar)
                                        {{ $class_menu_galeri_surat_keluar }}
                                    @endisset
                                    ">
                                        <i class="fas fa-sign-out-alt nav-icon"></i>
                                        <p>File Surat Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/klasifikasi/index" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    Klasifikasi
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->role == 'admin')
                        <li class="nav-item has-treeview 
                        @isset($class_menu_pengaturan)
                            {{ $class_menu_pengaturan }}
                        @endisset 
                        ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Pengaturan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('instansi.index') }}" class="nav-link
                                    @isset($class_menu_pengaturan_instansi)
                                        {{ $class_menu_pengaturan_instansi }}
                                    @endisset 
                                    ">
                                        <i class="fas fa-warehouse nav-icon"></i>
                                        <p>Manajemen Instansi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengguna.index') }}" class="nav-link 
                                    @isset($class_menu_pengaturan_pengguna)
                                        {{ $class_menu_pengaturan_pengguna }}
                                    @endisset 
                                    ">
                                        <i class="fas fa-users-cog nav-icon"></i>
                                        <p>Manajemen User </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
                <br>
                <center><img src="/general/kemenag-logo-small.png" alt="Logo" class="logo"><center>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background: #192192192; padding: 15px 15px 15px 15px ">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>TEMPORARY APP</b>
            </div>
            BIMAS HINDU PROVINSI SULAWESI TENGAH
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/adminlte/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/js/adminlte.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="/adminlte/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Data Table -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="/adminlte/js/demo.js"></script>
    <!-- page script -->

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script> -->
    
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
        This must be loaded before fileinput.min.js -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script> -->
    
       
    <!-- the main fileinput plugin script JS file -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script> -->
    
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
    <!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/themes/fas/theme.min.js"></script -->
    
    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script> -->

    <!-- include jQuery library -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> -->

<!-- include FilePond library -->
<!-- <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script> -->

<!-- include FilePond plugins -->
<!-- <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script> -->

<!-- include FilePond jQuery adapter -->
<!-- <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script> -->

<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>

FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginImageEdit,
  FilePondPluginFilePoster
);

// var file = "https://en.wikipedia.org/wiki/Image#/media/File:Image_created_with_a_mobile_phone.png";

// var files = [
//     {
//       source: file,
//       options: {
//         type: "input",
//         file: {
//           name: "Image_created_with_a_mobile_phone.png",
//           type: "image/png"
//         }
//       }
//     }
//   ];

const pond = FilePond.create(
        document.querySelector('input[id="upload"]'), {
        }
    );


</script>

@yield('file-pond-create')
@yield('file-pond-edit')



    <script>
        $(function () {
            
            $("#tabelSuratmasuk").DataTable({
                responsive: true
            });
            $("#tabelSuratkeluar").DataTable();
            $("#tabelAgendaMasuk").DataTable();
            $("#tabelAgendaKeluar").DataTable();
            

            $("#tabelKlasifikasi").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });

        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function () {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        });

		window.URL = window.URL || window.webkitURL;
        // $.fn.fileinputBsVersion = '4'; 
        // $("#exampleFormControlFile1").fileinput();
		document.addEventListener('DOMContentLoaded', function(){
			var select_images_input = document.getElementById("select_images_input"),
				th_container = document.getElementById("th_container"),
				btn_scan = document.getElementById("btn-scan"),
				download_app = document.getElementById("download-app"),
				btn_upload = document.getElementById("btn-upload");

			var i = 0;
			var wsImpl = window.WebSocket || window.MozWebSocket;
			window.ws = new wsImpl('ws://localhost:8181/');
			ws.onmessage = function(e){
				if (e.data instanceof Blob){
					i++;
					document.getElementById("th_container_empty").style.display = 'none';
					document.getElementById("btn-upload").style.display = '';
					var th_img_id = "upl_image" + i;
					createThumbnail(th_container, th_img_id, "Scan "+i);
					appendImage(e.data, th_img_id);

                    // const blob = e.data;
                    // blob = blob.slice(0, blob.size, "image/jpeg")
                    const blob = new Blob([e.data], {
                        type: 'image/jpeg'
                        });
                    pond.addFile(blob);
                    // $('#exampleFormControlFile1').fileinput('addToStack', e.data);
                    // var files = $('#exampleFormControlFile1').fileinput('getFileList'); 
                    // $('#exampleFormControlFile1').fileinput('readFiles', files,th_img_id); 
				}
			};
			ws.onopen = function(){
				btn_scan.removeAttribute('disabled');
				download_app.style.display = 'none';
			};
			ws.onerror = function(e){
				btn_scan.setAttribute('disabled', '');
				download_app.style.display = '';
			}

			btn_scan.addEventListener('click', function(){
				ws.send("1100");
			}, false);

			btn_upload.addEventListener('click', function(){
				btn_upload.style.display = 'none';
				Array.from(document.querySelectorAll("img.th_img")).forEach(e => { uploadImage(e); });
			}, false);
		});

		document.addEventListener('click',function(e){
			if (e.target && e.target.className == 'th_rotate') {
				var c = document.createElement('canvas');
				var ctx = c.getContext('2d');
				var src_img = e.target.previousElementSibling;
				var img = new Image();
				img.src = src_img.src;
				img.onload = function() {
					imgWidth = img.width;
					imgHeight = img.height;
					c.width = imgHeight;
					c.height = imgWidth;
					ctx.translate(c.width/2, c.height/2);
					ctx.rotate(90*Math.PI/180);
					ctx.translate(-c.height/2, -c.width/2);
					ctx.drawImage(img, 0, 0);
					c.toBlob(function(blob){
						window.URL.revokeObjectURL(src_img.src);
						src_img.src = window.URL.createObjectURL(blob);
					}, "image/jpeg", 0.9);
				}
			}
		});

		function createThumbnail(container, th_img_id, caption){
			var col = document.createElement("div");
			col.className = "col-2";
			container.appendChild(col);

			var th = document.createElement("div");
			th.className = "card mb-4 shadow-sm text-center";
			col.appendChild(th);

			var th_img = document.createElement("img");
			th_img.style.width='150px';
			th_img.className = "card-img-top th_img";
			th_img.id = th_img_id;
			th_img.width = 150;
			th.appendChild(th_img);

			var th_rotate = document.createElement("div");
			th_rotate.className = "th_rotate";
			th.appendChild(th_rotate);

			var info = document.createElement("div");
			info.className = "card-body";
			info.innerHTML = caption;
			th.appendChild(info);

			var prg = document.createElement("div");
			prg.className = "progress th_progress";
			prg.innerHTML = "<div class=\"progress-bar bg-warning\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
			th.appendChild(prg);

			var th_remove = document.createElement("button");
			th_remove.className = "close text-danger th_remove";
			th_remove.setAttribute("type", "button");
			th_remove.setAttribute("aria-label", "Remove");
			th_remove.innerHTML = "<span aria-hidden=\"true\">&times;</span>";
			th.appendChild(th_remove);

			th_remove.addEventListener("click", function(e){
				e.target.parentNode.parentNode.parentNode.remove();
			}, false);
		}

		function appendImage(file, img_id, maxSizeWH = 3000){
			function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
				var ratio = [maxWidth / srcWidth, maxHeight / srcHeight ];
				ratio = Math.min(ratio[0], ratio[1]);
				return { width:srcWidth*ratio, height:srcHeight*ratio };
			}
			var img = new Image();
			img.src = window.URL.createObjectURL(file);
			img.onload = function(){
				var c = document.createElement('canvas');
				if ((this.naturalWidth < maxSizeWH) && (this.naturalHeight < maxSizeWH)){
					var new_dimensions = {width:this.naturalWidth, height:this.naturalHeight};
				}else{
					var new_dimensions = calculateAspectRatioFit(this.naturalWidth, this.naturalHeight, maxSizeWH, maxSizeWH);
				}
				c.width = new_dimensions.width;
				c.height = new_dimensions.height;
				c.getContext('2d').drawImage(this, 0, 0, this.naturalWidth, this.naturalHeight, 0, 0, new_dimensions.width, new_dimensions.height);
				c.toBlob(function(blob){
					document.getElementById(img_id).src = window.URL.createObjectURL(blob);
				}, "image/jpeg", 0.9);
				c.remove();
			}
			img.remove();
		}

		function uploadImage(src_img){
			fetch(src_img.src).then(i=>i.blob()).then(function(imageBlob){
				var fd = new FormData();
				fd.append("type", "image_upload");
				fd.append("blob", imageBlob);
				var xhr = new XMLHttpRequest();
				xhr.addEventListener("loadstart", function(e){
					var siblings = [].slice.call(src_img.parentNode.children) // convert to array
						.filter(function(v) { return v !== src_img }) // remove element itself
						.forEach(function(el){
							if (el.className == "th_rotate" || el.className == "close th_remove") el.remove();
							if (el.className == "progress th_progress") el.style.display = "flex";
						});
				}, false);
				xhr.upload.addEventListener("progress", function(e) {
					if (e.lengthComputable) {
						var percentage = Math.round((e.loaded*100)/e.total);
						src_img.nextSibling.nextSibling.firstChild.style.width = percentage+'%';
						src_img.nextSibling.nextSibling.firstChild.setAttribute("aria-valuenow", percentage);
					}
				}, false);
				xhr.onreadystatechange = function(){
					if (xhr.readyState == 4 && xhr.status == 200){
						var r = JSON.parse(xhr.responseText);
						src_img.classList.remove("th_img")
						var caption = document.getElementById(src_img.id).nextSibling;
						caption.innerHTML = r.newname;
						src_img.removeAttribute("id");
					}
				}
				xhr.open("POST", "/suratmasuk/tambah");
				xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
				xhr.send(fd);
			});
		}


    </script>


    <!-- Modal Profile -->
    <div class="modal fade" id="lihatprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-user my-1 btn-sm-1"></i>
                        &nbsp;Profil Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <h5><label for="nama">Nama </label></h5>
                        </div>
                        <div class="col-9">
                            <h5><label for="nama"> : {{auth()->user()->name}}</label></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h5><label for="nama">Email </label></h5>
                        </div>
                        <div class="col-9">
                            <h5><label for="nama"> : {{auth()->user()->email}}</label></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h5><label for="nama">Level User </label></h5>
                        </div>
                        <div class="col-9">
                            <h5><label for="nama"> : {{auth()->user()->role}}</label></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
