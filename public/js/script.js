
$(function(){


   

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $(".deleteEvent").click(function(){

        let id = $("#modalCalendar input[name='id']").val();

        let Event = {
            id: id,
            _method: 'DELETE'
        };
        let route = routeEvents('routeEventDelete')
        sendEvent2(route,Event);
    });

    $(".saveEvent").click(function(){

           let id = $("#modalCalendar input[name='id']").val();

           let title = $("#modalCalendar input[name='title']").val();

           let nailist_id = $("#modalCalendar select[name='nailist_id']").val();

           let menu_id = $("#modalCalendar select[name='menu_id']").val();

           let start = moment($("#modalCalendar input[name='start']").val(),"YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");

           let end = moment($("#modalCalendar input[name='end']").val(),"YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD HH:mm:ss");

           let color =  $("#modalCalendar input[name='color']").val();

           let description = $("#modalCalendar textarea[name='description']").val();

           let Event = {
               title: title,
               nailist_id: nailist_id,
               menu_id: menu_id,
               start: start,
               end: end,
               color: color,
               description: description,
           };

           let route;
   
           if(id ==''){
               route = routeEvents('routeEventStore');
           }else{
               route = routeEvents('routeEventUpdate');
               Event.id = id;
               Event._method = 'PUT';

           }

           sendEvent2(route,Event);



    });

    $(".finishCustomerEvent").click(function(){


        let id = $("#customerModalCalendar2 input[name='id']").val();

        //let name = $("#customerModalCalendar2 input[name='name']").val();
    
        //let email = $("#customerModalCalendar2 input[name='email']").val();
    
        //let tel = $("#customerModalCalendar2 input[name='tel']").val();
    
        let nailist_id = $("#customerModalCalendar2 select[name='nailist_id']").val();
    
        let menu_id = $("#customerModalCalendar2 select[name='menu_id']").val();
    
        //let start = moment($("#customerModalCalendar2 input[name='start']").val(),"YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
    
        let start =   moment($("#start-html").text(),"YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
        let name =   $("#name-html").text();
        let email =   $("#email-html").text();
        let tel =   $("#tel-html").text();
       
        let note =   $("#note-html").text();

    
        let confirmed = $("#customerModalCalendar2 input[name='confirmed']").val();

        let Event = {
           
            name: name,
            email: email,
            tel: tel,
            nailist_id: nailist_id,
            menu_id: menu_id,
            start: start,
            note: note,
            confirmed, confirmed
        };

        let  route;

      
            route = routeEvents('routeCustomerEventUpdate');
            Event.id = id;
           

        


       sendEvent3(route,Event);

    });
    $(".saveCustomerEvent").click(function(){


        let id = $("#customerModalCalendar input[name='id']").val();

        let name = $("#customerModalCalendar input[name='name']").val();
    
        let email = $("#customerModalCalendar input[name='email']").val();
    
        let tel = $("#customerModalCalendar input[name='tel']").val();
    
        let nailist_id = $("#customerModalCalendar select[name='nailist_id']").val();
    
        let menu_id = $("#customerModalCalendar select[name='menu_id']").val();
    
        let start = moment($("#customerModalCalendar input[name='start']").val(),"YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
    
        let note = $("#customerModalCalendar textarea[name='note']").val();
    
        let Event = {
            id: id,
            name: name,
            email: email,
            tel: tel,
            nailist_id: nailist_id,
            menu_id: menu_id,
            start: start,
            note: note,
        };

        let  route;

        route = routeEvents('routeCustomerEventStore');

       sendEvent(route,Event);

    });
    $(".createCustomerEvent").click(function(){


       // let id = $("#customerModalCalendar input[name='id']").val();

        let start = moment($("#start-html").text(),"YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
       // let start = moment($("#customerModalCalendar input[name='start']").val(),"YYYY-MM-DD HH:mm").format("YYYY-MM-DD HH:mm");
       let id =   $("#id-html").text();
       let title =   $("#title-html").text();
       let situation =   $("#situation-html").text();
    
        //let note = $("#customerModalCalendar textarea[name='note']").val();
    
        let Event = {
            id: id,
            start: start,
            title: title,
            situation: situation
        };

        let  route;

        route = routeEvents('routeCustomerEventCreate');

       sendEvent4(route,Event);

    });

});

function sendEvent(route,data_){

    $.ajax({
        url:route,
        data:data_,
        method:'POST',
        dataType: 'json',
        success:function(json){

            if(json){
                changeModal(json);
               // location.reload();
            }
        },
        error:function(json){
            let responseJSON = json.responseJSON.errors;

            $("#message").html(loadErrors(responseJSON));
        }
    })
}
function sendEvent2(route,data_){

    $.ajax({
        url:route,
        data:data_,
        method:'POST',
        dataType: 'json',
        success:function(json){

            if(json){
               
               location.reload();

            }
        },
        error:function(json){
            let responseJSON = json.responseJSON.errors;

            $("#message").html(loadErrors(responseJSON));
        }
    })
}
function sendEvent3(route,data_){

    $.ajax({
        url:route,
        data:data_,
        method:'PUT',
        dataType: 'json',
        success:function(json){

            if(json){
               
 
                finishModal(json);
               // location.reload();
            }
        },
        error:function(json){
            let responseJSON = json.responseJSON.errors;

            $("#message").html(loadErrors(responseJSON));
        }
    })
}
function sendEvent4(route,data_){

    $.ajax({
        url:route,
        data:data_,
        method:'POST',
        dataType: 'json',
        success:function(json){

            if(json){
                (json);
                location.href = 'http://localhost:8000/customer_create';
                //location.reload;
            }
        },
        error:function(json){
            let responseJSON = json.responseJSON.errors;

            $("#message").html(loadErrors(responseJSON));
        }
    })
}

function loadErrors(response){

    let boxAlert = `<div class="alert alert-danger">`;

    for (let fields in response){
        boxAlert += `<span>${response[fields]}</span><br/>`;
    }

    boxAlert += `</div>`;
    return boxAlert.replace(/,/g,"<br/>");
}

function routeEvents(route){
    return document.getElementById('calendar').dataset[route];
};

function clearMessages(element){
    $(element).text('');
}

function resetForm(form){
    $(form)[0].reset();
}

function changeModal(Event){
    $('body').removeClass( 'modal-open' );
  $('.modal-backdrop').remove();
  $('#customerModalCalendar').modal( 'hide' );
  
  $('#customerModalCalendar2').modal('show');
  
  let start = moment(Event.start).format("YYYY-MM-DD HH:mm");
  //$("#customerModalCalendar2 input[name='start']").val(start).prop('disabled', true);
  $("#start-html").text(start);


  let id = Event.id;
  $("#customerModalCalendar2 input[name='id']").val(id)

  let nailist_id = Event.nailist.name;
 // $("#customerModalCalendar2 input[name='nailist_id']").val(nailist_id);
  $("#nailist_id-html").text(nailist_id);


  let menu_id = Event.menu.name;
  //$("#customerModalCalendar2 select[name='menu_id']").val(menu_id).prop('disabled', true);
  $("#menu_id-html").text(menu_id);


  let name = Event.name;
  //$("#customerModalCalendar2 input[name='name']").val(name).prop('disabled', true);
  $("#name-html").text(name);


  let email= Event.email;
  //$("#customerModalCalendar2 input[name='email']").val(email).prop('disabled', true);
  $("#email-html").text(email);


  let tel = Event.tel;
  //$("#customerModalCalendar2 input[name='tel']").val(tel).prop('disabled', true);
  $("#tel-html").text(tel);


  let note = Event.note;
  //$("#customerModalCalendar2 textarea[name='note']").val(note).prop('disabled', true);
  $("#note-html").text(note);

  let price = '¥' + (Event.nailist.price + Event.menu.price);
  //$("#customerModalCalendar2 textarea[name='note']").val(note).prop('disabled', true);
  $("#price-html").text(price);


  let confirmed = Event.confirmed;
  $("#customerModalCalendar2 input[name='confirmed']").val(confirmed).prop('disabled', true);


}

function finishModal(){
    $('body').removeClass( 'modal-open' );
  $('.modal-backdrop').remove();
  $('#customerModalCalendar2').modal( 'hide' );
  
  $('#customerModalCalendar3').modal('show');

}

