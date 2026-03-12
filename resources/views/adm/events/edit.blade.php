@php
    View::share('breadcrumbsData', ['admin.events.edit', $event]);
@endphp

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

    .fixed-create-button {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: 250px;
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редагування події</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form method="POST" id="updateForm" action="{{ route('admin.events.update', ['event' => $event->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <label for="type_pay">{{ __('translate.Category') }}</label>
                            <select name="category" id="category" class="form-control"  disabled>
                                <option {{ $event->category == "4" ? 'selected' : '' }}>{{ __('translate.Goods') }}</option>
                                {{--                                    <option {{ $event->category == "3" ? 'selected' : '' }}>{{ __('translate.Event') }}</option>--}}
                                <option {{ $event->category == "2" ? 'selected' : '' }}>{{ __('translate.Service') }}</option>
                                {{--                                    <option {{ $event->category == "1" ? 'selected' : '' }}>{{ __('translate.Courses') }}</option>--}}
                            </select>
                            <div class="form-group">
                                 <label for="title">{{ __('translate.Title') }}</label>
                                 <input type="text" name="title" id="title" class="form-control" value="{{$event->title}}"  disabled>
                             </div>
                            <div class="form-group" style="display: none;">
                                <label for="slug">{{ __('translate.Slug') }}</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{$event->slug}}" disabled>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="foto_folder_id">{{ __('translate.Foto num') }}</label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" value="{{$event->foto_title}}" class="form-control"
                                       required>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="foto_folder_id">{{ __('translate.Payment') }}</label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" value="0" class="form-control"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Event payment') }}</label>
                                <select name="type_pay" id="type_pay" class="form-control"  onchange="showHidePanel()" disabled>
                                    <option value="" disabled {{ $event->type_pay === null ? 'selected' : '' }}></option>
                                    <option value="1" {{ $event->type_pay == "1" ? 'selected' : '' }}>{{ __('translate.Payment in date') }}</option>
                                    <option value="0" {{ $event->type_pay == "0" ? 'selected' : '' }}>{{ __('translate.Payment not date') }}</option>
                                    <option value="2" {{ $event->type_pay == "2" ? 'selected' : '' }}>{{ __('translate.Date not payment') }}</option>
                                    <option value="3" {{ $event->type_pay == "3" ? 'selected' : '' }}>Без оплати, без календаря</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount">
                                    Налаштування розкладу
                                </label>
                                <a href="/admin/shedules/all" style="display: block; text-decoration: underline;"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                                                                                                        class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg> Налаштувати</a>
                            </div>
                            <div class="form-group"  >
                                <label for="discount">{{ __('translate.Discount') }}</label>
                                <input type="text" name="discount"  class="form-control" placeholder="{{ $event->discounte }}" value="{{ $event->discounte }}"  required>
                            </div>

                            <div class="form-group"  >
                                <label for="amount_id">{{ __('translate.Piple') }}</label>
                                <input type="text" name="piple" id="piple_id" class="form-control" placeholder="{{ $event->piple}}" value="{{ $event->piple }}"  required>
                            </div>
                            <div class="form-group"  >
                                <label for="amount_id">{{ __('translate.Price') }}</label>
                                <input type="text" name="amount"  class="form-control" placeholder="{{ $event->amount }}" value="{{ $event->amount }}" >
                            </div>
                            <div class="form-group" id="currency_panel">
                                <label for="amount_id">{{ __('translate.Currency') }}</label>
                                <select name="currency" class="form-control"  onchange="showHidePanel()">
                                    <option value="0" {{ $event->currency == "0" ? 'selected' : '' }}>$</option>
                                    <option value="1" {{ $event->currency == "1" ? 'selected' : '' }}>&#8381;</option>
                                    <option value="2" {{ $event->currency == "2" ? 'selected' : '' }}>&euro;</option>
                                    <option value="3" {{ $event->currency == "3" ? 'selected' : '' }}>&#8372;</option>
                                    <option value="4" {{ $event->currency == "4" ? 'selected' : '' }}>Z&#322;</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('translate.Description') }}</label>
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Summernote
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <textarea name="description" id="summernote">{{ $event->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default" id="eventMenu" style="display: block;">
                        <div class="card card-default" id="eventMenu" style="display: block;">
                            <div class="card-header">
                                <div class="form-group">
                                    <label for="foto_title"><a href="#" id="toggleLink">Крок 4</a> - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"></path>
                                        </svg></span>
                                    </label>
                                </div>
                            </div>
                            <style>
                                /* Убираем границы таблицы */
                                table, th, td {
                                    border: none !important;
                                }
                            </style>
                            <div class="card-header" id="toggleContent">
                                <label for="textInputField">Дополнительные поля :</label>
                                <div class="container mt-4">
                                    <div id="notification"></div>
                                    <div id="dynamicFieldsContainer">
                                        <input type="hidden" name="add_fields_test" id="add_fields_test">

                                        <!-- Сюда будут добавляться новые поля -->
                                        <div class="form-group" id="4" data-unique-id="4">
                                            <input type="text" id="word1" name="block_4" class="form-control dynamic-input" name="name_block_4" placeholder="Введите название блока" data-gtm-form-interact-field-id="1">
                                            <label>Введите текст (строка):</label>
                                            <input type="text" name="block_4_4" class="form-control dynamic-input" placeholder="Введите текст" data-gtm-form-interact-field-id="2">
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                </svg></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                </svg></button>

                                        </div>
                                        <div class="form-group" id="5" data-unique-id="5">
                                            <input type="text" id="word2" name="block_5" class="form-control dynamic-input" name="name_block_5" placeholder="Введите название блока" data-gtm-form-interact-field-id="3">
                                            <label>Введите текст (абзац):</label>
                                            <textarea class="form-control dynamic-textarea" name="block_5_5" rows="3" placeholder="Введите абзац текста" data-gtm-form-interact-field-id="4"></textarea>
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                </svg></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                </svg></button>
                                        </div>
                                        <div class="form-group" id="6" data-unique-id="6" data-variant="1">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word3" name="block_6" class="form-control dynamic-input" name="name_block_6" placeholder="Введите название блока" data-gtm-form-interact-field-id="5">
                                            <label>Выбор одного из списка:</label>
                                            <select class="form-control dynamic-select"></select>
                                            <div class="mt-2">
                                                <input type="text" name="block_6_6" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант" data-gtm-form-interact-field-id="6">
                                                <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path>
                                                    </svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                    </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                    </svg></button><div class="form-check form-switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="7" data-unique-id="7" data-variant="2">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word4" name="block_7" class="form-control dynamic-input" placeholder="Введите название блока">

                                            <label class="mt-2">Выбор из нескольких вариантов:</label>
                                            <select name="block_7_7[]" class="form-control dynamic-select" multiple></select>


                                            <div class="mt-2">
                                                <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                                                <button type="button" class="btn btn-primary add-option-button mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                                    </svg>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group" id="8" data-unique-id="8" data-variant="3">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word5" name="block_8" class="form-control dynamic-input" name="name_block_8" placeholder="Введите название блока" data-gtm-form-interact-field-id="9">
                                            <label>Раскрывающийся список:</label>
                                            <select class="form-control dynamic-select" name="block_8_8"></select>
                                            <div class="mt-2">
                                                <input type="text"  class="form-control add-option-input mb-2" placeholder="Добавить новый вариант" data-gtm-form-interact-field-id="10">
                                                <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path>
                                                    </svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                    </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                    </svg></button><div class="form-check form-switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="11" data-unique-id="11">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word6" name="block_11" class="form-control dynamic-input" name="name_block_11" placeholder="Введите название блока" data-gtm-form-interact-field-id="11">
                                            <label>Выберите дату:</label>
                                            <input type="date" name="block_11_11" class="form-control dynamic-date">
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                </svg></button><div class="form-check form-switch">
                                                   </div>
                                        </div>
                                        <div class="form-group" id="12" data-unique-id="12">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word7" name="block_12" class="form-control dynamic-input" name="name_block_12" placeholder="Введите название блока" data-gtm-form-interact-field-id="12">
                                            <label>Выберите время:</label>
                                            <input type="time" name="block_12_12" class="form-control dynamic-time">
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                </svg></button><div class="form-check form-switch">
                                                 </div>

                                        </div>
                                        <div class="form-group" id="13" data-unique-id="13">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word8" name="block_13" class="form-control dynamic-input" name="name_block_13" placeholder="Введите название блока" data-gtm-form-interact-field-id="13">
                                            <label>Укажите значение шкалы:</label>
                                            <input type="range" name="block_13_13" class="form-control dynamic-range range-input" min="0" max="100" value="50" data-gtm-form-interact-field-id="14">
                                            <span class="range-value">62</span>
                                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                </svg></button><div class="form-check form-switch">
                                                     </div>
                                        </div>
                                        <div class="form-group" id="9" data-unique-id="9" data-variant="4">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word9" name="block_9" class="form-control dynamic-input" name="name_block_9" placeholder="Введите название блока" data-gtm-form-interact-field-id="15">
                                            <label>Сетка с множественным выбором:</label>
                                            <div class="dynamic-checkboxes">
{{--                                                <label><input type="checkbox"> Один</label><label><input type="checkbox"> Два</label><label><input type="checkbox"> Три</label></div>--}}
                                            <div class="mt-2">
                                                <input type="text" name="block_9_9" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант" data-gtm-form-interact-field-id="16">
                                                <button type="button" class="btn btn-primary add-option-checkbox-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path>
                                                    </svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                    </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                    </svg></button><div class="form-check form-switch">
                                                   </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="10" data-unique-id="10" data-variant="5">
                                            <label>Введите название блока:</label>
                                            <input type="text" id="word14" name="block_10" class="form-control dynamic-input" name="name_block_10" placeholder="Введите название блока" data-gtm-form-interact-field-id="17">
                                            <label>Сетка флажков:</label>
                                            <div class="dynamic-radios">

                                                <label><input type="radio" name="10"> Один</label><label><input type="radio" name="10"> Два</label><label><input type="radio" name="10"> Три</label></div>
                                            <div class="mt-2">
                                                <input type="text" name="block_10_10" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант" data-gtm-form-interact-field-id="18">
                                                <button type="button" class="btn btn-primary add-option-radio-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path>
                                                    </svg></button>
                                                <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                                                    </svg></button>&nbsp;<button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
                                                    </svg></button><div class="form-check form-switch">
                                                     </div>
                                            </div>
                                        </div>
                                        </div>
                                    <input type="hidden" id="additional_fields" name="additional_fields" value="[{&quot;key&quot;:4,&quot;value&quot;:&quot;Текст &quot;},{&quot;key&quot;:5,&quot;value&quot;:&quot;Абзац &quot;},{&quot;key&quot;:6,&quot;value&quot;:&quot;Один из списка&quot;},{&quot;key&quot;:6,&quot;value&quot;:&quot;Один 1&quot;,&quot;variant&quot;:1},{&quot;key&quot;:6,&quot;value&quot;:&quot;Два 2&quot;,&quot;variant&quot;:1},{&quot;key&quot;:6,&quot;value&quot;:&quot;Три 3&quot;,&quot;variant&quot;:1},{&quot;key&quot;:7,&quot;value&quot;:&quot;Несколько&quot;},{&quot;key&quot;:7,&quot;value&quot;:&quot;Несколько 1&quot;,&quot;variant&quot;:2},{&quot;key&quot;:7,&quot;value&quot;:&quot;Несколько 2&quot;,&quot;variant&quot;:2},{&quot;key&quot;:7,&quot;value&quot;:&quot;Несколько 3&quot;,&quot;variant&quot;:2},{&quot;key&quot;:8,&quot;value&quot;:&quot;Раскрывающийся&quot;},{&quot;key&quot;:8,&quot;value&quot;:&quot;Рас 1&quot;,&quot;variant&quot;:3},{&quot;key&quot;:8,&quot;value&quot;:&quot;Рас 2&quot;,&quot;variant&quot;:3},{&quot;key&quot;:8,&quot;value&quot;:&quot;Рас 3&quot;,&quot;variant&quot;:3},{&quot;key&quot;:11,&quot;value&quot;:&quot;Дата&quot;},{&quot;key&quot;:12,&quot;value&quot;:&quot;Время &quot;},{&quot;key&quot;:13,&quot;value&quot;:&quot;Тест шкала&quot;},{&quot;key&quot;:&quot;Введите название блока:Укажите значение шкалы: * Обязательный вопрос&quot;,&quot;value&quot;:&quot;62&quot;},{&quot;key&quot;:9,&quot;value&quot;:&quot;Сетка &quot;},{&quot;key&quot;:9,&quot;value&quot;:&quot;Сетка &quot;,&quot;variant&quot;:4},{&quot;key&quot;:9,&quot;value&quot;:&quot;Два&quot;,&quot;variant&quot;:4},{&quot;key&quot;:9,&quot;value&quot;:&quot;Три&quot;,&quot;variant&quot;:4},{&quot;key&quot;:10,&quot;value&quot;:&quot;Флажок&quot;},{&quot;key&quot;:10,&quot;value&quot;:&quot;Флажок&quot;,&quot;variant&quot;:5},{&quot;key&quot;:10,&quot;value&quot;:&quot;Два&quot;,&quot;variant&quot;:5},{&quot;key&quot;:10,&quot;value&quot;:&quot;Три&quot;,&quot;variant&quot;:5}]">

                                    <div id="inputFields">
                                        <!-- Поле для Текст (строка) -->
                                        <div class="form-group" id="textInput" style="display: none;">
                                            <label for="textInputField">Введите текст (строка):</label>
                                            <input type="text" class="form-control" id="textInputField" placeholder="Введите текст">
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" style="background-color: #00a2e8; border-color: #008ec4; color: #fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                                        </svg> Выбрать один из списка
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-top" style="">
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"></path>
                                                            </svg>        Текст (строка)</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-justify-left" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"></path>
                                                            </svg>        Текст (абзац)</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-ol" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5"></path>
                                                                <path d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635z"></path>
                                                            </svg>        Один из списка</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"></path>
                                                            </svg>        Несколько из списка</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                                                            </svg>        Раскрывающийся список</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"></path>
                                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"></path>
                                                            </svg>        Дата</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path>
                                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"></path>
                                                            </svg>        Время</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16">
                                                                <path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"></path>
                                                            </svg>        Шкала</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bounding-box-circles" viewBox="0 0 16 16">
                                                                <path d="M2 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2M0 2a2 2 0 0 1 3.937-.5h8.126A2 2 0 1 1 14.5 3.937v8.126a2 2 0 1 1-2.437 2.437H3.937A2 2 0 1 1 1.5 12.063V3.937A2 2 0 0 1 0 2m2.5 1.937v8.126c.703.18 1.256.734 1.437 1.437h8.126a2 2 0 0 1 1.437-1.437V3.937A2 2 0 0 1 12.063 2.5H3.937A2 2 0 0 1 2.5 3.937M14 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2M2 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"></path>
                                                            </svg>        Сетка(множественный выбор)</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bounding-box" viewBox="0 0 16 16">
                                                                <path d="M5 2V0H0v5h2v6H0v5h5v-2h6v2h5v-5h-2V5h2V0h-5v2zm6 1v2h2v6h-2v2H5v-2H3V5h2V3zm1-2h3v3h-3zm3 11v3h-3v-3zM4 15H1v-3h3zM1 4V1h3v3z"></path>
                                                            </svg>        Сетка флажков</button>
                                                        <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                                                <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"></path>
                                                                <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"></path>
                                                            </svg>        Загрузка файлов</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    <div id="template_block_4" style="display:none">
                                        <div class="form-group" data-unique-id="4">
                                            <input type="text" class="form-control" name="name_block_4" placeholder="Введите текст">
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const addFields = @json($addFields);

                                            const grouped = {};
                                            addFields.forEach(item => {
                                                const key = String(item.key);
                                                if (!grouped[key]) {
                                                    grouped[key] = [];
                                                }
                                                grouped[key].push(item);
                                            });

                                            const allBlocks = document.querySelectorAll('.form-group[data-unique-id]');
                                            allBlocks.forEach(block => {
                                                const key = block.getAttribute('data-unique-id');

                                                if (!grouped[key]) {
                                                    block.style.display = 'none';
                                                    return;
                                                }

                                                block.style.display = 'block';
                                                const items = grouped[key];

                                                items.forEach(item => {
                                                    const nameInput = block.querySelector(`[name="name_block_${key}"]`);
                                                    if (nameInput && item.value) {
                                                        nameInput.value = item.value;
                                                    }

                                                    const dateInput = block.querySelector('input[type="date"]');
                                                    if (dateInput && /^\d{4}-\d{2}-\d{2}$/.test(item.value)) {
                                                        dateInput.value = item.value;
                                                    }

                                                    const timeInput = block.querySelector('input[type="time"]');
                                                    if (timeInput && /^\d{2}:\d{2}$/.test(item.value)) {
                                                        timeInput.value = item.value;
                                                    }

                                                    const rangeInput = block.querySelector('input[type="range"]');
                                                    const rangeLabel = block.querySelector('.range-value');
                                                    if (rangeInput && !isNaN(item.value)) {
                                                        rangeInput.value = item.value;
                                                        if (rangeLabel) rangeLabel.textContent = item.value;
                                                    }

                                                    const select = block.querySelector('select');
                                                    if (select && item.variant !== undefined) {
                                                        const option = document.createElement('option');
                                                        option.value = item.value;
                                                        option.textContent = item.value;
                                                        select.appendChild(option);
                                                    }

                                                    if (key === '6' || key === '8') {
                                                        const container = block.querySelector('.dynamic-radios');
                                                        if (container && item.variant !== undefined) {
                                                            const label = document.createElement('label');
                                                            const input = document.createElement('input');
                                                            input.type = 'radio';
                                                            input.name = `radio_${key}`;
                                                            input.value = item.value;
                                                            label.appendChild(input);
                                                            label.appendChild(document.createTextNode(' ' + item.value));
                                                            container.appendChild(label);
                                                        }
                                                    }

                                                    if (key === '7' || key === '9' || key === '10') {
                                                        const container = block.querySelector('.dynamic-checkboxes');
                                                        if (container && item.variant !== undefined) {
                                                            const label = document.createElement('label');
                                                            const input = document.createElement('input');
                                                            input.type = 'checkbox';
                                                            input.name = `checkbox_${key}[]`;
                                                            input.value = item.value;
                                                            label.appendChild(input);
                                                            label.appendChild(document.createTextNode(' ' + item.value));
                                                            container.appendChild(label);
                                                        }
                                                    }
                                                });

                                                // 🧽 ОЧИСТКА содержимого по кнопке-ластик
                                                const clearBtn = block.querySelector('.bi-eraser')?.closest('button');
                                                if (clearBtn) {
                                                    clearBtn.addEventListener('click', () => {
                                                        block.querySelectorAll('input, textarea, select').forEach(el => {
                                                            if (el.type === 'checkbox' || el.type === 'radio') {
                                                                el.checked = false;
                                                            } else if (el.tagName === 'SELECT') {
                                                                // Удалить все опции
                                                                el.innerHTML = '<option value="">Выберите</option>';
                                                            } else {
                                                                el.value = '';
                                                            }
                                                        });

                                                        const rangeLabel = block.querySelector('.range-value');
                                                        if (rangeLabel) rangeLabel.textContent = '';

                                                        const dynamicRadios = block.querySelector('.dynamic-radios');
                                                        const dynamicCheckboxes = block.querySelector('.dynamic-checkboxes');
                                                        if (dynamicRadios) dynamicRadios.innerHTML = '';
                                                        if (dynamicCheckboxes) dynamicCheckboxes.innerHTML = '';
                                                    });
                                                }

                                                // 🗑️ УДАЛЕНИЕ блока по кнопке-мусорке
                                                const deleteBtn = block.querySelector('.bi-trash3')?.closest('button');
                                                if (deleteBtn) {
                                                    deleteBtn.addEventListener('click', () => {
                                                        block.remove();
                                                    });
                                                }
                                            });
                                        });
                                    </script>

                                </div>
                        </div>
                            <div class="card card-default">
                                <div class="card-header">
                                    <div class="form-group">
                                        <label for="foto_title">QR-code</label>
                                        <center><img src="{{$qrCodeData}}" style="width: 50%;" ></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default" >
                                <div class="card-header">
                                    <div class="form-group">
                                        <label for="foto_title"><a href="#" style="text-decoration: underline;" id="toggleLink">Посилання на соціальні мережі</a></label>
                                    </div>
                                </div>
                                <div class="card-header"  id="toggleContent"  style="display: none;">
                                    <div class="form-group">
                                        <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
                                            </svg></label>
                                        <input type="text" name="social_show_facebook"  class="form-control" value="{{$event->facebook_link}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"></path>
                                            </svg></label>
                                        <input type="text" name="social_show_instagram"  class="form-control" value="{{$event->social_show_instagram}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="social_show_facebook">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"></path>
                                            </svg>
                                        </label>
                                        <input type="text" name="social_show_youtube"  class="form-control" value="{{$event->youtube_link}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="social_show_facebook">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"></path>
                                            </svg>
                                        </label>
                                        <input type="text" name="social_show_telegram"  class="form-control" value="{{$event->elegram_link}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="social_show_facebook">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"></path>
                                            </svg>
                                        </label>
                                        <input type="text" name="social_show_x"  class="form-control" value="{{$event->x_link}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="allfoto">{{ __('translate.All photos') }}</label>

                                <!-- Инпут для загрузки новых фото -->
                                <div class="file-input-wrapper">
                                    <input type="file" name="allfoto[]" id="allfoto" class="form-control" multiple>
                                    <div class="file-input-label" id="fileInputLabelAll">Натисніть тут, щоб вибрати файл</div>
                                </div>

                                <!-- Превью ранее загруженных фото -->
                                <div id="existingPreview" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                                    @foreach ($latestFotos as $foto)
                                        @php
                                            $filePath = public_path('files/' . $event->user_id . '/' . $event->id . '/' . $foto->title);
                                        @endphp

                                        @if (file_exists($filePath))
                                            <div class="image-preview" style="position: relative; display: inline-block; margin: 5px;">
                                                <img src="{{ asset('files/' . $event->user_id . '/' . $event->id . '/' . $foto->title) }}"
                                                     alt="{{ $foto->title }}"
                                                     style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                                                <button type="button"
                                                        class="delete-existing-foto"
                                                        data-foto-id="{{ $foto->id }}"
                                                        style="position: absolute; top: -8px; right: -8px; background-color: #ff4d4d; color: #fff;
                           border: none; padding: 6px; border-radius: 50%; cursor: pointer; font-size: 14px; width:29px;
                           box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                                                    X
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <!-- Превью новых выбранных файлов -->
                                <div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;"></div>
                            </div>
                            <script>
                                // Отображение новых выбранных файлов
                                document.getElementById('allfoto').addEventListener('change', function (event) {
                                    const files = Array.from(event.target.files);
                                    const previewContainer = document.getElementById('preview');
                                    const fileInputLabel = document.getElementById('fileInputLabelAll');

                                    previewContainer.innerHTML = ''; // очищаем контейнер новых превью

                                    if (files.length === 0) {
                                        fileInputLabel.textContent = 'Натисніть тут, щоб вибрати файл';
                                        return;
                                    }

                                    const fileNames = files.map(file => file.name).join(', ');
                                    fileInputLabel.textContent = fileNames;

                                    files.forEach(file => {
                                        if (!file.type.startsWith('image/')) return;

                                        const reader = new FileReader();

                                        reader.onload = function (e) {
                                            const wrapper = document.createElement('div');
                                            wrapper.style.position = 'relative';
                                            wrapper.style.display = 'inline-block';
                                            wrapper.style.margin = '5px';

                                            const img = document.createElement('img');
                                            img.src = e.target.result;
                                            img.alt = file.name;
                                            img.style.width = '130px';
                                            img.style.height = '100px';
                                            img.style.objectFit = 'cover';
                                            img.style.border = '1px solid #ddd';
                                            img.style.borderRadius = '5px';

                                            const deleteBtn = document.createElement('button');
                                            deleteBtn.textContent = 'X';
                                            deleteBtn.style.position = 'absolute';
                                            deleteBtn.style.top = '-8px';
                                            deleteBtn.style.right = '-8px';
                                            deleteBtn.style.backgroundColor = '#ff4d4d';
                                            deleteBtn.style.color = '#fff';
                                            deleteBtn.style.border = 'none';
                                            deleteBtn.style.padding = '6px';
                                            deleteBtn.style.borderRadius = '50%';
                                            deleteBtn.style.cursor = 'pointer';
                                            deleteBtn.style.fontSize = '14px';
                                            deleteBtn.style.width = '30px';
                                            deleteBtn.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';


                                            deleteBtn.addEventListener('click', () => {
                                                wrapper.remove();
                                                const remainingFiles = Array.from(previewContainer.children).map(child => child.querySelector('img').alt);
                                                fileInputLabel.textContent = remainingFiles.join(', ') || 'Натисніть тут, щоб вибрати файл';
                                            });

                                            wrapper.appendChild(img);
                                            wrapper.appendChild(deleteBtn);
                                            previewContainer.appendChild(wrapper);
                                        };

                                        reader.readAsDataURL(file);
                                    });
                                });

                                // Удаление уже загруженных фото
                                document.addEventListener('click', function (e) {
                                    if (e.target.classList.contains('delete-existing-foto')) {
                                        const fotoId = e.target.dataset.fotoId;

                                        if (confirm('Ви впевнені, що хочете видалити це фото?')) {
                                            fetch(`/admin/events/foto/${fotoId}/delete`, {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json',
                                                }
                                            })
                                                .then(res => res.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        e.target.parentElement.remove();
                                                    } else {
                                                        alert('Помилка: ' + data.error);
                                                    }
                                                })
                                                .catch(err => {
                                                    alert('Помилка при видаленні');
                                                    console.error(err);
                                                });
                                        }
                                    }
                                });
                            </script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    </div>
                </div>
            </div>
            <br>
                <button type="button" class="btn btn-primary fixed-create-button" onclick="submitForm()">{{ __('translate.Save') }}</button>
            </div>
        </form>
    </div>
