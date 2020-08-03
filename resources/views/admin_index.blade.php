

      



    
    
  
    @extends('layouts.app')
    @section('content')

     @include('modal-calendar')
    <div class="container">
    <div class="row justify-content-center">

        <!-- left -->
       

        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><i class="fas fa-id-card"></i> 予約カレンダー管理画面</div>
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    </div>
                @endif


            

                    <div id='external-events'>
                       

                        

                        <p style="display:none;">
                   <input type='checkbox' id='drop-remove' />
                           <label for='drop-remove'>remove after drop</label>
                        </p>
                    </div>

                  


                    <div id='calendar-container'>
                       <div id='calendar'
                        data-route-load-events="{{ route('routeLoadEvents') }}"
                        data-route-event-update="{{ route('routeEventUpdate') }}"
                        data-route-event-store="{{ route('routeEventStore') }}"
                        data-route-event-delete="{{ route('routeEventDelete') }}"

                        >
                       {{ csrf_field() }}

                       </div>
                   </div>
               </div><!-- end card-body -->
           </div><!-- end card -->
        </div>
    </div>
</div>
@endsection



    <script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <script src='js/script.js'></script>
    <script src="{{ asset('js/app.js') }}" defer></script>




   

    <script>

       



    document.addEventListener('DOMContentLoaded', function() {
   var Calendar = FullCalendar.Calendar;
   var Draggable = FullCalendarInteraction.Draggable;

   var containerEl = document.getElementById('external-events');
   var calendarEl = document.getElementById('calendar');
   var checkbox = document.getElementById('drop-remove');

  

    var calendar = new Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid','list' ],
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        allDaySlot: false,
        forceEventDuration : true,
        eventColor: 'lavender',
        defaultTimedEventDuration: '01:00',
        defaultView: 'timeGridWeek',
        slotDuration: '00:30:00',
        firstDay : 1,
        minTime : '10:00',
        maxTime : '20:10',
        locale : 'jaLocale',
        editable: true,
        selectable: true,
        allDaySlot: false,
        droppable: true, 
            buttonText: {
                today:'今日',
                month:'月',
                week: '週',
                day:  '日',
                list: 'リスト'
            },

           

            events: routeEvents('routeLoadEvents'),

        


        select: function (element) {

            clearMessages('#message');
            resetForm("#formEvent");


           $("#modalCalendar").modal('show');
           $("#modalCalendar #titleModal").text('新規追加');
           $("#modalCalendar button.deleteEvent").css("display","none");

           let start = moment(element.start).format("YYYY-MM-DD HH:mm:ss");
           $("#modalCalendar input[name='start']").val(start);

           let end = moment(element.end).format("YYYY-MM-DD HH:mm:ss");
           $("#modalCalendar input[name='end']").val(end);

           $("#modalCalendar input[name='color']").val('#3788D8');

           calendar.unselect();

        },

        eventReceive: function(info) {
            // イベントがexternal-eventからドロップされた時のコールバック
            console.log('eventReceive');
        },

        eventDrop: function(element) {
            let start =  moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end =  moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

            let newEvent = {
                _method:'PUT',
                title: element.event.title,
                id: element.event.id,
                start: start,
                end: end
            };

        sendEvent(routeEvents('routeEventUpdate'),newEvent);
        },
        eventClick: function(element){

            clearMessages('#message');

            resetForm("#formEvent");

           $("#modalCalendar").modal('show');
           $("#modalCalendar #titleModal").text('内容変更');
           $("#modalCalendar button.deleteEvent").css("display","flex");

           let id = element.event.id;
           $("#modalCalendar input[name='id']").val(id);

           let title = element.event.title;
           $("#modalCalendar input[name='title']").val(title);

           let nailist_id = element.event.extendedProps.nailist_id;
           $("#modalCalendar select[name='nailist_id']").val(nailist_id);

           let menu_id = element.event.extendedProps.menu_id;
           $("#modalCalendar select[name='menu_id']").val(menu_id);

           let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
           $("#modalCalendar input[name='start']").val(start);

           let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
           $("#modalCalendar input[name='end']").val(end);

           let color = element.event.backgroundColor;
           $("#modalCalendar input[name='color']").val(color);

           let reservations = element.event.extendedProps.reservations +'人';
           //$("#modalCalendar textarea[name='reservations']").val(reservations);
           $("#reservations-html").text(reservations);


          

        },

        eventResize: function(element) {
            // イベントがリサイズ（引っ張ったり縮めたり）された時のコールバック
            let start =  moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end =  moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

            let newEvent = {
                _method:'PUT',
                title: element.event.title,
                id: element.event.id,
                start: start,
                end: end
            };

            sendEvent(routeEvents('routeEventUpdate'),newEvent);

          
        },

     
    })


  calendar.render();
});



</script>
<style>

.fc-time{
    text-align : center;
}
.fc-title{
   text-align : center;
   margin-top:3px;

}
</style>