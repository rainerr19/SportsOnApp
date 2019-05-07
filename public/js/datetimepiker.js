var count = 0;
$('#timepicker1').timepicker({
    timeFormat: 'H:mm',
    interval: 60,
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
    //minTime: '10:00',
    //maxTime: '24:00',
    //defaultTime: '11',
    startTime: '0:00',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
});

function btnDelite(id) {
    $("#bdia").val(' ');
    $("#bhour").val(' ');
    //alert('hola');
    
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
        console.log( $("#bdia").val());    
}    
