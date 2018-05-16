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
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Listado de Indicadores </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr align="center">
                                <th>Id</th>
                                <th>Indicador</th>
                                <th>Modificar Indicador</th>
                                <th>Borrar Indicador</th>
                                <th>Resultados Indicador</th>
                            </tr>
                        </thead>

                        <?php
                            include("../login/database/db_conection.php");
                            $view_users_query="select * from indicador";//select query for viewing users.
                            $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
                            {
                                $user_id=$row[0];
                                $indicador=$row[1];
                               
                        ?>

                            <tr>
                                <td><?php echo $user_id;  ?></td>
                                <td><?php echo $indicador;  ?></td>
                                <td><a href="modificar_indicador.php?upt=<?php echo $user_id ?>"><button class="btn btn-info glyphicon glyphicon-pencil"></button></a></i></td>
                                <td><a href="eliminar_indicador.php?del=<?php echo $user_id ?>"><button class="btn btn-danger glyphicon glyphicon-trash"></button></a></td>
                                <td><a href="resultado.php?id=<?php echo $user_id ?>"><button class="btn btn-success glyphicon glyphicon-stats"></button></a></td>
                            </tr>

                        <?php 
                            } 
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?> 