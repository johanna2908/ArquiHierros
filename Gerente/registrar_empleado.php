<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
?>
<title>Administrador ArquiHierros</title>

<?php include('container.php');?>


    <div class="col-lg-3"></div>

    <div class="col-lg-6">
        <form class="panel panel-primary" role="form" method="post" action="registrar_empleado.php">
            <div class="row text-center">
                <h2>Registro Empleado</h2><br/>
            </div>
            <div>
                <label for="lastname" class="col-md-2">
                    Documento:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="documento"><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="firstname" class="col-md-2">
                    Nombres:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nombres"><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>        
            <div>
                <label for="lastname" class="col-md-2">
                    Apellidos:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="apellidos"><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="emailaddress" class="col-md-2">
                    Correo Electrónico:
                </label>
                <div class="col-md-9">
                    <input type="email" class="form-control" name="correo">
                    <p class="help-block">
                        Ejemplo: tunombre@dominio.com
                    </p><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="password" class="col-md-2">
                    Contraseña:
                </label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="password">
                    <p class="help-block">
                        Min: 6 Caracteres (Solo Alfanumerico)
                    </p><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="country" class="col-md-2">
                    Rol:
                </label>
                <div class="col-md-9">
                    <select name="rol" name="rol" class="form-control">
                        <option value="0">--Seleccione una Opción--</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Gerente">Gerente</option>
                    </select><br/>
                </div>            
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-info" name="register">
                        Registrar
                    </button>
                </div>
            </div><br/>
        </form>
    </div>

<?php include('footer.php');?> 

<?php

include("../login/database/db_conection.php");//make connection here
if(isset($_POST['register']))
{
    $documento=$_POST['documento'];//here getting result from the post array after submitting the form.
    $nombres=$_POST['nombres'];//same
    $apellidos=$_POST['apellidos'];//same
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    $rol=$_POST['rol'];


    if($documento=='' || $nombres==''||$apellidos==''||$correo==''||$password=='')
    {
        //javascript use for input checking
        echo"<script>alert('Hay Campos Vacíos')</script>";

    }
    else if($rol=='0'){
        echo"<script>alert('Seleccione un Rol')</script>";
    }
    else{
        //here query check weather if user already registered so can't register again.
        $check_email_query="select * from usuarios WHERE documento='$documento'";
        $run_query=mysqli_query($dbcon,$check_email_query);

        if(mysqli_num_rows($run_query)>0)
        {
            echo "<script>alert('El Empleado $nombres $apellidos identificado con el documento $documento ya se encuentra registrado!')</script>";
        }
        else{
             //insert the user into the database.
            $insert_user="insert into usuarios (documento, nombres, apellidos, correo, password, rol) VALUE ('$documento', '$nombres', '$apellidos', '$correo', '$password', '$rol')";
            if(mysqli_query($dbcon,$insert_user))
            {
                echo "<script>alert('El Empleado $nombres $apellidos identificado con el documento $documento registrado Satisfactoriamente!');window.open('listar_empleados.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al registar!')</script>";
            }
        }
    }

}

?>