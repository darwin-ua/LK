@include('admin.header_adm')
<style>

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-input-label {
        padding: 10px 15px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .file-input-label:hover {
        background-color: #e0e0e0;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Users Create') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home{{ __('translate.Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('translate.Inline Charts') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="title">{{ __('translate.Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">{{ __('translate.Slug') }}</label>
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="shedule_id">{{ __('translate.Shedule') }}</label>
                                <input type="text" name="shedule_id" id="shedule_id" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title">{{ __('translate.Photo title') }}</label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="foto_title" id="foto_title" class="form-control" required>
                                    <div class="file-input-label" id="fileInputLabelTitle">{{ __('translate.Click here to select') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto_folder_id">{{ __('translate.Foto num') }}</label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" class="form-control"
                                       required>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('translate.Create') }}</button>
        </form>
    </div>
</div>
<footer class="main-footer">

    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2024 Eventhes.com</strong> All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="{{ asset('storage/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/all.js') }}"></script>
<script src="{{ asset('storage/css/sidebar.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script src="{{ asset('storage/css/sidebar.js') }}"></script>

</body>
</html>



