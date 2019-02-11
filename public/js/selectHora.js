// seleccion de una celda javascript
var count=0;// global # de seleccion
var celda1=[];// global horas seleccionada
var celda2=[];// global dias selecionados
document.getElementById("dia").value = "";
document.getElementById("hora").value = "";
function cellSelec(hora,dia) {
    //var count=document.getElementById("c");
    count=count+1;

    var d = ["L","M","I","J","V","S","D"]; 
    var cel = "cell-" + hora + "-" + dia;
    document.getElementById(cel).style.background = "#5cb85c";
    document.getElementById(cel).style.color = "white";
    document.getElementById(cel).innerHTML="selec";
    document.getElementById("c").innerHTML = count;
    celda1.push(hora);
    celda2.push(dia);
    document.getElementById("hora").value = celda1;
    document.getElementById("dia").value = celda2;
    console.log(celda1);
    console.log(celda2);
    //document.getElementById("se").innerHTML = ("horas= " + "cell-" + hora + "-" + d[dia]);
}
//limppiar seleccion
function clearSelec() {
    count=0;
    
    document.getElementById("c").innerHTML = count;
    document.getElementById("dia").innerHTML = "";
    document.getElementById("hora").innerHTML = "";
    for (i = 0; i < celda1.length; i++) {
        cel = "cell-" + celda1[i] + "-" + celda2[i];
        document.getElementById(cel).style.background = null;
        document.getElementById(cel).style.color = null;
        document.getElementById(cel).innerHTML="";
        
    }
    celda1=[];
    celda2=[];
    
}