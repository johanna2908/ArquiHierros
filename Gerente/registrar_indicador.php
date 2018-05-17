<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
?>
<title>Gerencia ArquiHierros</title>

<?php include('container.php');?>

<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Agregar Preguntas </h3>
                </div>
                <div class="panel-body">
                	<div class="btn-group">
                  		<button type="button" class="btn btn-warning">Tipo de Pregunta</button>
                  		<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                  		<ul class="dropdown-menu">
                    		<li><a href="#" id="cualitativo">Cualitativo</a></li>
                    		<li><a href="#" id="cuantitativo">Cuantitativo</a></li>
                  		</ul>
                	</div>

                    <form class="cuanti" method="post" role="form" action="registrar_indicador.php" >
                        <div class="cuanti">
                            <label>Pregunta Cuantitativa</label>
                        </div>
                        <textarea class="form-control" style="color:darkgreen;" name="preguntaCuantitativa" rows="3" placeholder="Digite la Pregunta Aquí..."></textarea><br/>
                        
                        <div class="form-group" id="cuanti">
                            <div class="form-group" id="cuanti">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="opcionCV">
                                        Cuantitativo Variable.
                                        <div class="checkbox">
                                        <label>Seleccione una Opcion: </label>
                                            <fieldset disabled>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1"> 1
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2"> 2
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="option3"> 3
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline4" value="option4"> 4
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline5" value="option5"> 5
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline6" value="option6"> 6
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline7" value="option7"> 7
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline8" value="option8"> 8
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline9" value="option9"> 9
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline10" value="option10"> 10
                                                </label>
                                            </fieldset>
                                        </div>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="opcionCF">
                                        Cuantitativo Fijo.
                                        <div class="checkbox">
                                            <fieldset disabled>
                                                <div class="form-group col-lg-6">
                                                    <label for="disabledSelect">Valor Fijo</label>
                                                    <input class="form-control" id="disabledInput" type="text" placeholder="Valor Fijo" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3 text-center"></div>
                            <div class="col-lg-6 text-center"></div>
                            <div class="col-lg-3 text-center">
                                <button type="submit" class="btn btn-block btn-info cuanti" name="guardacuanti">Guardar</button><br/>
                            </div>
                        </div>
                    </form>
                    <!-- formulario para pregunta cualitativa -->

                    <form class="cuali" method="post" role="form" action="registrar_indicador.php">
                        <div class="cuali">
                            <label>Pregunta Cualitativa</label>
                        </div>
                        <textarea class="form-control" style="color:darkgreen;" rows="3" name="preguntaCualitativa" placeholder="Digite la Pregunta Aquí..."></textarea><br/>
                        <fieldset disabled>
                        <div class="form-group" id="cuali">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                    Alto
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Medio
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                    Bajo
                                </label>
                            </div>
                        </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-lg-3 text-center"></div>
                            <div class="col-lg-6 text-center"></div>
                            <div class="col-lg-3 text-center">
                                <button type="submit" class="btn btn-block btn-info cuali" name="guardacuali">Guardar</button><br/>
                            </div>
                        </div>
                        
                    </form>
                    <div id="shieldui-grid1"><br/></div>
            	</div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?> 



<?php

