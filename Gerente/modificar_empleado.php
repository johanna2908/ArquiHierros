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

<?php

$id_modificar=$_GET['upt'];

$busqueda="select * from usuarios where id_usuario='$id_modificar'";
$run=mysqli_query($dbcon,$busqueda);

while($usuario=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
{
    $id_usuario=$usuario[0];
    $documento=$usuario[1];
    $nombres=$usuario[2];
    $apellidos=$usuario[3];
    $email=$usuario[4];
    $password=$usuario[5];
    $rol=$usuario[6];
    $check = ($usuario[7] == 1) ? "checked" :  "";
    $estado = $usuario[7];
}
?>

    <div class="col-lg-3"></div>

    <div class="col-lg-6">
        <form class="panel panel-primary" role="form" method="post" action="modificar_empleado.php?upt=<?php echo $id_usuario ?>">
            <div class="row text-center">
                <h2>Modificar Empleado</h2><br/>
            </div>
            <div>
                <label for="lastname" class="col-md-2">
                    Documento:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" style="color:darkgreen;" value="<?php echo $documento; ?>" name="documento" disabled><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="firstname" class="col-md-2">
                    Nombres:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" style="color:darkgreen;"  value="<?php echo $nombres; ?>" name="nombres"><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>        
            <div>
                <label for="lastname" class="col-md-2">
                    Apellidos:
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" style="color:darkgreen;" value="<?php echo $apellidos; ?>" name="apellidos"><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="emailaddress" class="col-md-2">
                    Correo Electrónico:
                </label>
                <div class="col-md-9">
                    <input type="email" class="form-control" style="color:darkgreen;" value="<?php echo $email; ?>" name="correo">
                    <p class="help-block">
                        Ejemplo: tunombre@dominio.com
                    </p><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="lastname" class="col-md-2">
                    Estado:
                </label>
                <div class="col-md-9">
                    <input type="checkbox" class="form-control" name="estado" <?php echo $check; ?>><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-info" name="actualizar">
                        Modificar
                    </button>
                </div>
            </div>
            <br/>
        </form>
    </div>

<?php include('footer.php');?> 

<?php

if(isset($_POST['actualizar']))
{
    $nombres=$_POST['nombres'];//same
    $apellidos=$_POST['apellidos'];//same
    $correo=$_POST['correo'];
    $estado = (isset($_POST['estado']) && $_POST['estado'] == 'on') ? 1 : 0;


    if($correo=='' || $nombres==''||$apellidos=='')
    {
        //javascript use for input checking
        echo"<script>alert('Hay Campos Vacíos')</script>";

    }
    else{
            $actualizar="update usuarios set nombres='$nombres', apellidos='$apellidos', correo='$correo', estado=$estado WHERE id_usuario='$id_modificar'";
error_log($actualizar);
            if(mysqli_query($dbcon,$actualizar))
            {
                echo "<script>alert('El Empleado $nombres $apellidos identificado con el documento $documento actualizado Satisfactoriamente!');window.open('listar_empleados.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al actualizar!')</script>";
            }
        }
    }


?>