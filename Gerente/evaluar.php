<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
if(!$_SESSION['documento'])
{

    header("Location: calificar_empleado.php");//redirect to login page to secure the welcome page without login access.
}
else{
		$documento_trab=$_SESSION['documento'];

		if($documento_trab == ''){
			echo"<script>alert('Hay Campos Vacíos')</script>";
			$id_trabajador="";
        	$documento_trabajador="";
        	$nombre_trabajador="";
        	$apellido_trabajador="";
        	$correo_trabajador="";
        	$password_trabajador="";
        	$rol_trabajador="";
		}
		else{
			include("../login/database/db_conection.php");
    		$buscar="select * from usuarios WHERE documento='$documento_trab'";//select query for viewing users.
    		$ejecutar=mysqli_query($dbcon,$buscar);//here run the sql query.

    		if(mysqli_num_rows($ejecutar)>0)
        	{
        		while($trabajador=mysqli_fetch_array($ejecutar))//while look to fetch the result and store in a array $trabajador.
    			{
        			$id_trabajador=$trabajador[0];
        			$documento_trabajador=$trabajador[1];
        			$nombre_trabajador=$trabajador[2];
        			$apellido_trabajador=$trabajador[3];
        			$correo_trabajador=$trabajador[4];
        			$password_trabajador=$trabajador[5];
        			$rol_trabajador=$trabajador[6];
    			}
        	}
        	else{
        		echo "<script>alert('El Documento $documento_trab no encuentra registrado!')</script>";
        		$id_trabajador="";
        		$documento_trabajador="";
        		$nombre_trabajador="";
        		$apellido_trabajador="";
        		$correo_trabajador="";
        		$password_trabajador="";
        		$rol_trabajador="";
        	}
		}
	}
?>
<?php
include("../login/database/db_conection.php");
$sql = "SELECT * FROM indicador ORDER BY id_indicador DESC";
$req = mysqli_query($dbcon, $sql);
?>

<title>Gerencia ArquiHierros</title>

<?php include('container.php');?>


<div class="col-lg-3"></div>

    <div class="col-lg-6">
        <form class="panel panel-primary" role="form" method="post" action="modificar_indicador.php?upt=<?php echo $id_indicador ?>">
            <div class="row text-center">
                <h2>Datos Trabajador</h2><br/>
            </div>
                <dl class="dl-horizontal">
                        <dt>Documento</dt>
                        <dd name="documento"><?php echo $documento_trabajador; ?></dd>
                        <dt>Nombre</dt>
                        <dd><?php echo $nombre_trabajador; ?></dd>
                        <dt>Apellido</dt>
                        <dd><?php echo $apellido_trabajador; ?></dd>
                </dl>
        </form>
    </div>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Selecciona El Indicador a Evaluar </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <ul class="nav nav-pills nav-stacked" style="max-width: 500px;">
                                <td>
                                <?php
                                     while($result = mysqli_fetch_object($req)){ // recoge los resultados del sql
                                        echo '<li><a href="encuesta.php?id='.$result->id_indicador.'&do='.$documento_trabajador.'">'.$result->pregunta.'</a></li>'; //estoy llamando el titulo con mi id, q me muestre la pregunta
                                    }
                                 ?>
                             </td>
                         </ul>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
