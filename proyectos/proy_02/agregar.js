let cb_allDay = document.getElementById('allDay');

let date_inicio = document.getElementById('date_inicio');
let time_inicio = document.getElementById('time_inicio');
let date_fin = document.getElementById('date_fin');
let time_fin = document.getElementById('time_fin');

let repetir = document.getElementById('repetir');
let lb_duracion = document.getElementById('lb_duracion');


function cerrarVentana(){
    document.getElementById("titulo").value = "a";
    window.location.href="./resumen.php";
}

function ocultar(et){
    let etiqueta = document.getElementById(et);

    if(etiqueta.hidden==false){
        //La ocultamos
        etiqueta.hidden=true;
    }else{
        //La hacemos aparecer
        etiqueta.hidden=false;
    }

}

function calcularDuracion(){
    let _resultado="";

    //console.log(""); //Separador
    if(cb_allDay.checked==true){
        _resultado= ""; //Resultado a imprimir
    }else{
     // console.log("moment js: " + moment().format());
    // let dateIn = date_inicio.value+"T"+time_inicio.value+":00-05:00";
    let _in = moment(date_inicio.value+'T'+time_inicio.value+':00-05:00');
    let _out = moment(date_fin.value+'T'+time_fin.value+':00-05:00');
    //console.log("inicio: " + _in + ", fin: " + _out);
    let _diferencia = _out.diff(_in);
    //console.log("diferencia: " + _diferencia);
    // let _minutos = moment.duration(_diferencia).asMinutes();
    let _minutos= _out.diff(_in,'minutes');
    //console.log("duracion: " + _minutos +"m");
    // let _horas = moment.duration(_diferencia).asHours();
    let _horas = _out.diff(_in,'hours');
    //console.log("duracion: " + _horas +"h");
    // let _dias = moment.duration(_diferencia).asDays();
    let _dias = _out.diff(_in, "days");
    // console.log("duracion: " + _dias +"d");
    // console.log("Operaciones horas: h("+_horas+") - d("+(_dias*24)+"): "+ (moment(_horas)-(moment(_dias)*24)) );
    // console.log("Operaciones minutos: m("+_minutos+") - h("+(_horas*60)+"): "+ (_minutos - (_horas*60) ));
    // console.log("revirtiendo: " + moment(_in).add(_duracion,'m').format());
    let horas_ = _horas-(_dias*24);
    let minutos_ = _minutos - (_horas*60);
    if(_dias>0){ _resultado += _dias+"d "};
    if(horas_>0){ _resultado += horas_+"h "};
    if(minutos_>0){ _resultado += minutos_+"m "};

           //Imprime el resultado en el label para el usuario.
           lb_duracion.innerHTML = _resultado;
    
   }
   lb_duracion.innerHTML = _resultado;


}

 function setVariablesDateTime(){
    // 2022-10-13T20:25:09-05:00
    //libreria moment
    let date = moment().format(); 
    let currentDate = date.substring(0,10);
    let currentTime = date.substring(11,16);

    //Imprimiendo
   // console.log("Hora y fecha : " + date +" \ "+ currentTime );

    //set valores
    date_inicio.value =  currentDate;
    time_inicio.value = currentTime;

    //add 30mins to date Time (Fin)
    date = moment().add(30, 'm').format();
    currentDate = date.substring(0,10);
    currentTime = date.substring(11,16);
    date_fin.value =  currentDate;
    time_fin.value = currentTime;

}

function allDay_change(){
    ocultar("time_fin");
    ocultar("time_inicio");
    ocultar("date_fin");
    calcularDuracion();
}

function tipoActividad(){
   switch(tipo.value){
    case "evento":
        time_inicio.hidden=false;
        time_fin.hidden=false;
        date_fin.hidden=false;
        cb_allDay.checked = false;
        cb_allDay.disabled=false;
        repetir.selectedIndex = '0';
        repetir.disabled=true;
        break;
    default:
        time_inicio.hidden=true;
        time_fin.hidden=true;
        date_fin.hidden=true;
        cb_allDay.checked = true;
        cb_allDay.disabled=true;
        repetir.selectedIndex = '0';
        repetir.disabled=true;
        

   }

   calcularDuracion();

}

//se ejecutara al iniciar la pagina
setVariablesDateTime();
calcularDuracion();

