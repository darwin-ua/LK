
@include('admin.header_adm')
<style>
    .fc-marker, .fc-detail {
        font-size: 11px;
        margin-top: 2px;
        display: inline-block;
        padding: 2px 5px;
        border-radius: 4px;
    }

    .fc-event, .fc-daygrid-event { cursor: pointer; }

</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">

                            <div class="card-body">
                                <!-- the events -->
                                <div id="external-events">
{{--                                    <div class="external-event bg-success">Lunch</div>--}}
                                    <div class="external-event bg-warning">Можливо</div>
                                    <div class="external-event bg-info">Частково</div>
                                    <div class="external-event bg-primary">Вихідний</div>
                                    <div class="external-event bg-danger">Зачинено</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            remove after drop
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            @if ($activeShedule)
                                <div id="calendar" data-shedule-id="{{ $activeShedule->id }}"></div>
                            @else
                                <div class="alert alert-warning">Нет доступных расписаний</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Модальное окно -->

<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="scheduleForm" method="POST" action="{{ route('admin.shedule.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Создать расписание</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="shedule_id" id="shedule_id" value="">

                    <!-- Скрытое поле с выбранной датой -->
                    <input type="hidden" name="reserv_date" id="reserv_date">

                    <div class="form-group">
                        <label>Время начала</label>
                        <input type="time" name="reserv_start" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Время окончания</label>
                        <input type="time" name="reserv_end" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Тип</label>
                        <select name="status" class="form-control">
                            <option value="available">Свободно</option>
                            <option value="busy">Занято</option>
                        </select>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="isInterval" name="is_interval">
                        <label class="form-check-label" for="isInterval">Создать интервально</label>
                    </div>

                    <div class="form-group d-none" id="intervalSettings">
                        <label>Длительность интервала (в минутах)</label>
                        <input type="number" name="interval_minutes" class="form-control" value="60" min="5" step="5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal: настройки выбранного события -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Налаштування події</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="mb-2"><strong>Назва:</strong> <span id="em-title"></span></div>
                <div class="mb-2"><strong>Дата:</strong> <span id="em-date"></span></div>

                <!-- пригодится для будущих действий -->
                <input type="hidden" id="em-event-id">
                <input type="hidden" id="em-date-iso">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                <!-- кнопку Зберегти добавишь позже, когда появятся настройки -->
            </div>
        </div>
    </div>
</div>

<script>
    var markers = @json($markers);
    var sheduleDetails = @json($details);
</script>

@include('admin.footer_adm')

