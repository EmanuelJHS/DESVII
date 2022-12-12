
<?php

include_once("..//lib/utility.php");
include_once("../class/usuario.php");

    class VistaReporte{


        function plantilla(){
            echo '
            <div>
                <form action="main_admin.php" method="post">
                <input type="text" name="ventana" id="" value="reporte" hidden>
                <label for="">ID Colaborador:</label>
                <input type="text" name="id_colaborador" id="id_colaborador" required>
                <label for="">De:</label> 
                <input type="date" name="fechaIn" id="fechaIn" required>
                <label for="">a:</label> 
                <input type="date" name="fechaOut" id="fechaOut" required>
                <input type="submit" name="btn_buscar_reporte" value="Buscar">
                </form>
            </div>
        ';
        }

        function buscarData($id_colaborador, $fechaIn, $fechaOut){
            
            $url = 'http://localhost/DESVII/proyectos/proy_03/api/marcacion/listar.php';
            $data = array(
                'id_colaborador'=>''.$id_colaborador.'',
                'fechaIn'=>''.$fechaIn.'',
                'fechaOut'=>''.$fechaOut.''
            );
    
            $postear = new Postear($url,$data);
            $result = $postear->getPost();
            $response = json_decode($result,true);
    
            // var_dump($response);

            return $response;

        }

        function imprimirRegistros($record){

            if(isset($record['records'])){
            $registros = $record['records'];
            $nfilas = count($registros);

                if ($nfilas > 0){
                    echo '<div>';
                    echo "<table>";
                    echo '
                        <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        </tr>
                    ';


                foreach ($registros as $resultado){
                    echo "<tr>";
                    echo '
                    <form action="main_admin.php" method="post">
                        <input hidden type="text" name="id_marcacion" id="" value="'.$resultado['id'].'">
                        <td>'.$resultado['id_colaborador'].'</td>
                        <td>'.$resultado['nombre'].'</td>
                        <td>'.$resultado['fecha'].'</td>
                        <td>'.$resultado['hora'].'</td>
                    </form>
                    ';


                    echo "</tr>";
                }

                echo "</table>";
                echo '</div>';

                // print ("</table>\n");
                }else{
                echo "<div class='mensaje'>No hay registros</div>";
                }
            }else{
                echo $record['message'];
            }
        }

        function ultimaBusqueda($id_colaborador, $fechaIn, $fechaOut){
            $objDom = new PaginaController();
            $tabla = new Tablas();
            $objDom->setValue('id_colaborador', $id_colaborador);
            $objDom->setValue('fechaIn',  $fechaIn);
            $objDom->setValue('fechaOut',  $fechaOut);

        }


    }

?>

<!-- 
        <input type="text" name="id_edit_colaborador" value="'.$resultado['id_colaborador'].'">
                        <input type="text" name="user" id="" value="'.$resultado['nombre'].'">
                        <input type="text" name="name" id="" value="'.$resultado['fecha'].'">
                        <input type="text" name="rol" id="" value="'.$resultado['hora'].'"> -->
