<?php
/**
 * Created by PhpStorm.
 * User: Ehtesham Mehmood
 * Date: 11/24/2014
 * Time: 11:55 PM
 */
include("../login/database/db_conection.php");
$delete_id=$_GET['del'];

$busqueda="select * from usuarios where id_usuario='$delete_id'";
$buscar=mysqli_query($dbcon,$busqueda);

while($usuario=mysqli_fetch_array($buscar))//while look to fetch the result and store in a array $row.
{
    $id_usuario=$usuario[0];
    $documento=$usuario[1];
    $nombres=$usuario[2];
    $apellidos=$usuario[3];
    $email=$usuario[4];
    $password=$usuario[5];
    $rol=$usuario[6];
}

$delete_query="delete from usuarios WHERE id_usuario='$delete_id'";//delete query
$run=mysqli_query($dbcon,$delete_query);
if($run)
{
	//javascript function to open in the same window
    echo "<script>alert('El Empleado $nombres $apellidos identificado con el documento $documento eliminado Satisfactoriamente!');window.open('listar_empleados.php','_self')</script>";
}
else{
    echo "<script>alert('Error al eliminar!');window.open('listar_empleados.php','_self')</script>";
}

?>