</div>
<script>
    function submitForm() {
        const start = 4;
        const end = 13;
        const fields = [];
        const output = [];

        for (let id = start; id <= end; id++) {
            const block = document.querySelector(`.form-group[data-unique-id="${id}"]`);
            if (!block) continue;

            const elements = block.querySelectorAll('input, textarea, select');

            elements.forEach(el => {
                const name = el.name || '(без имени)';
                const tag = el.tagName.toLowerCase();
                const type = el.type;
                const value = el.value;

                // Сохраняем обычные поля
                if (tag === 'input' || tag === 'textarea') {
                    if (type === 'checkbox') {
                        if (el.checked) {
                            fields.push({ key: id, value: value, variant: id });
                        }
                    } else if (type === 'radio') {
                        if (el.checked) {
                            fields.push({ key: id, value: value, variant: id });
                        }
                    } else {
                        if (name === `block_${id}` && value) {
                            fields.push({ key: id, value: value });
                        }
                        if (name === `block_${id}_${id}` && value) {
                            fields.push({ key: id, value: value, variant: id });
                        }
                    }
                }

                // Обрабатываем <select>
                else if (tag === 'select') {
                    const options = el.options;
                    for (let i = 0; i < options.length; i++) {
                        const opt = options[i];
                        const val = opt.value || opt.text;

                        // Все варианты (вариант списка)
                        fields.push({ key: id, value: val, variant: parseInt(block.dataset.variant || id) });

                        // Отдельно выбранные
                        if (opt.selected) {
                            fields.push({ key: id, value: val });
                        }
                    }
                }
            });

            // Особый случай block_12-12
            if (id === 12) {
                const special = document.querySelector(`[name="block_12-12"]`);
                if (special && special.value) {
                    fields.push({ key: 12, value: special.value, variant: 12 });
                }
            }
        }

        // Сохраняем в скрытое поле
        const hidden = document.getElementById('add_fields_test');
        if (hidden) {
            hidden.value = JSON.stringify(fields);
        }
document.getElementById('updateForm').submit();
        console.log('Собрано в add_fields_test:', fields);
    }
