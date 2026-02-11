@include('admin.header_adm')
<style>
    .image-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-start;
        align-items: flex-start;
        width: 100%;
    }
    .img-wrapper {
        flex: 0 0 calc(20% - 10px);
        max-width: calc(20% - 10px);
        margin-bottom: 10px;
        position: relative;
    }
    .responsive-image {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    input[type="checkbox"] {
        position: absolute;
        top: -9px;
        left: 5px;
    }
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
    }

    /* Скрытие input file */
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
                    <h1>{{ __('translate.Edit Create') }} - <a href="" target="_blank">(help)</a></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.redactLessonUpdate', ['event' => $event->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <button type="submit" style="margin-top:-40px;" class="btn btn-primary">{{ __('translate.Save') }}</button>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" style="margin-top:-40px;" class="btn btn-primary">{{ __('translate.Save') }}</button>
            @foreach ($lessons as $lesson)
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <strong>Lesson Title:</strong> {{ $lesson->title }}
                            </div>
                            <div class="card-body">
                                <p><strong>Description:</strong> {!! $lesson->description !!}</p>
                                @if ($lesson->files->count() > 0)
                                    <strong>Files:</strong>
                                    <ul>
                                        @foreach ($lesson->files as $file)
                                            <li>{{ $file->text }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No files for this lesson section.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong><a href="https://adminlte.io"></a></strong>
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


</body>
</html>