include("../login/database/db_conection.php");//eso va a llamar a la BD
if(isset($_POST['guardacuali']))
{
    $preguntaCualitativa=$_POST['preguntaCualitativa'];
    $id="1";


    if($preguntaCualitativa=='')//este if valida si los camppos estan completos o no
    {
        
        echo"<script>alert('Hay Campos Vacíos')</script>";//la alerta 

    }

    else{//como los campos estan completos entramos en este else
        
        $verificar_pregunta="select * from indicador WHERE pregunta='$preguntaCualitativa'";//hacemos la consulta para saber si hay datos similares en la pregunta
        $ejecucion_query=mysqli_query($dbcon,$verificar_pregunta);//ejecutamos el query

        if(mysqli_num_rows($ejecucion_query)>0)//if que valida si encontró datos similares o no
        {//si hay datos similares ingresa al if
            echo "<script>alert('El indicador $preguntaCualitativa ya se encuentra registrado!');window.open('registrar_indicador.php','_self')</script>";//emite la alerta de que hay un doble registro
        }
        else{//si no hay doble registro se mete en el else
             
            $insert_indicador="insert into indicador (pregunta, id_tipo_pregunta) VALUE ('$preguntaCualitativa', '$id')";
            if(mysqli_query($dbcon,$insert_indicador))
            {
                echo "<script>alert('La pregunta $preguntaCualitativa fue registrada Satisfactoriamente!');window.open('registrar_indicador.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al registar!')</script>";//alerta para saber si no guardó
            }

            //opciones
            $consulta_indicador = "select MAX(id_indicador) as id_indicador FROM indicador"; // ahora obtenemos el id de la ultima fila,
                                                      // la que acabamos de ingresar,
                                                      // esto lo hacemos para poder asociarle las opciones
            $query_indicador =  mysqli_query($dbcon,$consulta_indicador);

            while($result = mysqli_fetch_object($query_indicador)){
                $id_indicador = $result->id_indicador; // con el resultado obtenido hacemos un bucle y definimos los resultados como id_encuesta.
            }
                $insert_opciones = "insert into opciones (nombre, valor, id_indicador) VALUE "; // En esta parte estamos armando un query SQL dinamico el cual sera modificado de acuerdo a lo que el usuario ingrese en el formulario.
                for($i=1;$i<=3;$i++){
                    if($i == 1){
                        $nombre = "Alto";
                    }
                    else if($i == 2){
                        $nombre = "Medio";
                    }
                    else{
                        $nombre = "Bajo";
                    }

                    if($nombre != ""){
                     $insert_opciones .= "('$nombre', '0', '$id_indicador')"; // el id de la opcion ira null para que se ponga automaticamente, en id_encuesta pues ira el id de la encuesta que acabamos de crear, en 'nombre' ira el nombre de la opcion y valor ira 0, puesto que es una nueva opcion sin votos, esto se repetira con todas las opciones que el usuario haya definido.
                    }
                
                    if($i == 3){
                        $insert_opciones .= ";"; // si es que se llega al final, termina la consulta
                        mysqli_query($dbcon,$insert_opciones);
                    }else{
                        $insert_opciones .= ", "; // sino se pone una , y se continua.
                    }
                }
            }
        }
    }


?>


<?php

