@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Inline Charts') }} - <a href="https://vimeo.com/924351429" target="_blank">(help)</a> -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('admin.shedules.store') }}">
                        @csrf
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ __('translate.Event date') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>{{ __('translate.Date') }}:</label>
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" class="form-control" id="reserv" name="reserv" autocomplete="off">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">{{ __('translate.Select date') }}</button>
                                    </div>
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ __('translate.Enter values') }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-body">{{ __('translate.Start date') }}
                                                        <div class="form-group row" id="start_date">
                                                            <div class="col">
                                                                <label for="year">{{ __('translate.Year') }}:</label>
                                                                <select class="form-control" id="year">
                                                                    @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                                                        <option>{{ $year }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="month">{{ __('translate.Month') }}:</label>
                                                                <select class="form-control" id="month">
                                                                    @for ($month = 1; $month <= 12; $month++)
                                                                        <option>{{ $month }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="day">{{ __('translate.Day') }}:</label>
                                                                <select class="form-control" id="day">
                                                                    @for ($day = 1; $day <= 31; $day++)
                                                                        <option>{{ $day }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">{{ __('translate.End date') }}
                                                        <div class="form-group row" id="end_date">
                                                            <div class="col">
                                                                <label for="endyear">{{ __('translate.Year') }}:</label>
                                                                <select class="form-control" id="endyear">
                                                                    @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                                                        <option>{{ $year }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="endmonth">{{ __('translate.Month') }}:</label>
                                                                <select class="form-control" id="endmonth">
                                                                    @for ($month = 1; $month <= 12; $month++)
                                                                        <option>{{ $month }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="endday">{{ __('translate.Day') }}:</label>
                                                                <select class="form-control" id="endday">
                                                                    @for ($day = 1; $day <= 31; $day++)
                                                                        <option>{{ $day }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translate.Close') }}</button>
                                                    <button type="button" class="btn btn-primary" id="saveChangesBtn">{{ __('translate.Save changes') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('translate.Schedule time') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('translate.Time') }} :</label>
                                <div class="input-group" >
                                    <input type="text" class="form-control" id="workDayInput" autocomplete="off">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModalTimeStartEndModal">{{ __('translate.Select time') }}</button>
                        </div>
                        <div class="modal fade" id="myModalTimeStartEndModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3">{{ __('translate.Event time') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="container">
                                                    <center>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                {{ __('translate.Monday') }}
                                                                <div class="col">
                                                                    <select name="reserv_start" id="reservStart" class="form-control">
                                                                        <option value="Start">{{ __('translate.Start') }}</option>
                                                                        @for ($hour = 0; $hour < 24; $hour++)
                                                                            @for ($minute = 0; $minute < 60; $minute += 60)
                                                                                @php
                                                                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                                                                @endphp
                                                                                <option value="{{ $time }}">{{ $time }}</option>
                                                                            @endfor
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col" style="margin-top:5px;">
                                                                    <select name="reserv_end" id="reservEnd" class="form-control">
                                                                        <option value="End">{{ __('translate.End') }}</option>
                                                                        @for ($hour = 0; $hour < 24; $hour++)
                                                                            @for ($minute = 0; $minute < 60; $minute += 60)
                                                                                @php
                                                                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                                                                @endphp
                                                                                <option value="{{ $time }}">{{ $time }}</option>
                                                                            @endfor
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            {{ __('translate.Close') }}
                                        </button>
                                        <button type="button" class="btn btn-primary" id="saveChangesBtnTime">{{ __('translate.Save changes') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-default" data-select2-id="29">
                <div class="card-header">
                    <h3 class="card-title">{{ __('translate.Type date') }}</h3>
                </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>{{ __('translate.Entries by date') }}:</label>
                                    <select class="form-control select2bs4 select2-hidden-accessible" name="mono"  style="width: 100%;" data-select2-id="20" tabindex="-1" aria-hidden="true">
                                        <option value="1">{{ __('translate.Some') }}</option>
                                        <option value="0">{{ __('translate.One') }}</option>
                                    </select>
                                       </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>{{ __('translate.Calendar') }}:</label>
                                    <select class="form-control select2bs4 select2-hidden-accessible" name="datapicker" style="width: 100%;" data-select2-id="25" tabindex="-1" aria-hidden="true">
                                        <option value="1">{{ __('translate.Yes') }}</option>
                                        <option value="0">{{ __('translate.No') }}</option>
                                    </select>
                                      </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">{{ __('translate.Operating mode') }}</h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="container">
                                                <center>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            {{ __('translate.Monday') }}
                                                            <div class="col">
                                                                <select name="time_work_start_mon" class="form-control">
                                                                    <option value="TimeStartMon">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_mon" class="form-control">
                                                                    <option value="TimeEndMon">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Tuesday') }}
                                                                <select name="time_work_start_tue" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_tue" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Wednesday') }}
                                                                <select name="time_work_start_wed" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_wed" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Thursday') }}
                                                                <select name="time_work_start_thu" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_thu" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Friday') }}
                                                                <select name="time_work_start_fri" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_fri" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Saturday') }}
                                                                <select name="time_work_start_sat" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_sat" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="col">
                                                                 {{ __('translate.Sunday') }}
                                                                <select name="time_work_start_sun" class="form-control">
                                                                    <option value="Start">{{ __('translate.Start') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col" style="margin-top:5px;">
                                                                <select name="time_work_end_sun" class="form-control">
                                                                    <option value="End">{{ __('translate.End') }}</option>
                                                                    @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 60)
                                                                            @php
                                                                                $time = sprintf("%02d:%02d", $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 10px;">
                <button type="submit"  class="btn btn-primary">{{ __('translate.Save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var saveChangesButtonTime = document.getElementById("saveChangesBtnTime");
        var workDayInput = document.getElementById("workDayInput");
        saveChangesButtonTime.addEventListener("click", function() {
            var startTimeSelect = document.getElementById("reservStart");
            var endTimeSelect = document.getElementById("reservEnd");
            if (startTimeSelect && endTimeSelect) {
                var startTime = startTimeSelect.value;
                var endTime = endTimeSelect.value;
                var schedule = "Начало: " + startTime + ", Конец: " + endTime;
                workDayInput.value = schedule;
                $('#myModalTimeStartEndModal').modal('hide');
            } else {
                console.error("Не удалось найти один из селектов времени.");
            }
        });
    });
    function updateReservValue() {
        var startYear = document.getElementById('year').value;
        var startMonth = document.getElementById('month').value;
        var startDay = document.getElementById('day').value;
        var endYear = document.getElementById('endyear').value;
        var endMonth = document.getElementById('endmonth').value;
        var endDay = document.getElementById('endday').value;
        var startDate = startYear + '-' + startMonth + '-' + startDay;
        var endDate = endYear + '-' + endMonth + '-' + endDay;
        document.getElementById('reserv').value = 'Start date: ' + startDate + ' | End date: ' + endDate;
    }
    document.getElementById('saveChangesBtn').addEventListener('click', function() {
        updateReservValue();
        $('#myModal').modal('hide');
    });
    document.getElementById('reserv').addEventListener('click', function() {
        $('#myModal').modal('show');
    });
</script>
<br>
@include('admin.footer_adm')

