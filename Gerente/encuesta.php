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

<?php
include("../login/database/db_conection.php");
        $id_pregunta = $_GET['id'];
        $id_usuario = $_GET['do'];
	if(!isset($_GET['id'])){
		header('location: evaluar.php');
	}

	if(isset($_POST['votar']))
	{

		if(isset($_POST['valor'])){

			$opciones = $_POST['valor'];
			$mod = mysqli_query($dbcon, "SELECT * FROM opciones WHERE id = ".$opciones);
			while($result = mysqli_fetch_object($mod)){
				$valor = $result->valor + 1; // obtenemos el valor de 'valor' y le añadimos 1 unidad
				$nombre = $result->nombre;
				mysqli_query($dbcon, "UPDATE opciones SET valor ='".$valor."' WHERE id = ".$opciones); // luego ejecutamos el query SQL
			}
			$insert_respuesta="insert into respuestas (respuesta, id_usuario_rta, id_indicador_rta) VALUE ('$nombre', '$id_usuario', '$id_pregunta')";
            if(mysqli_query($dbcon,$insert_respuesta))
            {
                echo "<script>alert('Su Respuesta fue registrada satisfactoriamente!');window.open('evaluar.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al registar!')</script>";
            }
		}
		else if(isset($_POST['valFijo'])){
			$valFijo=$_POST['valFijo'];
			$rta=$_POST['respuesta'];

			$mod = mysqli_query($dbcon, "SELECT * FROM opciones WHERE id = ".$valFijo);
			while($result = mysqli_fetch_object($mod)){
				$valor = $result->valor + 1; // obtenemos el valor de 'valor' y le añadimos 1 unidad
				mysqli_query($dbcon, "UPDATE opciones SET valor ='".$valor."' WHERE id = ".$valFijo); // luego ejecutamos el query SQL
			}
			$insert_respuesta="insert into respuestas (respuesta, id_usuario_rta, id_indicador_rta) VALUE ('$rta', '$id_usuario', '$id_pregunta')";
            if(mysqli_query($dbcon,$insert_respuesta))
            {
                echo "<script>alert('Su Respuesta fue registrada satisfactoriamente!');window.open('evaluar.php','_self')</script>";
            }
            else{
                echo "<script>alert('Error al registar!')</script>";
            }
		}
	}
?>

<?php include('container.php');

$sql = "select * from respuestas where id_usuario_rta = '".$id_usuario."' and id_indicador_rta = ".$id_pregunta;  
		$req = mysqli_query($dbcon, $sql); 
if(mysqli_num_rows($req) > 0){

	echo "<script>if(!confirm('El empleado ya cuenta con una calificación Desea calificarlo nuevamente')){
		window.history.back();
	}
	</script>";

}


?>

<div id="page-wrapper">
	<form action="" method="post">
		<?php
		$aux = 0;
		$sql = "SELECT indicador.pregunta as pregunta, opciones.id as id, opciones.nombre as nombre, opciones.valor as valor FROM indicador INNER JOIN opciones ON indicador.id_indicador = opciones.id_indicador WHERE indicador.id_indicador =".$id_pregunta;  // se hace la union de tablas por el inner join 
		$req = mysqli_query($dbcon, $sql); 

		while($result = mysqli_fetch_object($req)){
			if($result->nombre == "Fijo"){
				echo '<h1 class="page-header">'.$result->pregunta.'</h1>';
				echo '<input name="valFijo" value="'.$result->id.'" readonly class="hidden"></input>';
				echo '<input name="respuesta" value="" class="form-control"></input>';
			}
			else {
				if($aux == 0){
					echo '<h1 class="page-header">'.$result->pregunta.'</h1><div class="radio">';

					echo '<ul class="radio">';
					$aux = 1;
				}

				echo '<li><input name="valor" type="radio" value="'.$result->id.'"><span>'.$result->nombre.'</span></li>';

				}
			}
			
			echo '</ul></div>';	

			if(!isset($_POST['valor'])){
				echo "<br /><div class='error'>Selecciona una opcion.</div><br/>";
			}
			

			echo '<input name="votar" type="submit" class="btn btn-info" value="Votar"><br/><br/>';
			echo '<a href="resultado.php?id='.$id_pregunta.'" class="btn btn-success btn-xs">Ver Resultados</a><br/>';
			echo '<a href="index.php" class="btn btn-danger btn-xs">&larr; Volver</a>';

		?>

	</form>
</div>

<?php include('footer.php');?> 