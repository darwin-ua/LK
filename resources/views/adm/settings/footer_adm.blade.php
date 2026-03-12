<footer class="main-footer">


    <div class="float-right d-none d-sm-block" >
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2024 Eventhes.com</strong> All rights reserved.
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


        // Инициализация календаря
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: events, // Подключаем события из Laravel
            editable: true,
            droppable: true, // Разрешаем перетаскивание
            drop: function(info) {
                var checkbox = document.getElementById('drop-remove');
                if (checkbox && checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        calendar.render();

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





