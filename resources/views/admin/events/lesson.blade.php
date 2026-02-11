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
                    <h1>Add lesson - <a href="" target="_blank">(help)</a></h1>
                </div>
            </div>
            fsdfsd
        </div>
    </section>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.lessonSaveData') }}" enctype="multipart/form-data">
            @csrf
            @if($sheduleRes != 0)
                <button type="submit" id="go" style="margin-top: -40px;" class="btn btn-primary" >{{ __('translate.Create') }}</button>
            @else
                <span type="submit" style="margin-top: -40px;" class="btn btn-default">{{ __('translate.Create') }}</span>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Category') }}</label>

                                @if(isset($event->category))
                                    <select name="category" id="category" class="form-control" disabled>
                                        <option value="3" {{ $event->category == "3" ? 'selected' : '' }}>{{ __('translate.Work') }}</option>
                                        <option value="2" {{ $event->category == "2" ? 'selected' : '' }}>{{ __('translate.Event') }}</option>
                                        <option value="1" {{ $event->category == "1" ? 'selected' : '' }}>{{ __('translate.Trade') }}</option>
                                        <option value="0" {{ $event->category == "0" ? 'selected' : '' }}>{{ __('translate.Courses') }}</option>
                                        @else
                                            <select name="category" id="category" class="form-control" >
                                                <option value="3">{{ __('translate.Work') }}</option>
                                                <option value="2">{{ __('translate.Event') }}</option>
                                                <option value="1">{{ __('translate.Trade') }}</option>
                                                <option value="0">{{ __('translate.Courses') }}</option>
                                                @endif
                                            </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('translate.Name') }}</label>
                                <input type="text" name="title" id="title" value="{{$event->title}}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('translate.Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

{{--                            <input type="hidden" name="additional_fields" id="additional_fields" value="">--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="card-body-duble">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <button type="button" id="add_field_button" class="btn btn-success">{{ __('translate.Add Field') }}</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <input type="hidden" name="eventId" id="event_id" value="{{$event->id}}">
                            <div class="form-group" id="allfotoaddlesson">
                                <div id="fileNames">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                                <label for="description">{{ __('translate.Description') }}</label>
                                    <div class="card card-outline card-info">
                                        <div class="card-body">
                                                <input type="hidden" name="additional_fields" id="additional_fields" value="">
                                                <div class="form-group">
                                                    <div class="card-body-duble">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        <div class="card-footer">
                        </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            @if($sheduleRes != 0)
                <button type="submit" id="go" style="margin-top: 10px;" class="btn btn-primary" >{{ __('translate.Create') }}</button>
            @else
                <span type="submit" style="margin-top: -4px;" class="btn btn-default" >{{ __('translate.Create') }}</span>
            @endif
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById('allfoto');
        const label = document.getElementById('fileInputLabelAll');

        input.addEventListener('change', function() {
            const fileNames = [];
            for (let i = 0; i < this.files.length; i++) {
                fileNames.push(this.files[i].name);
            }
            label.textContent = fileNames.join(', ');
        });
    });
</script>
<script>
    $(document).ready(function () {
        Dropzone.options.myDropzone = {
            paramName: "file",
            maxFilesize: 2,
            acceptedFiles: ".jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Remove",
            init: function () {
                this.on("success", function (file, response) {
                    console.log(response);
                });
                this.on("error", function (file, errorMessage) {
                    console.log(errorMessage);
                });
            }
        };
    });

    function showHidePanel() {
        var selectElement = document.getElementById("type_pay");
        var fotoPanel = document.getElementById("amount_panel");
        var fotoPanelTu = document.getElementById("currency_panel");

        if (selectElement.value === "1") {
            fotoPanel.style.display = "block";
            fotoPanelTu.style.display = "block";
        } else {
            fotoPanel.style.display = "none";
            fotoPanelTu.style.display = "none";
        }
    }
    showHidePanel();
