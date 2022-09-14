<?php
if (is_uploaded_file ($_FILES['nombre_archivo_cliente']['tmp_name'])){
    $nombreDirectorio = "archivos/";
    $nombrearchivo = $_FILES['nombre_archivo_cliente']['name'];
    $nombreCompleto = $nombreDirectorio. $nombrearchivo;

    //parte_02
    $tamano_archivo = $_FILES['nombre_archivo_cliente']['size'];
    $extension_archivo = pathinfo( $_FILES['nombre_archivo_cliente']['name'], PATHINFO_EXTENSION);
    
    //Validamos el tamano (kb)
    if($tamano_archivo <= 1000000){
        //Validamo la extesion jpg, jpeg, gif y png
    if( $extension_archivo == "jpg" || 
    $extension_archivo == "jpeg" || 
    $extension_archivo == "gif" ||
    $extension_archivo == "png"){
       
    if (is_file($nombreCompleto)){
        $idUnico = time();
        $nombrearchivo = $idUnico ."-". $nombrearchivo;
        echo "Archivo repetido, se cambiara el nombre a $nombrearchivo <br><br>";
    }

    move_uploaded_file($_FILES['nombre_archivo_cliente']['tmp_name'], $nombreDirectorio . $nombrearchivo);

    echo "El archivo se ha subido satisfactoriamente al directorio $nombreDirectorio <br>";
    }else{
        echo "Extension del archivo:  $extension_archivo <br><br>";
        echo "Formato de archivo invalido, el archivo debe ser: jpg, jpeg, gif y png.";
    }
}else{
    echo "Archivo supera el limite de 1MB.";
}

}else{
    echo "No se ha podido subir el archivo <br>";
}

?>