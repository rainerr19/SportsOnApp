<?php

namespace App\Classes;


class HoraTablaCreator
{
    function DBsemana( $horadb){    
        /* Funcion =  recibe un formato de hora del al base de datos y los transforma en arrays
          formato de hora --> 02-04L--> de 2am hasta 4pm del lunes
          formato de hora --> *D--> todas las horas del domingo
          formato de hora --> 02-04L2123M--> de 2am hasta 4pm del lunes y martes a las 9pm
          y 11pm
          L --> lunes
          M --> martes
          I --> miercoles
          J --> jueves
          V --> viernes
          S --> sabado
          D --> domingo
        */
        $size = strlen ($horadb);
        $semana=array(
        "L"=>array(),  
        "M"=>array(), 
        "I"=>array(), 
        "J"=>array(), 
        "V"=>array(), 
        "S"=>array(), 
        "D"=>array()  
        );
        $horas=[array(), array(), array(), array(), array(), array(), array()];
        $d = ["L","M","I","J","V","S","D"];    
        for ($i = 0; $i <= 6; $i++) {
            $pos =stripos($horadb, $d[$i]);
            if($pos){
                $tem = substr($horadb,0, $pos);
                $horadb = substr($horadb,$pos+1, $size);
                $pos2 =stripos($tem, "-");
                while($pos2) {
                    $value1 = substr($tem, $pos2-2, 2);
                    $value2 = substr($tem, $pos2+1, 2);
                    for($j = $value1; $j <= $value2; $j++){
                        array_push($horas[$i], intval($j));
                    }
                    //$horadb = substr(,$pos, $size);  elimina el fracmento de string en pos2
                    $tem = substr_replace($tem, '', $pos2-2, 5); 
                    $pos2 =stripos($tem, "-");
                }
                $pos3 =stripos($tem, "*");
                if($pos3 !== false){
                    for($k=0; $k <= 23; $k++){
                        array_push($horas[$i], $k);
                    }
                }else{               
                    if (strlen($tem)>0) {
                        # 
                        for($j = 0;$j <strlen ($tem); $j+=2){
                            array_push($horas[$i], intval(substr($tem, $pos2+$j, 2)));
                        }
                    }
                }   
            }
        }
        $i=0;
        foreach( $d as $val ){
            $semana[$val] = $horas[$i];
            #var_dump($dia);
            $i+=1;
        }
        //echo $horas[0];
        //semana--->> array de horas[-,-,-,-]
        return $semana;
        
    }
    function semanaDB($semana){
        /*funcion= recibe array de semanas y lo comvierte en el formato de hora para ser guardado en DB */
        $str='';
        $dia = ["L","M","I","J","V","S","D"];
        foreach( $dia as $val ){
            $ho =$semana[$val] ;
            
            if (count($ho)!=0) {
                $str=$str.$this->consecutivo($ho).$val;
            }
        }
       //echo $dia;
        return $str;
    }
    function consecutivo($arr){
       sort($arr,SORT_NUMERIC);//ordenar
       $str = "";
        $sz = count($arr);
        $n1tem = $arr[0];
        array_push($arr, $arr[$sz-1]);
        if($sz<24){
            for ($i=0; $i < $sz; $i++) {
                $n2 = $arr[$i+1];
                $n1 = $arr[$i];
                if($n2!=$n1+1){
                    if ($n1tem!=$n1){
                        if ($n1tem+1==$n1) {
                            if ($n1tem<10){$n1tem ="0$n1tem";}
                            if ($n1<10){$n1 = "0$n1";}
                            $str = $str."$n1tem$n1";
                        }else{
                            if ($n1tem<10){$n1tem ="0$n1tem";}
                            if ($n1<10){$n1 ="0$n1";}
                            $str = $str."$n1tem-$n1";
                        }
                    }else{
                        if ($n1<10){$n1 = "0$n1";}
                        $str = $str.$n1;
                    }
                    $n1tem = $n2;
                }
            }
        }else{
            $str = $str."*";
        }
        return $str;
    }
    function tablaCreator($semBAN,$semBloc,$now,$showDia){
        /*** Funcion =  crea una tabla de semanas con id de cada celda para seleccion
         * $semBAN recibe horas de la semana que van a bloquear en la tabla en forma de array
         * $semBAN recibe horas de la semana que estan ocupado en la tabla en forma de array
         * $now recibe dia y hora actual para bloquear seleccion
         */
        $out =  "<tr class='active success'>
                <th>Horas</th>";
        $week=[
            "L" => ["Lunes","Monday"],
            "M" => ["Martes","Tuesday"],
            "I" => ["Miercoles","Wednesday"],
            "J" => ["Jueves","Thursday"],
            "V" => ["Viernes","Friday"],
            "S" => ["Sabado","Saturday"],
            "D" => ["Domingo","Sunday"]
        ];
        if ($showDia) {
            date_default_timezone_set("America/Bogota");
        }
        $iDia=0;
        foreach($week as $d){
            if($now[0] == $d[1]){
                $now[0]="$iDia";
            }
            $iDia=$iDia+1;
            if($showDia){
                $dayNumber =  "<i style='color:grey;'>".date("-d",strtotime("now ".$d[1]))."</i>";
                $out =$out."<th>".$d[0].$dayNumber."</th>";
            }else{$out =$out."<th>".$d[0]."</th>";}
        }
        $out=$out."</tr>";
        for ($i=0; $i < 24 ; $i++) {
            if ($i<10) {
                if ($i==9) {
                    $hora ="0$i-".($i+1);
                }else{
                    $hora ="0$i-0".($i+1);     
                }                  
            }else {if($i==23){
                    $hora ="$i-00";
                    }else{
                        $hora ="$i-".($i+1);
                    }
            }
    
            $out=$out."<tr><th>$hora</th>";
            
            $dia = ["L","M","I","J","V","S","D"];
            for($j=0;$j < 7;$j++){
                $ar =$semBAN[$dia[$j]]; 
                $ar2 =$semBloc[$dia[$j]]; 
                //$semBloc
                if ($i==intval($now[1]) && $j==intval($now[0])){
                    $celda = "<th class='cel-p' id='cell-$i-$j'>En progreso</th>";
                }else{
    
                    if (count($ar)!=0 && count($ar2)!=0) {
                        $celda ="<td id='cell-$i-$j' onclick='cellSelec($i,$j)'></td>";
                        foreach($ar as $v){
                            if($v==$i){
                                $celda = "<th class='cel-ban' id='cell-$i-$j'>No habilitado</th>";
                            }
                        }
                        foreach($ar2 as $v2){
                            if($v2==$i){
                                $celda = "<th class='cel-busy' id='cell-$i-$j'>ocupado</th>"; 
                            }
                        }
                    }else{
                        $celda ="<td id='cell-$i-$j' onclick='cellSelec($i,$j)'></td>";
                        if (count($ar)!=0){
                            foreach($ar as $v){
                                if($v==$i){
                                    $celda = "<th class='cel-ban' id='cell-$i-$j'>No habilitado</th>";
                                }
                            }
                        }elseif (count($ar2)!=0) {
                            # code...
                            foreach($ar2 as $v2){
                                if($v2==$i){
                                    $celda = "<th class='cel-busy' id='cell-$i-$j'>ocupado</th>";
                                }
                            }
                        }   
                    }
                }
                $out=$out.$celda;
            }//end for
            $out=$out."</tr>";
        }   
        return $out;
    }//fin tabla
    function horasDB($dias, $horas)
    {   
        /*funcion= recibe array de semanas y lo comvierte en el formato de hora para ser guardado en DB */
        $ban_dia = preg_split("/[\s,]+/", $dias);
        $ban_hora =preg_split("/[\s,]+/", $horas);
        $ban=array(
            "L"=>array(),  
            "M"=>array(), 
            "I"=>array(), 
            "J"=>array(), 
            "V"=>array(), 
            "S"=>array(), 
            "D"=>array()  
            );
        if(sizeof($ban_dia)>0){
            for ($i=0; $i < sizeof($ban_dia) ; $i++) { 
                
                switch ($ban_dia[$i]) {
                    case "0":
                        array_push($ban["L"], intval($ban_hora[$i]));                    
                        break;
                    case "1":
                        array_push($ban["M"], intval($ban_hora[$i]));                    
                        break;
                    case "2":
                        array_push($ban["I"], intval($ban_hora[$i]));                    
                        break;
                    case "3":
                        array_push($ban["J"], intval($ban_hora[$i]));                    
                        break;
                    case "4":
                        array_push($ban["V"], intval($ban_hora[$i]));                    
                        break;
                    case "5":
                        array_push($ban["S"], intval($ban_hora[$i]));                    
                        break;
                    case "6":
                        array_push($ban["D"], intval($ban_hora[$i]));                    
                        break;
                }
            }
        }
        return $ban;

    }//fin horasDB
    function tablaUpdate($ocupa, $guardado, $actual)
    {
        //$p = new canchas();// datos de la cancha
        //$g = $p->datoCanchas(1); //dia-mes-año hora:mi:s
        //$guardado=strtotime($g["fecha_g"]);//stamp 2018-05-25 17:44:0 // fecha guardada
        //$ocupa=DBsemana($g["ocupacion"]);//"1011L1819M09-12I07-09S07-09D"
        if($ocupa!=NULL){
            
            $week=[
                "Monday" =>  "L",
                "Tuesday" =>  "M",
                "Wednesday" =>  "I",
                "Thursday" =>  "J",
                "Friday" =>  "V",
                "Saturday" =>  "S",
                "Sunday" =>  "D"
            ];
            while ($guardado < $actual) {
                $dia = date("l", $guardado);
                $dia = $week[$dia];
                $hora = date("H", $guardado);
                $dias = ["L","M","I","J","V","S","D"];                        
                for($i=0;$i<7;$i++){
                    $d=$ocupa[$dias[$i]];
                    if(NULL != $d){
                        foreach($d as $h){
                            if($h==$hora && $dia==$dias[$i]){
                                $ocupa[$dias[$i]] = array_diff($ocupa[$dias[$i]], array($h));
                                break;
                            }
                        }
                        
                    }
                }
                
                $guardado = strtotime("+1 hour", $guardado);
                
            }
            //date("Y-m-d H:i",$actual),
            return( $this->semanaDB($ocupa)); 
        }
    
    }
}
