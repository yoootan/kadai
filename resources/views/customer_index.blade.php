
    @include('customer_app')
    <body>

     @include('customer-modal-calendar')
     @include('customer-modal-confirm')
     @include('finish-modal-calendar')
     
    <div class="container">

    <div class="row justify-content-center">

       
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"></i>ネイルサロン予約フォーム  <a href="/admin_index" class="btn btn-success" style="float:right;margin-top:20px;">管理用画面</a></div>
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    </div>
                @endif


    <div class="reservation-form">
  <div class="reservation-attention">
      <p>ご注文に際しての注意事項です。<br></p>
      <p>{{ $caution->text }}</p>
     <br>
  </div>
  </div>
        <div id='external-events'>
        
            <p style="display:none;">
             <input type='checkbox' id='drop-remove' />
            <label for='drop-remove'>remove after drop</label>
            </p>
        </div>

                    <div id='calendar-container'>
                       <div id='calendar'
                        data-route-load-events="{{ route('routeLoadEvents') }}"
                        data-route-event-delete="{{ route('routeEventDelete') }}"
                        data-route-customer-event-store="{{ route('routeCustomerEventStore') }}"
                        data-route-customer-event-update="{{ route('routeCustomerEventUpdate') }}"
                        data-route-customer-event-create="{{route('routeCustomerEventCreate') }}"

                        >
                       {{ csrf_field() }}

                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>





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
    <!--<script src=" {{ mix('js/app.js') }} "></script> -->






    </body>
    </html>

    <script>



       



    document.addEventListener('DOMContentLoaded', function() {
   var Calendar = FullCalendar.Calendar;

   var containerEl = document.getElementById('external-events');
   var calendarEl = document.getElementById('calendar');

   // initialize the external events
  

    // initialize the calendar
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
        maxTime : '22:00',
        locale : 'jaLocale',
        editable: false,
        selectable: false,
        allDaySlot: false,
        droppable: false, 
            buttonText: {
                today:'今日',
                month:'月',
                week: '週',
                day:  '日',
                list: 'リスト'
            },

           

            events: routeEvents('routeLoadEvents'),

        eventClick: function(element){

            clearMessages('#message');


           $("#customerModalCalendar").modal('show');
           $("#customerModalCalendar #titleCustomerModal").text('予約内容を選んでください').css('text-align','center');

           $('#can').show();
           $('#cancel').hide();
           $('#stop').hide();


           


           let id = element.event.id;
           $("#customerModalCalendar input[name='id']").val(id);
           $("#id-html").text(id);
           $("#id2-html").text(id);

           let title = element.event.title;
           $("#title-html").text(title);
           $("#title2-html").text(title);
           $("#customerModalCalendar input[name='title']").val(title);


           let situation = element.event.extendedProps.situation;
           $("#situation-html").text(situation);
           $("#situation2-html").text(situation);
           $("#customerModalCalendar input[name='situation']").val(situation);


           let start = moment(element.event.start).format("MM/DD HH:mm");
           $("#customerModalCalendar input[name='start']").val(start);
           $("#start-html").text(start);
           $("#startCancel-html").text(start);
           $("#startStop-html").text(start);


           var today = new Date()

            if (today > element.event.start){
                $('#can').hide();
                $('#cancel').hide();
                $('#stop').show();
               
           }else{

            if (title == "×") {
                $('#can').hide();
                $('#cancel').show();
                $('#stop').hide();
            }
           }


          

           


        



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