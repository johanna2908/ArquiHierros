<?php
include("../login/database/db_conection.php");
$delete_id=$_GET['del'];

$busqueda="select * from indicador where id_indicador='$delete_id'";
$buscar=mysqli_query($dbcon,$busqueda);

while($indicador=mysqli_fetch_array($buscar))//while look to fetch the result and store in a array $row.
{
    $id_indicador=$indicador[0];
}

$delete_query="UPDATE indicador SET estado=0 WHERE id_indicador='$delete_id'";//delete query
$run=mysqli_query($dbcon,$delete_query);
if($run)
{
	//javascript function to open in the same window
    echo "<script>alert('El indicador $id_indicador eliminado Satisfactoriamente!');window.open('listar_indicador.php','_self')</script>";
}
else{
    echo "<script>alert('Error al eliminar!');window.open('listar_indicador.php','_self')</script>";
}

?>