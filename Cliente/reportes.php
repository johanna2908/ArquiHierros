<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{
    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}

include("../login/database/db_conection.php");
$sql = "SELECT
        t.tipo_pregunta, r.respuesta, u.nombres,
        CASE WHEN t.tipo_pregunta = 'Cualitativo' THEN 'Alto - Medio - Bajo'
            WHEN t.tipo_pregunta = 'Cuantitativo Fijo' THEN (SELECT sum(respuesta)/count(*) as Dato FROM respuestas a, indicador b, tipo c 
            WHERE a.id_indicador_rta = b.id_indicador and b.id_tipo_pregunta = c.id_tipo and c.id_tipo = 2)
            WHEN t.tipo_pregunta = 'Cuantitativo Variable' THEN '1 - 10'
        END as mediciones,
        CASE WHEN t.tipo_pregunta = 'Cuantitativo Fijo'
            THEN 
                CASE WHEN (SELECT sum(respuesta)/count(*) as Dato FROM respuestas a, indicador b, tipo c 
            WHERE a.id_indicador_rta = b.id_indicador and b.id_tipo_pregunta = c.id_tipo and c.id_tipo = 2) > r.respuesta
                THEN 'Por debajo'
                WHEN (SELECT sum(respuesta)/count(*) as Dato FROM respuestas a, indicador b, tipo c 
            WHERE a.id_indicador_rta = b.id_indicador and b.id_tipo_pregunta = c.id_tipo and c.id_tipo = 2) < r.respuesta
                THEN 'Por encima'
                WHEN (SELECT sum(respuesta)/count(*) as Dato FROM respuestas a, indicador b, tipo c 
            WHERE a.id_indicador_rta = b.id_indicador and b.id_tipo_pregunta = c.id_tipo and c.id_tipo = 2) = r.respuesta
                THEN 'Sobre la media'
                END
        END as finalrespuesta,
        t.*, i.*, u.*, r.*
        FROM respuestas r
        LEFT JOIN usuarios u on r.id_usuario_rta = u.documento 
        LEFT JOIN indicador i on r.id_indicador_rta = i.id_indicador
        LEFT JOIN tipo t on i.id_tipo_pregunta = t.id_tipo
        WHERE u.documento = '{$_SESSION['documento']}'
        ORDER BY t.tipo_pregunta, r.respuesta";
?>
<title>Gerencia ArquiHierros</title>

<?php include('container.php');?>

<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Cualitativo </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Referencia medición</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <?php
                            $eje_query = mysqli_query($dbcon,$sql);
                            while($row = mysqli_fetch_object($eje_query))
                            {
                                if($row->id_tipo == 1){
                        ?>

                            <tr>
                                <td><?php echo $row->nombres . ' ' . $row->apellidos;  ?></td>
                                <td><?php echo $row->mediciones;  ?></td>
                                <td><?php echo $row->respuesta; ?></td>
                            </tr>
                        <?php 
                                } 
                            } 
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Cuantitativo Fijo </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Referencia medición</th>
                                <th>Resultado</th>
                                <th>Resultado Final</th>
                            </tr>
                        </thead>
                        <?php
                            $eje_query = mysqli_query($dbcon,$sql);
                            while($row = mysqli_fetch_object($eje_query))
                            {
                                if($row->id_tipo == 2){
                        ?>

                            <tr>
                                <td><?php echo $row->nombres . ' ' . $row->apellidos;  ?></td>
                                <td><?php echo $row->mediciones;  ?></td>
                                <td><?php echo $row->respuesta; ?></td>
                                <?php
                                $colors = ($row->finalrespuesta == "Por debajo") ? "danger" : "success";
                                ?>
                                <td><span class="label label-<?php echo $colors; ?>"><?php echo $row->finalrespuesta; ?></span></td>
                            </tr>
                        <?php 
                                } 
                            } 
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Cuantitativo Variable </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Referencia medición</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <?php
                            $eje_query = mysqli_query($dbcon,$sql);
                            while($row = mysqli_fetch_object($eje_query))
                            {
                                if($row->id_tipo == 3){
                        ?>

                            <tr>
                                <td><?php echo $row->nombres . ' ' . $row->apellidos;  ?></td>
                                <td><?php echo $row->mediciones;  ?></td>
                                <td><?php echo $row->respuesta; ?></td>
                            </tr>
                        <?php 
                                } 
                            } 
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?> 