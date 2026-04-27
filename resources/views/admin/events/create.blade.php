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

    .d-inline-block {
        cursor: pointer;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Events Create') }} - <a href="https://vimeo.com/924352541" target="_blank">(help)</a> -
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default" >
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 1</a></label>
                            </div>
                        </div>
                        <div class="card-header" >
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Category') }} -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                @if(isset($event->category))
                                    <select name="category" id="category" class="form-control" disabled>
                                        <option {{ $event->category == "4" ? 'selected' : '' }}>{{ __('translate.Goods') }}</option>
                                         <option {{ $event->category == "2" ? 'selected' : '' }}>{{ __('translate.Event') }}</option>

                                        {{--                                    <option {{ $event->category == "1" ? 'selected' : '' }}>{{ __('translate.Courses') }}</option>--}}
                                        @else
                                            <select name="category" id="category" class="form-control" >
                                                <option value="0">Select options</option>
                                                <option value="4">{{ __('translate.Goods') }}</option>
                                               <option value="2">{{ __('translate.Events') }}</option>
                                                {{--                                        <option value="1">{{ __('translate.Courses') }}</option>--}}
                                                @endif
                                            </select>
                            </div>
                            <div id="content"></div>
                            <div class="form-group">
                                <label for="title">{{ __('translate.Title') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default" >
                        <div class="card-header">
                                <div class="form-group">
                                    <label for="foto_title"><a href="#" id="toggleLink">Крок 2</a></label>
                                </div>
                            <div class="form-group">
                                <label>{{ __('translate.US phone mask:') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shedule_date_from">{{ __('translate.Shedule') }} -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
        </span>
                                </label>
                                <div>
                                    <span><h5>Від</h5></span>
                                    <input type="date" name="shedule_date_from" id="shedule_date_from" class="form-control" placeholder="От">
                                    <span><h5>До</h5></span>
                                    <input type="date" name="shedule_date_to" id="shedule_date_to" class="form-control" placeholder="До">
                                </div>
                                @if($sheduleRes == 0)
                                    <span style="color: red;">{{ __('translate.Create a schedule first') }}! (<a href="{{ route('admin.shedules.create') }}">Создать</a>)</span>
                                @endif
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dateInputs = document.querySelectorAll('input[type="date"]');
                                    dateInputs.forEach(input => {
                                        input.addEventListener('focus', function() {
                                            input.showPicker();
                                        });
                                    });
                                });
                            </script>


                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                                <div class="form-group">
                                    <label for="foto_title"><a href="#" id="toggleLink">Крок 3</a></label>
                                </div>

                            <div class="form-group" style="display: none;">
                                <label for="foto_folder_id">{{ __('translate.Payment') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" value="0" class="form-control"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Event paymant') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <select name="type_pay" id="type_pay" class="form-control"  onchange="showHidePanel()">
                                    <option value="1" >{{ __('translate.Оплата з календарем') }}</option>
                                    <option value="0" >{{ __('translate.Оплата без календаря') }}</option>
                                    <option value="2" >{{ __('translate.Календарь без оплати') }}</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="discount">{{ __('translate.Discount') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="discount"  class="form-control" placeholder="0" >
                            </div>
                            <div class="form-group" id="piple_panel" >
                                <label for="amount_id">{{ __('translate.Piple') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="piple" id="piple_id" class="form-control" placeholder="0">
                            </div>
                            <div class="form-group" id="amount_panel" style="display: none;">
                                <label for="amount_id">{{ __('translate.Price') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="amount" id="amount_id" class="form-control" placeholder="0">
                            </div>
                            <div class="form-group" id="currency_panel" style="display: none;">
                                <label for="amount_id">{{ __('translate.Currency') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <select name="currency"  class="form-control"  onchange="showHidePanel()">
                                    <option value="0">$</option>
                                    <option value="1">&#8381;</option>
                                    <option value="2">&euro;</option>
                                    <option value="3">&#8372;</option>
                                    <option value="4">Z&#322;</option>
                                    <option value="5">{{ __('translate.No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default" >
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 4</a> - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                            </div>
                        </div>
                        <div class="card-header"  id="toggleContent"  >
                            <div class="form-group" id="currency_panel" >
                            </div>
                         <input type="hidden" name="additional_fields" id="additional_fields" value="">
                            <div class="form-group">
                                <div class="card-body-duble">
                                </div>
                            </div>
                        <button type="button" id="add_field_button" class="btn btn-success">{{ __('translate.Add Field') }}</button>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 5</a></label>
                            </div>
                            <div class="form-group">
                                <label for="allfoto">{{ __('translate.All photos') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="allfoto[]" id="allfoto" class="form-control"multiple>
                                    <div class="file-input-label" id="fileInputLabelAll">{{ __('translate.Click here to select file') }}</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('translate.Description') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Summernote
                                            </h3>
                                        </div>
                                        <div class="card-body">
              <textarea id="summernote" name="description">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($sheduleRes != 0)
                            <button type="submit"  class="btn btn-primary" >{{ __('translate.Create') }}</button>
                        @else
                            <span type="submit"  class="btn btn-default">{{ __('translate.Create') }}</span>
                        @endif
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                </div>
            </div>
            <br>
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

        if (selectElement.value === "2") {  // Если выбрано "Календарь без оплати"
            fotoPanel.style.display = "none";
            fotoPanelTu.style.display = "none";
        } else {
            fotoPanel.style.display = "block";
            fotoPanelTu.style.display = "block";
        }
    }

    // Вызываем функцию при загрузке страницы
    window.onload = showHidePanel;

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
                var new_field_name = "field_" + additional_fields.length;
                additional_fields.push(new_field_name);
                $(wrapper).append('<div><label>'+ new_field_name +'</label><input type="text" name="' + new_field_name + '" class="form-control additional_field" required><input type="radio" name="r3" class="radio_field"> Field for File <a href="#" class="remove_field">X </a></div>');
                updateAdditionalFieldsValue();
            }
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
        event.preventDefault(); // Предотвращаем стандартное поведение ссылки
        var content = document.getElementById('toggleContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
            this.textContent = 'Close';
        } else {
            content.style.display = 'none';
            this.textContent = 'Раскрыть';
        }
    });


    $(document).ready(function() {
        $('#category').change(function() {
            var category = $(this).val();
            var url = '';

            switch(category) {
                case '4':
                    url = '/category/goods';
                    break;
                case '3':
                    url = '/category/event';
                    break;
                case '2':
                    url = '/category/trade';
                    break;
                case '1':
                    url = '/category/courses';
                    break;
            }
            if (url) {
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            }
        });
    });

</script>

</body>
</html>



