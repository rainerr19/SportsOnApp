var count = 0;
var count1 = 0;
$('#timepicker1').timepicker({
    timeFormat: 'H:mm',
    interval: 60,
      //minTime: '10:00',
    //maxTime: '24:00',
    //defaultTime: '11',
    startTime: '0:00',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
    // change: function() {
    //     // the input field
    //     // get access to this Timepicker instance
    //     $('#timepicker2').timepicker('option', 'minTime', $("#timepicker1").val());
    // },
});
        
$('#timepicker2').timepicker({
    timeFormat: 'H:mm',
    interval: 60,
    startTime: '0:00',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
});
$('#timepicker3').timepicker({
    timeFormat: 'H:mm',
    interval: 60,
    startTime: '0:00',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
});
$('#timepicker4').timepicker({
    timeFormat: 'H:mm',
    interval: 60,
    startTime: '0:00',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
});

function btnDelite(id) {
    $("#bdia").val(' ');
    $("#bhour").val(' ');
    $('#'+id).remove();
    saveVal();
}
$( "#timeSelec" ).click(function() {
    if ($("#timepicker1").val() != ""  && $("#timepicker2").val() != ""  && $("#dias").val() != "Dias.." ) {
        $("#times").append('<li class="list-group-item draft" id="'+count +'">'+
                $("#dias").val()+', '+$("#timepicker1").val()+'-'+ $("#timepicker2").val()+' '+
                '<button type="button" class="btn btn-outline-secondary" onclick="btnDelite('+count+')">'+
                '<i class="far fa-trash-alt"></i></button></li>');
        count= count+1;
        saveVal();
    }
});
function saveVal() {
    var weeks = [];
        var hours = [];
        $('.draft').each(function() {
            var items = $(this).text();
            var val = items.split(',');
            weeks.push(val[0]);
            hours.push(val[1]);
            });
        $("#bdia").val(weeks);
        $("#bhour").val(hours);         
        // console.log( $("#bdia").val());    
} 
$( document ).ready(function() {
    // console.log( $('#pago').find("option:selected").val() );
    if($('#pago').find("option:selected").val()=='Si'){
        $('#priceInput').collapse('show');
    }
});   

$('#pago').on('change', function(e){
    console.log(this.value);
    if (this.value=='Si') {
        $('#priceInput').collapse('show');
    }else{
        $('#priceInput').collapse('hide');
    }
});

$( "#pricetimeSelec" ).click(function() {
    if ($("#timepicker3").val() != ""  && $("#timepicker4").val() != ""  
        && $("#pdias").val() != "Dias.." && $("#color").val() != "colores.." && 
        $("#hprice").val() != "") {
            
            $("#tprices").append('<tr class="draft2" id="p'+count1 +'"><td>'+
                $("#pdias").val()+'</td><td> '+$("#hprice").val()+'</td><td> '+
                $("#timepicker3").val()+'-'+ $("#timepicker4").val()+'</td><td> '+
                $("#color").val()+'</td><td> '+
                '<button type="button" class="btn btn-outline-secondary" onclick="btnDelitep('+count1+')">'+
                '<i class="far fa-trash-alt"></i></button></td></tr>');
        count1= count1+1;
        saveVal2();
    }
});
function saveVal2() {
    var dia = [];
    var price = [];
    var hora1 = [];
    var hora2 = [];
    var color = [];
    $('.draft2').each(function() {
        var items = $(this).text();
        var val = items.split(' ');
        var h = val[2].split('-');
        dia.push(val[0]);
        price.push(val[1]);
        hora1.push(h[0]);
        hora2.push(h[1]);
        color.push(val[3]);
    });
    $("#pday").val(dia);
    $("#phour1").val(hora1);
    $("#phour2").val(hora2);
    $("#prices").val(price);
    $("#pcolor").val(color);       
    // console.log( $("#pday").val());    
}
function btnDelitep(id) {
    $("#pday").val(' ');
    $("#phour1").val(' ');
    $("#phour2").val(' ');
    $("#prices").val(' ');
    $("#pcolor").val(' ');
    $('#p'+id).remove();
    saveVal2();
}