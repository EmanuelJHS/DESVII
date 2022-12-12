
<?php

include_once("..//lib/utility.php");
include_once("../class/usuario.php");

class VistaUsuarioEditar{



    public function editar($id_colaborador){

        $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/select_1.php';
        $data = array(
            'id_colaborador'=>''.$id_colaborador.'',
        );
        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $response = json_decode($result,true);

        $arg =  $response['records'];

        $registros = $arg[0];
        if(count($registros)>1){

            echo '
                <div class="ventana_usuario_agregar">
                <form action="../lib/usuario_editar.php" method="post" class="form_usuario_agregar">
                    <input type="text" name="id" id="" value="'.$registros['id'].'" hidden> 
                <br>
                    <table>
                        <tr>
                            <td>ID Colaborador</td>
                            <td><input type="text" name="id_colaborador" id="" value="'.$registros['id_colaborador'].'" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="">Usuario:</label></td>
                            <td><input type="text" name="user" id="" value="'.$registros['user'].'"></td>
                        </tr>
                        <tr>
                            <td><label for="">Contraseña:</label></td>
                            <td><input type="text" name="pass" id="" value="'.$registros['pass'].'"></td>
                        </tr>
                        <tr>
                            <td><label for="">Nombre:</label></td>
                            <td><input type="text" name="name" id="" value="'.$registros['name'].'"></td>
                        </tr>
                        <tr>
                            <td><label for="">Rol:</label></td>
                            <td><select name="rol" id="rol">
                                    <option value="ad" selected>Administrador</option>
                                    <option value="co">Colaborador</option>
                                    <option value="sp">Supervisor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Estado:</label> </td>
                            <td>
                                <select name="estado" id="estado">
                                <option value="a" selected>Activo</option>
                                <option value="i">Inactivo</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                    <div class="btn_agregar_usuario">
                    <input type="submit" value="Actualizar" name="btn_actualizar_usuario">

                    </div>
                    
                </form>
                </div>

            ';


        }else{
            
        }

        $objDom = new PaginaController();
        $tabla = new Tablas();
        $objDom->selectedIndex('rol',  $tabla->RolIndex($registros['rol']));
        $objDom->selectedIndex('estado',  $tabla->EstadoIndex($registros['estado']));

    }

}


?>


<!-- <form action="../lib/usuario_editar.php" method="post">
                <input type="text" name="id" id="" value="'.$registros['id'].'" hidden> <br>

                <label for="">ID Colaborador:</label> <input type="text" name="id_colaborador" id="" value="'.$registros['id_colaborador'].'"  readonly> <br>
                <label for="">Usuario:</label> <input type="text" name="user" id="" value="'.$registros['user'].'"> <br>
                <label for="">Contraseña:</label> <input type="text" name="pass" id="" value="'.$registros['pass'].'"> <br>
                <label for="">Nombre:</label> <input type="text" name="name" id="" value="'.$registros['name'].'" > <br>
                <label for="">Rol:</label> <select name="rol" id="rol" >
                    <option value="ad" >Administrador</option>
                    <option value="co">Colaborador</option>
                    <option value="sp">Supervisor</option>
                </select>
                <br>
                <label for="">Estado:</label>  <select name="estado" id="estado" >
                    <option value="a" >Activo</option>
                    <option value="i">Inactivo</option>
                </select>
                 <br>
                 <input type="submit" value="Actualizar" name="btn_actualizar_usuario">
            </form> -->



