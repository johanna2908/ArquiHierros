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

$busqueda="select * from indicador where id_indicador='$id_modificar'";
$run=mysqli_query($dbcon,$busqueda);

while($indicador=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
{
    $id_indicador=$indicador[0];
    $pregunta=$indicador[1];

}
?>

    <div class="col-lg-3"></div>

    <div class="col-lg-6">
        <form class="panel panel-primary" role="form" method="post" action="modificar_indicador.php?upt=<?php echo $id_indicador ?>">
            <div class="row text-center">
                <h2>Modificar Indicador</h2><br/>
            </div>
             <div>
                <label for="lastname" class="col-md-2">
                    Indicador Actual:
                </label>
                <div class="col-md-9">
                     <textarea class="form-control" style="color: darkgreen;" name="pregunta" rows="3" disabled><?php echo $pregunta; ?></textarea><br/>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div>
                <label for="lastname" class="col-md-2">
                    Nuevo Indicador:
                </label>
                <div class="col-md-9">
                     <textarea class="form-control" value="<?php echo $pregunta; ?>" name="pregunta" rows="3" placeholder="Digite el indicador Aquí..."></textarea><br/>
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
            </div><br/>
        </form>
    </div>

<?php include('footer.php');?> 

<?php

if(isset($_POST['actualizar']))
{
    $pregunta=$_POST['pregunta'];//same



    if($pregunta=='')
    {
        //javascript use for input checking
        echo"<script>alert('Hay Campos Vacíos')</script>";

    }
    else{
            $actualizar="update indicador set pregunta='$pregunta' WHERE id_indicador='$id_modificar'";

            if(mysqli_query($dbcon,$actualizar))
            {
                echo "<script>alert('El Indicador fue actualizado Satisfactoriamente!');window.open('listar_indicador.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al actualizar!')</script>";
            }
        }
    }


?>