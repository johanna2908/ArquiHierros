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
                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Listado de Empleados </h3>
                </div>
                <div class="panel-body">
                    <div id="shieldui-grid1"></div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Documento</th>
                                <th>Nombres y Apellidos</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Modificar Usuario</th>
                                <th>Borrar Usuario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <?php
                            include("../login/database/db_conection.php");
                            $view_users_query="select * from usuarios";//select query for viewing users.
                            $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
                            {
                                $user_id=$row[0];
                                $documento=$row[1];
                                $nombres=$row[2];
                                $apellidos=$row[3];
                                $email=$row[4];
                                $password=$row[5];
                                $rol=$row[6];
                                $estado = ($row[7] == 1) ? "Activo" : "Inactivo";
                                $colors = ($row[7] == 1) ? "success" : "danger";
                        ?>

                            <tr>
                                <td><?php echo $user_id;  ?></td>
                                <td><?php echo $documento;  ?></td>
                                <td><?php echo $nombres; echo " "; echo $apellidos; ?></td>
                                <td><?php echo $email;  ?></td>
                                <td><?php echo $rol;  ?></td>
                                <td><a href="modificar_empleado.php?upt=<?php echo $user_id ?>"><button class="btn btn-info glyphicon glyphicon-pencil"></button></a></i></td>
                                <td><a href="eliminar.php?del=<?php echo $user_id ?>"><button class="btn btn-danger glyphicon glyphicon-trash"></button></a></td>
                                <td><span class="label label-<?php echo $colors; ?>"><?php echo $estado; ?></span></td>
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