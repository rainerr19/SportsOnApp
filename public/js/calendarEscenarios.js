 
 var count = 0;
 var horas = 0;
 var dateStart = [];// global horas seleccionada
 var dateEnd = [];// global dias selecionados
 var UrlJson = window.location.href;
  document.addEventListener('DOMContentLoaded', function() {
      
      var Urlhoras = UrlJson.replace("show", "showHoras");
      var UrlhorasBusy = UrlJson.replace("show", "showHorasBusy");
      
      var busy = JSON.parse(Get(UrlhorasBusy));
      
      //busy.forEach(valBusy); 
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['interaction', 'dayGrid', 'timeGrid', 'bootstrap' ],
      navLinks: true,
      customButtons: {
        myCustomButton: {
          text: 'borrar seleccion',
          click: function() {
              for (let i = 0; i < count; i++) {
                  var event = calendar.getEventById('a'+i);
                  event.remove();
                }
                clearfechas();
            //alert('borrada seleccion');
          }
        }
      },
        footer: {
        left: 'myCustomButton',
        },
        //responsive
        windowResize: function(view) {
            if($(window).width() <= 500){
                calendar.setOption('header',{
                    left: 'prev,next',
                    center: 'timeGridWeek,timeGridDay',
                    right: ''
                  });
            }else{
                calendar.setOption('header',{
                    left: 'prev,next',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                  });
            }
            //h = calendar.getOption('header','center'); 
           
            // alert('altura'+$(window).width()+h);
          },
        defaultView:'timeGridWeek',
        selectable: true,
        height: 600,
        //height: '420',
        themeSystem: 'bootstrap',
        timeZone: moment.locale(),
        nowIndicator: true,
        defaultDate: moment().format(),
        now: moment().format(),
        slotDuration: '01:00',
        allDaySlot:false,
        slotEventOverlap:false,

        // hora de trabajo sacadas de base de datos
        selectConstraint: isBusy(busy), //seleccion horas de trabajo
        businessHours: busy,
        select: function(info,start) {
            var check = info.startStr;
            var today = moment().format();
            if (check >= today) {
                $('#ModalDatePicker').modal('show');
                var str = FullCalendar.formatRange(info.startStr, info.endStr, {
                    hour: 'numeric',
                    minute: 'numeric',
                    day: 'numeric',
                    month: 'long',
                    separator: ' a ',
                    locale: 'es'
                  });
                // document.getElementById("btn-agregar").disabled = false;
                document.getElementById("TituloMensaje").innerHTML='Seleccion de fechas';
                document.getElementById("DateMensaje").innerHTML='fecha seleccionada '+
                '--> '+ str + ' ';
                calendar.addEvent({
                    id:'a'+count,// var event = calendar.getEventById('a')
                    title:'Seleccionado',
                    start: info.startStr,
                    end: info.endStr,
                    color:'green'
                });
                
                //console.log(event);
                  agregar(info.startStr,info.endStr);
            //alert('selected ' + info.startStr + ' to ' + info.endStr + '--->'+start);
          }else{
            $('#ModalDatePicker').modal('show');
            // document.getElementById("btn-agregar").disabled = true;
            document.getElementById("TituloMensaje").innerHTML='Seleccion de fechas';
            document.getElementById("DateMensaje").innerHTML='fecha seleccionada ya paso';
          }
        },

        // horas sacadas de base de datos
        events: {
            url: Urlhoras,
            failure: function() {
              alert('Error al cargar horas');
            }
        }
    });
    //after render
    calendar.setOption('locale', 'es');
    if($(window).width() <= 500){
        calendar.setOption('header',{
            left: 'prev,next',
            center: 'timeGridWeek,timeGridDay',
            right: ''
          });
    }else{
        calendar.setOption('header',{
            left: 'prev,next',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
        });
        
    };
    calendar.render();
  });
  // sacar el json de una ruta
  function Get(Url){
    var Httpreq = new XMLHttpRequest(); // nuevo request
    Httpreq.open("GET",Url,false);
    Httpreq.send(null);
    return Httpreq.responseText;          
}
function Post(Url,data){
  var Httpreq = new XMLHttpRequest(); // nuevo request
  Httpreq.open("Post",Url,true);
  Httpreq.send(data);
  return Httpreq.responseText;          
}
// function valBusy(item, index) {
//         return '{daysOfWeek:' + item.daysOfWeek +' startTime:' + item.startTime 
//         + ' endTime: ' + item.endTime + '},';
//   }
function isBusy(jsonObj) {
    for(var key in jsonObj) {
        if(jsonObj.hasOwnProperty(key))
            return "businessHours" ;
    }
    return null;
}
//
function agregar(Start,End) {
    count = count + 1;
    var a = moment(Start);
    var b = moment(End);
    // diferencia de horas con el modulo momnet
    horas = horas + b.diff(a, 'hours');
    document.getElementById("btn-apartar").disabled = false;
    document.getElementById("seleccion").innerHTML = horas;
    
    dateStart.push(Start);
    dateEnd.push(End);
    document.getElementById("horas").value = horas;
    document.getElementById("dateStart").value = dateStart;
    document.getElementById("dateEnd").value = dateEnd;
    
    
    // console.log(dateStart);
    // console.log(dateEnd);
    // console.log(b.diff(a, 'hours') );   
}
//
function clearfechas() {
    horas = 0;
    count = 0;
    document.getElementById("btn-apartar").disabled = true;
    document.getElementById("seleccion").innerHTML = count;
    dateStart=[];
    dateEnd=[];   
    document.getElementById("horas").value = horas;
    document.getElementById("dateStart").value = dateStart;
    document.getElementById("dateEnd").value = dateEnd;
}
//
//ocultar terminal ctrl+j



