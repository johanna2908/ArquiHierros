<?php
session_start();//session starts here

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Iniciar Sesión</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">

                </button>
                <a class="navbar-brand" href="index.html">ArquiHierros</a>
            </div>
        </nav>
    

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i> Iniciar Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="login.php">
                            <fieldset>
                                <div class="form-group input-group"  >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input class="form-control" placeholder="Correo Electrónico" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" placeholder="Contraseña" name="pass" type="password" value="">
                                </div>


                                <input class="btn btn-lg btn-info btn-block" type="submit" value="Entrar" name="login" >

                                <!-- Change this to a button or input when using this as a form -->
                                <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<?php

include("database/db_conection.php");

if(isset($_POST['login']))
{
    $user_email=$_POST['email'];
    $user_pass=$_POST['pass'];

    $check_user="select * from usuarios WHERE correo='$user_email'AND password='$user_pass'";

    $run=mysqli_query($dbcon,$check_user);

    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
    {
        $usuario_id=$row[0];
        $documento=$row[1];
        $nombre=$row[2];
        $apellido=$row[3];
        $correo=$row[4];
        $password=$row[5];
        $rol=$row[6];
    } 

    if(mysqli_num_rows($run))
    {
        if($rol=="Gerente")
        {
            echo "<script>window.open('../Gerente/index.php','_self')</script>";

            $_SESSION['email']=$correo;//here session is used and value of $user_email store in $_SESSION.
            $_SESSION['pass']=$password;
        }
        else{
            echo "<script>window.open('../Cliente/index.php','_self')</script>";

            $_SESSION['email']=$correo;//here session is used and value of $user_email store in $_SESSION.
            $_SESSION['pass']=$password;
        }
    }
    else
    {
        echo "<script>alert('Usuario o Contraseña Incorrectos!')</script>";
    }
}
?>