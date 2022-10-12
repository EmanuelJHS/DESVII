let cb_allDay = document.getElementById('allDay');

let date_inicio = document.getElementById('date_inicio');
let time_inicio = document.getElementById('time_inicio');
let date_fin = document.getElementById('date_fin');
let time_fin = document.getElementById('time_fin');

let repetir = document.getElementById('repetir');
let duracion_d = document.getElementById('duracion_d');
let duracion_h = document.getElementById('duracion_h');
let lb_duracion = document.getElementById('lb_duracion');



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

    //console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
    if(cb_allDay.checked==true){
        duracion_d.value=0;
        duracion_h.value=0;
        _resultado= "0d"; //Resultado a imprimir
    }else{
        let fecha1 = moment(date_inicio.value);
        let fecha2 = moment(date_fin.value);
        let time1 = moment(time_inicio.value,"hh:mm A");
        let time2 = moment(time_fin.value,"hh:mm A");

        if(isNaN(fecha1)==false && isNaN(fecha2)==false){
            resultado = fecha2.diff(fecha1, 'days');
            duracion_d.value = resultado; //Guardar valor
            _resultado = resultado+ "d ";
            //lb_duracion.innerHTML = resultado+"d"; //Imprimiendo
          //console.log("duracion_d: "+ resultado.asMinutes());
        }

        if(isNaN(time1)==false && isNaN(time2)==false){
            resultado = moment.duration(time2.diff(time1));
            duracion_h.value = resultado.asMinutes();
            _resultado += resultado.asMinutes()+"m";
            //Horas
            // let duration = moment.duration(time2.diff(time1));
            // let hours = duration.asHours();
        }
       // console.log("duracion_d: "+ duracion_d.value+", duracion_h: "+duracion_h.value);

    }

    //Imprime el resultado en el label para el usuario.
    lb_duracion.innerHTML = _resultado;
    console.log("date inicio: " + date_inicio.value);
    console.log("time inicio: " + time_inicio.value);
    console.log("date fin: " + date_fin.value);
    console.log("time fin: " + time_fin.value);


   }

 function setVariablesDateTime(){
    // 2022-10-12
    // let date = new Date(); // tradicional
    // let currentDate = date.toISOString().substring(0,10);
    // let currentTime = date.toISOString().substring(11,16);

    //libreria moment
    let date = moment().format(); 
    let currentDate = date.substring(0,10);
    let currentTime = date.substring(11,16);

    //Imprimiendo
    console.log("Hora y fecha : " + date +" \ "+ currentTime );

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
        repetir.disabled=false;
        break;
    default:
        time_inicio.hidden=true;
        time_fin.hidden=true;
        date_fin.hidden=true;
        cb_allDay.checked = true;
        cb_allDay.disabled=true;
        repetir.selectedIndex = '4';
        repetir.disabled=true;
        

   }

   calcularDuracion();

}

//se ejecutara al iniciar la pagina
setVariablesDateTime();
calcularDuracion();






