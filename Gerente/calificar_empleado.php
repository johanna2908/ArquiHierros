<?php 
	session_start();
	include('header.php');

	if(!$_SESSION['email'])
	{

    	header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
	}

	if(isset($_POST['register']))
{
    include("../login/database/db_conection.php");

    $documento=$_POST['documento'];

    $check_user="select * from usuarios WHERE documento='$documento'";

    $run=mysqli_query($dbcon,$check_user);

    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
    {
        $documento=$row[1];
    } 

    if(mysqli_num_rows($run))
    {

            echo "<script>window.open('evaluar.php','_self')</script>";

            $_SESSION['documento']=$documento;//here session is used and value of $user_email store in $_SESSION.

    }
    else
    {
        echo "<script>alert('No Existe el Trabajador!');window.open('calificar_empleado.php','_self')</script>";
    }
}
?>

<title>Calificar Trabajador ArquiHierros</title>

<?php include('container.php');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center v-center">
            <p class="lead">Buscar Trabajador</p>
            <form class="col-lg-12" role="form" method="post" action="calificar_empleado.php">
                <div class="input-group" style="width: 400px; text-align: center; margin: 0 auto;">
                    <input class="form-control input-lg" placeholder="Digite Documento del Trabajador" type="text" name="documento">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-lg btn-primary" name="register">
	                       	<i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

</div>

<?php include('footer.php');?> 