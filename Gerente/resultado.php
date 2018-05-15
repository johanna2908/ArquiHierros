<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
?>
<script src="https://code.highcharts.com/highcharts.js"></script>


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
					$func = "SELECT sum(CAST(respuesta AS DECIMAL))/count(*) as Dato from respuestas a, indicador b, tipo c where a.id_indicador_rta = b.id_indicador and b.id_tipo_pregunta = c.id_tipo and c.id_tipo = 2";
					$eje_query = mysqli_query($dbcon,$func);
					if(mysqli_num_rows($eje_query)>0)
        			{
        				while($dato=mysqli_fetch_array($eje_query))//while look to fetch the result and store in a array $trabajador.
    					{
        					$datono=$dato["Dato"];
    					}
        			}
					echo "<h1 class='page-header'>Media ".$datono."</h1>";
					echo "<br/><br/><br/>";
					echo "<div id='container' style='height: 400px'></div>";
					echo "<script>
					
Highcharts.chart('container', {
    chart: {
        //alignTicks: false,
        type: 'line'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: [{
        title: {
            text: 'Primary Axis'
        },
        gridLineWidth: 0
    }, {
        title: {
            text: 'Secondary Axis'
        },
        opposite: true
    }],
    legend: {
        layout: 'vertical',
        backgroundColor: '#FFFFFF',
        floating: true,
        align: 'left',
        x: 100,
        verticalAlign: 'top',
        y: 70
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.x + ': ' + this.y;
        }
    },
    plotOptions: {
    },
    series: [{
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }, {
        data: [129.9, 271.5, 306.4, 29.2, 544.0, 376.0, 435.6, 348.5, 216.4, 294.1, 35.6, 354.4],
        yAxis: 1

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
				echo '<a href="encuesta.php?id='.$id.'"" class="volver">← Volver</a>';
			}

?>
</div>
</form>

</div>
<?php include('footer.php');?> 