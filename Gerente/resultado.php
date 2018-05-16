<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/js/modules/exporting.js"></script>


<?php

include("../login/database/db_conection.php");

if(!isset($_GET['id'])){
	header('location: index.php');
}

$suma = 0;
$id = $_GET['id'];
$mod = @mysqli_query($dbcon,"SELECT SUM(valor) as valor FROM opciones WHERE id_indicador = ".$id);
while($result = @mysqli_fetch_object($mod)){
	$suma = $result->valor;
}

?>

<title>Gerencia ArquiHierros</title>

<?php include('container.php');?>

<div id="page-wrapper">
	<form action="" method="post">
		<div id="col-lg-12">
			<?php
			$aux = 0;
			$sql = "SELECT indicador.pregunta as titulo, opciones.id as id, opciones.nombre as nombre, opciones.valor as valor FROM indicador INNER JOIN opciones ON indicador.id_indicador = opciones.id_indicador WHERE indicador.id_indicador = ".$id;
			$req = @mysqli_query($dbcon,$sql);

			while($result = @mysqli_fetch_object($req)){
				if($result->nombre == "Fijo"){
					$func = "SELECT r.id_indicador_rta , COUNT(r.id_indicador_rta) as cantidad, 
					sum(respuesta)/COUNT(r.id_indicador_rta) as Dato
					FROM respuestas r, indicador i, tipo t 
					WHERE r.id_indicador_rta = i.id_indicador AND i.id_tipo_pregunta = t.id_tipo AND t.id_tipo = 2
					AND r.id_indicador_rta = $id
					GROUP BY  r.id_indicador_rta;";
					$eje_query = mysqli_query($dbcon,$func);
					if(mysqli_num_rows($eje_query)>0)
        			{
        				while($dato=mysqli_fetch_array($eje_query))//while look to fetch the result and store in a array $trabajador.
    					{
							$datono = $dato["Dato"];
							$cantidadEmpleados = $dato["cantidad"];
    					}
					}

					$muestraGrafica = array();
					for ($i=0; $i < $cantidadEmpleados ; $i++) { 
						$muestraGrafica[$i] = $datono;
					}

					$sql = "SELECT CONCAT(u.nombres, ' ', u.apellidos) as nom,
					r.respuesta
					FROM respuestas r
					LEFT JOIN usuarios u on r.id_usuario_rta = u.documento
					LEFT JOIN indicador i on r.id_indicador_rta = i.id_indicador
					LEFT JOIN tipo t on i.id_tipo_pregunta = t.id_tipo 
					WHERE r.id_indicador_rta = i.id_indicador and i.id_tipo_pregunta = t.id_tipo and t.id_tipo = 2
					AND r.id_indicador_rta = $id
					ORDER BY t.tipo_pregunta, u.nombres";
					$eje_query = mysqli_query($dbcon,$sql);
					$informacion = array('nombre' => array(), 'respuesta' => array());
					$idx = 0;
					while($result = mysqli_fetch_object($eje_query)){
						array_push($informacion['nombre'],$result->nom);
						array_push($informacion['respuesta'],$result->respuesta);
						$i++;
					}
					
					echo "<h1 class='page-header'>Media ".$datono."</h1>";
					echo "<br/><br/><br/>";
					echo "<div id='container' style='height: 400px'></div>";
					echo "<script>
					Highcharts.chart('container', {

						title: {
							text: 'Grafica Cuantitativo Fijo'
						},
						yAxis: {
							title: 'Valores',
						},
						xAxis: {
							title: 'Empleados',
							categories: ['".implode("','",$informacion['nombre'])."']
						},
						tooltip: {
							formatter: function () {
								return '<b>' + this.series.name + '</b><br/>' +
									this.x + ': ' + this.y;
							}
						},series: [{
							color: 'red',
							name: 'Muestra',
							data: [".implode(",",$muestraGrafica)."]
						},{
							name: 'Respuesta',
							data: [".implode(",",$informacion['respuesta'])."]
						}]
					
					});
					</script>";
				}
				else{
					if($aux == 0){
						echo "<h1 class='page-header'>".$result->titulo."</h1>";
						echo "<div class='bs-example'>";
						$aux = 1;
					}
					echo '<br/><div class="text-left">'.$result->nombre.'</div><div class="text-center">Votos: '.$result->valor.'</div>';
			    	if($suma == 0){
		    			echo '<div class="progress">';
			        	echo '<div class="progress" style="width:0%;"></div>'; 	
					}else{
		        		echo '<div class="progress-bar progress-bar-striped active" style="width:'.($result->valor*100/$suma).'%;">'.round($result->valor*100/$suma).'%</div>';

			    	}
				}
				

			}
			echo '</div>';
			echo '</div>';	

			if(isset($aux)){
				echo '<br/><br/><span class="fr">Total: '.$suma.'</span><br/>';
				echo '<a href="javascript:window.history.back();" class="volver">← Volver</a>';
			}

?>
</div>
</form>

</div>
<?php include('footer.php');?> 