include("../login/database/db_conection.php");//eso va a llamar a la BD
if(isset($_POST['guardacuanti'])){
    $preguntaCuantitativa=$_POST['preguntaCuantitativa'];
    if(isset($_POST['optionsRadios'])){
        if($_POST['optionsRadios'] == "opcionCF"){
            $id=2;
        }
        else if($_POST['optionsRadios'] == "opcionCV"){
            $id=3;
        }
    }
    else{
        $id=0;
        echo "<script>alert('Seleccione una opcion!')</script>";
        exit;
    }
    



    if($preguntaCuantitativa=='')//este if valida si los camppos estan completos o no
    {
        
        echo"<script>alert('Hay Campos Vacíos')</script>";//la alerta 

    }

    else{//como los campos estan completos entramos en este else
        if($id==2){
            $verificar_pregunta="select * from indicador WHERE pregunta='$preguntaCuantitativa'";//hacemos la consulta para saber si hay datos similares en la pregunta
            $ejecucion_query=mysqli_query($dbcon,$verificar_pregunta);//ejecutamos el query

            if(mysqli_num_rows($ejecucion_query)>0)//if que valida si encontró datos similares o no
            {//si hay datos similares ingresa al if
                echo "<script>alert('El indicador $preguntaCuantitativa ya se encuentra registrado!');window.open('registrar_indicador.php','_self')</script>";//emite la alerta de que hay un doble registro
            }
            else{//si no hay doble registro se mete en el else
            

                $insert_indicador="insert into indicador (pregunta, id_tipo_pregunta) VALUE ('$preguntaCuantitativa', '$id')";
                if(mysqli_query($dbcon,$insert_indicador))
                {
                    echo "<script>alert('La pregunta $preguntaCuantitativa fue registrada Satisfactoriamente!');window.open('registrar_indicador.php','_self')</script>";
                }
                else{
                    echo "<script>alert('Error al registar!')</script>";//alerta para saber si no guardó
                }

                //opciones
                $consulta_indicador = "select MAX(id_indicador) as id_indicador FROM indicador"; 
                $query_indicador =  mysqli_query($dbcon,$consulta_indicador);

                while($result = mysqli_fetch_object($query_indicador)){
                    $id_indicador = $result->id_indicador; // con el resultado obtenido hacemos un bucle y definimos los resultados como id_encuesta.
                }
                $insert_opciones = "insert into opciones (nombre, valor, id_indicador) VALUE ('Fijo', '0', '$id_indicador')"; // En esta parte estamos armando un query SQL dinamico el cual sera modificado de acuerdo a lo que el usuario ingrese en el formulario.
                mysqli_query($dbcon,$insert_opciones);
            }
        }
        else if($id==3){
            $verificar_pregunta="select * from indicador WHERE pregunta='$preguntaCuantitativa'";//hacemos la consulta para saber si hay datos similares en la pregunta
            $ejecucion_query=mysqli_query($dbcon,$verificar_pregunta);//ejecutamos el query

            if(mysqli_num_rows($ejecucion_query)>0)//if que valida si encontró datos similares o no
            {//si hay datos similares ingresa al if
                echo "<script>alert('El indicador $preguntaCuantitativa ya se encuentra registrado!');window.open('registrar_indicador.php','_self')</script>";//emite la alerta de que hay un doble registro
            }
            else{//si no hay doble registro se mete en el else
            

                $insert_indicador="insert into indicador (pregunta, id_tipo_pregunta) VALUE ('$preguntaCuantitativa', '$id')";
                if(mysqli_query($dbcon,$insert_indicador))
                {
                    echo "<script>alert('La pregunta $preguntaCuantitativa fue registrada Satisfactoriamente!');window.open('registrar_indicador.php','_self')</script>";
                }
                else{
                    echo "<script>alert('Error al registar!')</script>";//alerta para saber si no guardó
                }
                //opciones
                $consulta_indicador = "select MAX(id_indicador) as id_indicador FROM indicador"; 
                $query_indicador =  mysqli_query($dbcon,$consulta_indicador);

                while($result = mysqli_fetch_object($query_indicador)){
                    $id_indicador = $result->id_indicador; // con el resultado obtenido hacemos un bucle y definimos los resultados como id_encuesta.
                }
                $insert_opciones = "insert into opciones (nombre, valor, id_indicador) VALUE "; // En esta parte estamos armando un query SQL dinamico el cual sera modificado de acuerdo a lo que el usuario ingrese en el formulario.
                for($i=1;$i<=10;$i++){
                    if($i == 1){
                        $nombre = "1";
                    }
                    else if($i == 2){
                        $nombre = "2";
                    }
                    else if($i == 3){
                        $nombre = "3";
                    }
                    else if($i == 4){
                        $nombre = "4";
                    }
                    else if($i == 5){
                        $nombre = "5";
                    }
                    else if($i == 6){
                        $nombre = "6";
                    }
                    else if($i == 7){
                        $nombre = "7";
                    }
                    else if($i == 8){
                        $nombre = "8";
                    }
                    else if($i == 9){
                        $nombre = "9";
                    }
                    else{
                        $nombre = "10";
                    }

                    if($nombre != ""){
                        $insert_opciones .= "('$nombre', '0', '$id_indicador')"; // el id de la opcion ira null para que se ponga automaticamente, en id_encuesta pues ira el id de la encuesta que acabamos de crear, en 'nombre' ira el nombre de la opcion y valor ira 0, puesto que es una nueva opcion sin votos, esto se repetira con todas las opciones que el usuario haya definido.
                    }
                
                    if($i == 10){
                        $insert_opciones .= ";"; // si es que se llega al final, termina la consulta
                        mysqli_query($dbcon,$insert_opciones);
                    }else{
                        $insert_opciones .= ", "; // sino se pone una , y se continua.
                    }
                }
            }
        }
    }
}

?>