</script>

{{--<script>--}}
{{--    function submitForm() {--}}
{{--        const start = 4;--}}
{{--        const end = 13;--}}
{{--        let output = [];--}}
{{--        let fields = [];--}}

{{--        for (let id = start; id <= end; id++) {--}}
{{--            const block = document.querySelector(`.form-group[data-unique-id="${id}"]`);--}}
{{--            if (!block) continue;--}}

{{--            let blockOutput = [`Блок #${id}`];--}}
{{--            const elements = block.querySelectorAll('input, textarea, select');--}}

{{--            elements.forEach(el => {--}}
{{--                const name = el.name || '(без имени)';--}}
{{--                const tag = el.tagName.toLowerCase();--}}
{{--                const type = el.type;--}}

{{--                // SELECT--}}
{{--                if (tag === 'select') {--}}
{{--                    const options = el.options;--}}
{{--                    let allOptions = [];--}}
{{--                    let selectedOptions = [];--}}

{{--                    for (let i = 0; i < options.length; i++) {--}}
{{--                        const val = options[i].value || options[i].text;--}}
{{--                        const text = options[i].text;--}}
{{--                        allOptions.push(`- ${val} (${text})`);--}}

{{--                        if (options[i].selected) {--}}
{{--                            selectedOptions.push(val);--}}
{{--                            fields.push({ key: id, value: val, variant: id });--}}
{{--                        }--}}
{{--                    }--}}

{{--                    blockOutput.push(`Поле <select> [${name}]`);--}}
{{--                    blockOutput.push(`  Все опции:\n${allOptions.join('\n')}`);--}}
{{--                    blockOutput.push(`  Выбрано: ${selectedOptions.join(', ') || '(ничего не выбрано)'}`);--}}
{{--                }--}}

{{--                // CHECKBOX--}}
{{--                else if (type === 'checkbox') {--}}
{{--                    blockOutput.push(`Чекбокс [${name}] — значение: "${el.value}" — ${el.checked ? 'ОТМЕЧЕН' : 'не отмечен'}`);--}}
{{--                    if (el.checked) {--}}
{{--                        fields.push({ key: id, value: el.value, variant: id });--}}
{{--                    }--}}
{{--                }--}}

{{--                // RADIO--}}
{{--                else if (type === 'radio') {--}}
{{--                    blockOutput.push(`Радиокнопка [${name}] — значение: "${el.value}" — ${el.checked ? 'ВЫБРАНА' : 'не выбрана'}`);--}}
{{--                    if (el.checked) {--}}
{{--                        fields.push({ key: id, value: el.value, variant: id });--}}
{{--                    }--}}
{{--                }--}}

{{--                // INPUT/TEXTAREA/TIME/DATE/RANGE--}}
{{--                else {--}}
{{--                    blockOutput.push(`${name}: ${el.value}`);--}}
{{--                    if (name === `block_${id}` && el.value) {--}}
{{--                        fields.push({ key: id, value: el.value });--}}
{{--                    }--}}
{{--                    if (name === `block_${id}_${id}` && el.value) {--}}
{{--                        fields.push({ key: id, value: el.value, variant: id });--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}

{{--            // Особый случай block_12-12--}}
{{--            if (id === 12) {--}}
{{--                const special = document.querySelector(`[name="block_12-12"]`);--}}
{{--                if (special && special.value) {--}}
{{--                    fields.push({ key: 12, value: special.value, variant: 12 });--}}
{{--                }--}}
{{--            }--}}

{{--            output.push(blockOutput.join('\n'));--}}
{{--        }--}}

{{--        // Запись JSON в скрытое поле--}}
{{--        const hidden = document.getElementById('add_fields_test');--}}
{{--        if (hidden) {--}}
{{--            hidden.value = JSON.stringify(fields);--}}
{{--        }--}}

{{--        // Консоль отладка--}}
{{--        console.log(output.join('\n\n'));--}}
{{--        console.log('Собрано в add_fields_test:', fields);--}}

{{--        // Отправка формы--}}
{{--        //document.getElementById('updateForm').submit();--}}
{{--    }--}}
{{--</script>--}}



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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




<script>
    function displaySelectedFiles(input) {
        var selectedFilesDiv = document.getElementById('selectedFiles');
        selectedFilesDiv.innerHTML = '';
        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var fileName = input.files[i].name;
                var fileDiv = document.createElement('div');
                fileDiv.textContent = fileName;
                selectedFilesDiv.appendChild(fileDiv);
            }
        }
    }
    const allFotoFiles = document.querySelectorAll('.file-input-wrapper .file-name');
    for (const file of allFotoFiles) {
        file.addEventListener('click', (event) => {
            const fileName = event.target.textContent;
            console.log(fileName);
        });
    }
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
        var discountPanel = document.getElementById("discount_panel");
        var fotoPanelTu = document.getElementById("currency_panel");

        if (selectElement.value === "1") {
            fotoPanel.style.display = "block";
            discountPanel.style.display = "block";
            fotoPanelTu.style.display = "block";
        } else {
            fotoPanel.style.display = "none";
            fotoPanelTu.style.display = "none";
            discountPanel.style.display = "none";
        }
    }
    showHidePanel();
    $(document).ready(function() {
        var fileNamesString = "{{$latestFotosString}}";
        var fileNamesArray = fileNamesString.split(',');
        var userId = "{{$event->user_id}}";
        var eventId = "{{$event->id}}";
        var basePath = "/files/" + userId + "/" + eventId + "/";
        var fileNamesContainer = $("#fileNamesContainer").addClass('image-grid');

        fileNamesArray.forEach((fileName, index) => {
            fileName = fileName.trim();
            var fullPath = basePath + fileName;
            var imgWrapper = $("<div></div>").addClass("img-wrapper").attr("id", "wrapper-" + index);
            var img = $("<img>").attr("src", fullPath).addClass("responsive-image");
            var deleteCheckbox = $("<input>").attr("type", "checkbox")
                .attr("name", "deleteImages[]")
                .val(fileName);
            var checkboxLabel = $("<label>").text("").prepend(deleteCheckbox);

            imgWrapper.append(img).append(checkboxLabel);
            fileNamesContainer.append(imgWrapper);
        });
    });
</script>
<script>
    document.getElementById('toggleLink').addEventListener('click', function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение ссылки
        var content = document.getElementById('toggleContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
            this.textContent = 'Закрити';
        } else {
            content.style.display = 'none';
            this.textContent = 'Посилання на соціальні мережі';
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Инициализация состояния панелей
        var checkbox1 = document.getElementById('customCheckbox1');
        var panel1 = document.getElementById('panel1');
        panel1.style.display = checkbox1.checked ? 'block' : 'none';

        var checkbox2 = document.getElementById('customCheckbox2');
        var panel2 = document.getElementById('panel2');
        panel2.style.display = checkbox2.checked ? 'block' : 'none';

        // Слушаем изменения для чекбокса customCheckbox1
        checkbox1.addEventListener('change', function() {
            panel1.style.display = this.checked ? 'block' : 'none';
        });

        // Слушаем изменения для чекбокса customCheckbox2
        checkbox2.addEventListener('change', function() {
            panel2.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
<script>
    function removeField(index) {
        // Идентификатор строки таблицы, который мы хотим найти и удалить
        var fieldRowId = 'formFile_' + index;
        // Получаем элемент строки таблицы по идентификатору
        var fieldRow = document.getElementById(fieldRowId);
        // Если элемент найден, удаляем его
        if (fieldRow) {
            fieldRow.parentNode.removeChild(fieldRow);
        } else {
            // Если элемент не найден, выводим сообщение об ошибке
            console.error('Не удалось найти строку с ID:', fieldRowId);
        }
    }
</script>
<script>
    $(document).ready(function () {
        let uniqueIdCounter = 1; // Initialize counter for unique IDs
        let variantCounter = 1; // Уникальный счетчик variant для всех блоков

        function updateHiddenField() {
            let currentFields = $('#additional_fields').val();
            let fields = currentFields ? JSON.parse(currentFields) : [];

            $('#dynamicFieldsContainer .form-group').each(function () {
                const uniqueId = $(this).data('unique-id');
                const variant = $(this).data('variant'); // Получаем уже установленный variant
                const label = $(this).find('label').text().trim();
                let value = '';

                // Получаем значения из полей
                if ($(this).find('select').length > 0) {
                    value = $(this).find('select option:selected').map(function () {
                        return $(this).text().trim();
                    }).get().join(', ');
                } else if ($(this).find('input[type="checkbox"]:checked').length > 0) {
                    value = $(this).find('input[type="checkbox"]:checked').map(function () {
                        return $(this).parent().text().trim();
                    }).get().join(', ');
                } else if ($(this).find('input[type="radio"]:checked').length > 0) {
                    value = $(this).find('input[type="radio"]:checked').map(function () {
                        return $(this).parent().text().trim();
                    }).get().join(', ');
                } else {
                    value = $(this).find('input, textarea').val() || ''; // Текстовые поля
                }

                if (label && value) {
                    // Проверяем, существует ли уже запись с данным key и variant
                    let existingField = fields.find(field => field.key === uniqueId && field.variant === variant);

                    if (existingField) {
                        existingField.value = value; // Обновляем значение
                    } else {
                        fields.push({ key: uniqueId, value: value, variant: variant }); // Добавляем новую запись
                    }
                }
            });


            $('#additional_fields').val(JSON.stringify(fields));
            console.log('Updated hidden field:', fields);
        }

        $(document).on('click', '.add-new-block', function () {
            const newBlockId = uniqueIdCounter++; // Уникальный ID блока
            const blockVariant = variantCounter++; // Уникальный variant для блока

            $('#dynamicFieldsContainer').append(`
            <div class="form-group" id="pole_${newBlockId}" data-unique-id="${newBlockId}" data-variant="${blockVariant}">
                <label>Введите название блока:</label>
                <input type="text" class="form-control dynamic-input" name="name_block_${newBlockId}" placeholder="Введите название блока">
                <!-- Добавьте остальные элементы блока -->
            </div>
        `);

            console.log(`Добавлен блок с ID=${newBlockId} и variant=${blockVariant}`);
        });

        $(document).on('click', '.dropdown-item', function () {
            // Получаем родительский элемент dropdown
            const dropdownParent = $(this).closest('.btn-group');

            // Ищем ближайший form-group с ID, начинающимся на "pole_"
            const formGroup = dropdownParent.closest('.form-group[id^="pole_"]');

            if (formGroup.length > 0) {
                // Устанавливаем значение variant в 1
                formGroup.attr('data-variant', 1); // Устанавливаем атрибут
                formGroup.data('variant', 1); // Обновляем значение в jQuery

                // Логируем данные
                console.log(
                    `Variant для блока с ID=${formGroup.attr('id')} и uniqueId=${formGroup.data('unique-id')} установлен на 1`
                );
            } else {
                console.error('Не удалось найти form-group с ID, начинающимся на "pole_".');
            }

            // Обновляем скрытое поле
            updateHiddenField();
        });

        // События добавления и изменения полей
        $(document).on('input change', '#dynamicFieldsContainer input, #dynamicFieldsContainer textarea, #dynamicFieldsContainer select', function () {
            updateHiddenField();
        });

        // Обработчик добавления новых полей
        $(document).on('click', '.dropdown-item', function () {
            var selectedOption = $(this).text().trim();
            var newField = '';


            if (selectedOption === 'Текст (строка)') {
                newField = `
    <div class="form-group" id="pole_4" data-unique-id="4">
 <input type="text" id="word" class="form-control dynamic-input" name="name_block_4" placeholder="Введите название блока">
        <label>Введите текст (строка):</label>
        <input type="text" class="form-control dynamic-input" placeholder="Введите текст">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button>
<div class="form-check form-switch">
                                      </div>
    </div>`;
            } else if (selectedOption === 'Текст (абзац)') {
                newField = `
    <div class="form-group" id="pole_5" data-unique-id="5">
 <input type="text" id="word" class="form-control dynamic-input" name="name_block_5" placeholder="Введите название блока">
        <label>Введите текст (абзац):</label>
        <textarea class="form-control dynamic-textarea" rows="3" placeholder="Введите абзац текста"></textarea>
    </div>`;
            } else if (selectedOption === 'Один из списка') {
                newField = `
                <div class="form-group" id="pole_6" data-unique-id="6">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_6" placeholder="Введите название блока">
                    <label>Выбор одного из списка:</label>
                    <select class="form-control dynamic-select">
                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>
                </div>`;
            } else if (selectedOption === 'Несколько из списка') {
                newField = `
                <div class="form-group" id="pole_7" data-unique-id="7">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_7" placeholder="Введите название блока">
                    <label>Выбор из нескольких вариантов:</label>
                    <select class="form-control dynamic-select" multiple>

                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Раскрывающийся список') {
                newField = `
                <div class="form-group" id="pole_8" data-unique-id="8">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_8" placeholder="Введите название блока">
                    <label>Раскрывающийся список:</label>
                    <select class="form-control dynamic-select">

                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Сетка(множественный выбор)') {
                newField = `
                <div class="form-group" id="pole_9" data-unique-id="9">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_9" placeholder="Введите название блока">
                    <label>Сетка с множественным выбором:</label>
                    <div class="dynamic-checkboxes">

                    </div>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-checkbox-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Сетка флажков') {
                newField = `
                <div class="form-group" id="pole_10" data-unique-id="10">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_10" placeholder="Введите название блока">
                    <label>Сетка флажков:</label>
                    <div class="dynamic-radios">

                    </div>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-radio-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button>
 <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Дата') {
                newField = `
    <div class="form-group" id="pole_11" data-unique-id="11">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_11" placeholder="Введите название блока">
        <label>Выберите дату:</label>
        <input type="date" class="form-control dynamic-date">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>

    </div>`;
            } else if (selectedOption === 'Время') {
                newField = `
    <div class="form-group" id="pole_12" data-unique-id="12">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_12" placeholder="Введите название блока">
        <label>Выберите время:</label>
        <input type="time" class="form-control dynamic-time">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>

    </div>`;
            } else if (selectedOption === 'Шкала') {
                newField = `
    <div class="form-group" id="pole_13" data-unique-id="13">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_13" placeholder="Введите название блока">
        <label>Укажите значение шкалы:</label>
        <input type="range" class="form-control dynamic-range range-input" min="0" max="100" value="50">
        <span class="range-value">50</span>
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
    </div>`;
            }

            if (newField) {
                $('#dynamicFieldsContainer').append(newField);

                // Блокируем все элементы в новом блоке, кроме поля с id="word"
                var newFormGroup = $('#dynamicFieldsContainer .form-group').last();
                newFormGroup.find(':input').not('#word').attr('disabled', true);

                updateHiddenField(); // Обновляем скрытое поле после добавления нового
            }


// Отслеживание изменений в полях с id="word" для всех блоков
            $(document).on('input', '#dynamicFieldsContainer .form-group #word', function () {
                var parentFormGroup = $(this).closest('.form-group'); // Находим родительский блок формы
                var isFieldEmpty = $(this).val().trim() === ''; // Проверяем, пустое ли поле

                if (isFieldEmpty) {
                    // Если поле пустое, блокируем остальные элементы блока
                    parentFormGroup.find(':input').not(this).attr('disabled', true);
                } else {
                    // Если поле заполнено, разблокируем остальные элементы
                    parentFormGroup.find(':input').not(this).attr('disabled', false);
                }
            });

        });

        $(document).on('click', '.add-option-button', function () {
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Используем variant блока
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();

            if (newOption) {
                const select = formGroup.find('.dynamic-select');
                if (!select.find(`option:contains(${newOption})`).length) {
                    select.append(`<option>${newOption}</option>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });



        $(document).on('click', '.add-option-checkbox-button', function () {
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();
            const container = $(this).closest('.form-group').find('.dynamic-checkboxes');
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Получаем variant

            if (newOption) {
                if (!container.find(`label:contains(${newOption})`).length) {
                    container.append(`<label><input type="checkbox"> ${newOption}</label>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });




        $(document).on('click', '.add-option-radio-button', function () {
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();
            const container = $(this).closest('.form-group').find('.dynamic-radios');
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Получаем variant

            if (newOption) {
                if (!container.find(`label:contains(${newOption})`).length) {
                    container.append(`<label><input type="radio" name="${uniqueId}"> ${newOption}</label>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });



        $(document).on('input', '.dynamic-input, .dynamic-textarea', function () {
            var parentFormGroup = $(this).closest('.form-group');
            var uniqueId = parentFormGroup.data('unique-id'); // Уникальный ID блока
            var variant = parentFormGroup.data('variant'); // Уникальный variant блока
            var value = $(this).val().trim(); // Значение поля

            let currentFields = $('#additional_fields').val();
            let fields = currentFields ? JSON.parse(currentFields) : [];

            // Проверяем существование записи
            let existingField = fields.find(field => field.key === uniqueId && field.variant === variant);

            if (existingField) {
                existingField.value = value; // Обновляем значение
            } else {
                fields.push({ key: uniqueId, value: value, variant: variant }); // Добавляем новое значение
            }

            $('#additional_fields').val(JSON.stringify(fields));
            console.log('Обновлено скрытое поле:', fields);
        });



        // Обновление значения шкалы
        $(document).on('input', '.range-input', function () {
            $(this).siblings('.range-value').text($(this).val());
            updateHiddenField();
        });
    });

</script>


</body>
</html>



