<footer class="main-footer">
    <!-- Кнопка WhatsApp -->


    <div class="float-right d-none d-sm-block" >
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2024 Eventhes.com</strong> All rights reserved.
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('storage/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('storage/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('storage/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('storage/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- Moment.js -->
<script src="{{ asset('storage/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('storage/AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- Daterangepicker -->
<script src="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Bootstrap Colorpicker -->
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('storage/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('storage/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('storage/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- DropzoneJS -->
<script src="{{ asset('storage/AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- FullCalendar -->
<script src="{{ asset('storage/AdminLTE/plugins/fullcalendar/main.js') }}"></script>
<!-- Custom Scripts -->
<script src="{{ asset('storage/css/sidebar.js') }}"></script>


<!-- Скрипт календаря записи-->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $('.bi-question-circle').on('click', function () {
            $(this).tooltip('show');
        });

        $('.bi-question-circle').on('mouseleave', function () {
            $(this).tooltip('hide');
        });
    });

    $(function () {

        // Переключение отображения поля интервала
        $('#isInterval').on('change', function () {
            if ($(this).is(':checked')) {
                $('#intervalSettings').removeClass('d-none');
            } else {
                $('#intervalSettings').addClass('d-none');
            }
        });

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                };
            }
        });

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        @if(isset($events))
        var events = @json($events);
        @else
        var events = [];
        @endif

        @if(isset($markers))
        var markers = @json($markers);
        @else
        var markers = [];
        @endif

        @if(isset($details))
        var sheduleDetails = @json($details);
        @else
        var sheduleDetails = [];
        @endif



        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: events,
            editable: true,
            droppable: true,
            selectable: true,

            eventTimeFormat: false, // ❌ отключаем "9a", "12a"

            eventContent: function(arg) {
                let type = arg.event.extendedProps.marker_type || arg.event.title;
                let dotColor = type === 'Зачинено' ? '#dc3545' : // красный
                    type === 'Вихідний' ? '#ffc107' : // жёлтый
                        arg.event.backgroundColor || '#3788d8'; // по умолчанию

                return {
                    html: `
            <div class="fc-event-title-container" style="display: flex; align-items: center;">
                <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background-color:${dotColor};margin-right:6px;"></span>
                <div class="fc-event-title fc-sticky">${arg.event.title}</div>
            </div>
        `
                };
            },




            eventDidMount: function(info) {
                const eventId = String(info.event.id);
                const dateStr = info.event.startStr.split('T')[0];

                console.log("== eventDidMount ==");
                console.log("eventId:", eventId);
                console.log("event dateStr:", dateStr);
                console.log("markers:", markers);
            },

            // При клике по дню – открываем форму
            select: function(info) {
                $('#scheduleModal').modal('show');

                // Получаем только дату
                const dateStr = info.startStr.split('T')[0];
                $('#reserv_date').val(dateStr); // записываем в скрытое поле

                // Сброс формы
                $('#scheduleForm')[0].reset();

                // Установка дефолтных значений
                $('#scheduleForm input[name="reserv_start"]').val('09:00');
                $('#scheduleForm input[name="reserv_end"]').val('18:00');
                $('#scheduleForm input[name="interval_minutes"]').val('60');
                $('#isInterval').prop('checked', false);
                $('#intervalSettings').addClass('d-none');
                // Получаем shedule_id из data-атрибута <div id="calendar" data-shedule-id="...">
                let sheduleId = $('#calendar').data('shedule-id');

// Записываем его в скрытое поле формы
                $('#shedule_id').val(sheduleId);

            },

            eventClick: function(info) {
                // не переходить по ссылке
                info.jsEvent.preventDefault();

                // дата именно той ячейки, где лежит событие в представлении Month
                let cellDate =
                    (info.el.closest('.fc-daygrid-day') && info.el.closest('.fc-daygrid-day').getAttribute('data-date')) ||
                    (info.el.closest('[data-date]') && info.el.closest('[data-date]').getAttribute('data-date')) ||
                    (info.event.startStr ? info.event.startStr.split('T')[0] : '');

                // заполняем модалку
                $('#em-title').text(info.event.title || '(без назви)');
                $('#em-date').text(cellDate ? formatUA(cellDate) : '—');
                $('#em-event-id').val(info.event.id || '');
                $('#em-date-iso').val(cellDate || '');

                // показать
                $('#eventModal').modal('show');
            },

            // ✅ Правильное добавление события из "draggable"
            eventReceive: function(info) {
                const title = info.event.title;
                const fullDateTime = info.event.startStr;
                const date = fullDateTime.split('T')[0]; // только дата
                const backgroundColor = info.event.backgroundColor || '#3788d8';
                const textColor = info.event.textColor || '#fff';

                // Обновим стиль
                info.event.setProp('backgroundColor', backgroundColor);
                info.event.setProp('borderColor', backgroundColor);
                info.event.setProp('textColor', textColor);

                // Собираем связанные события на эту дату
                let relatedEventIds = [];
                events.forEach(event => {
                    if (!event.start || !event.end) return;
                    let start = event.start.split('T')[0];
                    let end = event.end.split('T')[0];
                    if (date >= start && date <= end && event.id) {
                        relatedEventIds.push(event.id);
                    }
                });

                // ✅ Отправка на сервер
                $.ajax({
                    url: '{{ route("admin.markers.store") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        reserv_date: date, // ✅ Правильное имя поля
                        marker_type: title,
                        event_ids: relatedEventIds
                    },

                    success: function (response) {
                        console.log('Маркер успешно добавлен');
                        markers.push({
                            id: response.id, // если возвращаешь ID из контроллера
                            date: date,
                            marker_type: title,
                            event_ids: relatedEventIds
                        });

// Принудительно обновляем отображение календаря
                        calendar.rerenderDates(); // ✅ это важно!
                        console.log('[DEBUG] Проверка маркера:', marker.date, '==', cellDate);

                    },
                    error: function (xhr) {
                        console.error('Ошибка при сохранении маркера:', xhr.responseText);
                    }
                });

                // Удаляем из блока draggable (если стоит флажок)
                var checkbox = document.getElementById('drop-remove');
                if (checkbox && checkbox.checked) {
                    info.draggedEl.remove();
                }
            }
        });

        function formatUA(dateISO){
            const d = new Date(dateISO + 'T00:00:00'); // без влияния TZ
            return d.toLocaleDateString('uk-UA', {
                weekday: 'short', year: 'numeric', month: 'long', day: 'numeric'
            });
        }

        calendar.render();

        $('#scheduleForm').on('submit', function (e) {
            e.preventDefault();

            let selectedDate = $('#reserv_date').val();

            // Собираем ID событий, которые попадают на выбранную дату
            let selectedEventIds = [];
            events.forEach(event => {
                if (!event.start || !event.end) return;

                let start = event.start.split('T')[0];
                let end = event.end.split('T')[0];

                if (selectedDate >= start && selectedDate <= end && event.id) {
                    selectedEventIds.push(event.id);
                }
            });

            let formData = $(this).serializeArray();
            selectedEventIds.forEach(function (id) {
                formData.push({ name: 'event_ids[]', value: id });
            });

            $.ajax({
                url: '{{ route('shedules.details.store') }}',
                method: 'POST',
                data: formData,
                success: function (response) {
                    alert('Запись добавлена');
                    calendar.refetchEvents?.();
                    $('#scheduleModal').modal('hide');
                },
                error: function (xhr) {
                    alert('Ошибка при сохранении');
                }
            });
        });


        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color'    : currColor
            })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })
    })

    new DataTable('#example', {
        order: [[3, 'desc']]
    });

</script>
<!-- Другие скрипты -->
</body>
</html>
</body>
</html>