</script>
<script>
    $(document).ready(function(){
        var max_fields = 10;
        var wrapper = $(".card-body-duble");
        var add_button = $("#add_field_button");
        var additional_fields = [];

        $(add_button).click(function(e){
            e.preventDefault();
            if(additional_fields.length < max_fields){
                var new_field_index = additional_fields.length;
                var new_field_name = "field_" + new_field_index;
                additional_fields.push(new_field_name);
                var new_summernote_id = "summernote_" + new_field_index;

                $(wrapper).append('<div><label>' + new_field_name + '</label><input type="text" name="' + new_field_name + '" class="form-control additional_field" required><br/><textarea id="' + new_summernote_id + '" name="description_' + new_field_index + '"></textarea> <a href="#" class="remove_field">X</a></div>');

                $('#' + new_summernote_id).summernote({});

                var fileInputHtml = '<div><label for="allfoto_' + new_field_index + '">{{ __("translate.All photos") }}</label>' +
                    '<div class="file-input-wrapper">' +
                    '<input type="file" name="allfoto[]" id="allfoto_' + new_field_index + '" class="form-control" data-index="' + new_field_index + '">' +
                    '<div class="file-input-label">{{ __("translate.Click here to select file") }}</div>' +
                    '</div></div>' +
                    '<div><label for="allvideo_' + new_field_index + '">{{ __("translate.All video") }}</label>' +
                    '<div class="file-input-wrapper">' +
                    '<input type="file" name="allvideo[]" id="allvideo_' + new_field_index + '" class="form-control" data-index="' + new_field_index + '">' +
                    '<div class="file-input-label">{{ __("translate.Click here to select file") }}</div>' +
                    '</div></div>';


                $('#allfotoaddlesson').append(fileInputHtml);

                updateAdditionalFieldsValue();
            }
        });

        $(document).ready(function () {
            $(document).on('change', 'input[type="file"][name^="allfoto"]', function () {
                const fileNames = [];
                const files = this.files;
                for (let i = 0; i < files.length; i++) {
                    fileNames.push(files[i].name);
                }
                $(this).siblings('.file-input-label').text(fileNames.join(', '));
            });
        });

        $(document).on('change', 'input[type="file"][name^="allvideo"]', function () {
            var files = this.files;
            var formData = new FormData();
            var fileNames = [];
            var fieldIndex = $(this).data('index'); // Извлечение индекса поля


            for (let i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
                formData.append('allvideo[]', files[i]);
            }

            formData.append('fieldIndex', fieldIndex); // Добавление индекса поля в FormData
            formData.append('eventId', $('#event_id').val());

            $(this).siblings('.file-input-label').text(fileNames.join(', '));

            var uniqueId = 'progress-' + Math.random().toString(36).substr(2, 9);
            var loadingIndicatorId = uniqueId + '-loadingIndicator';
            var progressBarId = uniqueId + '-progressBar';

            var loadingIndicator = $('<div id="' + loadingIndicatorId + '">Загрузка...</div>');
            var progressBar = $('<div id="' + progressBarId + '" style="width: 0%; height: 20px; background-color: #4CAF50;"></div>');
            $(this).parent().append(loadingIndicator);
            $(this).parent().append(progressBar);

            $('#go').attr('disabled', 'disabled');
            formData.forEach(function(value, key){
                console.log(key + ": " + value);
            });
            $.ajax({
                url: '/admin/events/upload-video',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.onprogress = function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('#' + progressBarId).width(percentComplete + '%');
                            if (percentComplete === 100) {
                                $('#' + loadingIndicatorId).text('Обработка...');
                            }
                        }
                    };
                    return xhr;
                },
                success: function(response) {

                    $('#' + loadingIndicatorId).text('Файл загружен');
                    $('#' + progressBarId).width('100%').delay(500).fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#go').removeAttr('disabled');
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    $('#' + loadingIndicatorId).remove();
                    $('#' + progressBarId).remove();
                    console.error('Ошибка загрузки: ' + textStatus + ' - ' + errorThrown);
                    console.error('Ответ сервера: ' + jqXHR.responseText);
                    alert('Ошибка загрузки: ' + textStatus);
                    $('#go').removeAttr('disabled');
                }
            });
        });

        $(wrapper).on("click", ".remove_field", function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            additional_fields.pop();
            updateAdditionalFieldsValue();
        });

        $(wrapper).on("click", ".remove_field", function(e){
            e.preventDefault();
            var removed_field_name = $(this).parent('div').find('input[type=text]').attr('name');
            $(this).parent('div').remove();
            var removed_index = additional_fields.indexOf(removed_field_name);
            additional_fields.splice(removed_index, 1);
            updateAdditionalFieldsValue();
        });

        $(wrapper).on("input", ".additional_field", function() {
            updateAdditionalFieldsValue();
        });

        $(wrapper).on("change", "input[type=radio][name=r3]", function() {
            updateAdditionalFieldsValue();
        });

        function updateAdditionalFieldsValue() {
            var additional_fields_values = [];
            $(".additional_field").each(function() {
                var field_name = $(this).attr('name');
                var field_value = $(this).val();
                additional_fields_values.push({ name: field_name, value: field_value });
            });

            var radio_value = $('input[type=radio][name=r3]:checked').val();
            if (radio_value) {
                additional_fields_values.push({ name: 'radio_button', value: radio_value });
            }

            $('#additional_fields').val(JSON.stringify(additional_fields_values));
        }
    });

</script>
<script>
    document.getElementById('toggleLink').addEventListener('click', function(event) {
        event.preventDefault();
        var content = document.getElementById('toggleContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
            this.textContent = 'Close';
        } else {
            content.style.display = 'none';
            this.textContent = 'Раскрыть';
        }
    });
</script>
</body>
</html>



