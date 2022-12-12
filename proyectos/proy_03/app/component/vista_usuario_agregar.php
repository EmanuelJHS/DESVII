

<div class="ventana_usuario_agregar">
    <form action="../lib/usuario_agregar.php" method="post" class="form_usuario_agregar">
     <br>
        <table>
             <tr>
                <td>ID Colaborador</td>
                <td><input type="text" name="id_colaborador" id=""></td>
            </tr>
            <tr>
                <td><label for="">Usuario:</label></td>
                <td><input type="text" name="user" id=""></td>
            </tr>
            <tr>
                <td><label for="">Contraseña:</label></td>
                <td><input type="text" name="pass" id=""></td>
            </tr>
            <tr>
                <td><label for="">Nombre:</label></td>
                <td><input type="text" name="name" id=""></td>
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
        <input type="submit" value="Agregar" name="btn_agregar_usuario" >

        </div>
        
    </form>
</div>