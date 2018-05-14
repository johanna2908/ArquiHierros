<?php
    $user_email=$_SESSION['email'];
    $user_pass=$_SESSION['pass'];

    include("../login/database/db_conection.php");
    $view_users_query="select * from usuarios WHERE correo='$user_email'AND password='$user_pass'";//select query for viewing users.
    $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

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
?>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Gerencia ArquiHierros</a>
                <li class="divider-vertical"></li>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li><a href="index.php"><i class="glyphicon glyphicon-equalizer"></i> Inicio</a></li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i> Empleados
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="registrar_empleado.php"><i class="glyphicon glyphicon-triangle-right"></i> Registrar</a></li>
                            <li><a href="listar_empleados.php"><i class="glyphicon glyphicon-triangle-right"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-check"></i> Indicadores
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="registrar_indicador.php"><i class="glyphicon glyphicon-triangle-right"></i> Registrar</a></li>
                            <li><a href="listar_indicador.php"><i class="glyphicon glyphicon-triangle-right"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="glyphicon glyphicon-save"></i> Reportes</a></li>
                    <li><a href="calificar_empleado.php"><i class="glyphicon glyphicon-ok"></i> Calificar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="divider-vertical"></li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"> </i> 
                            <?php echo $nombre; echo " "; echo $apellido; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Cambio Contraseña</a></li>
                            <li class="divider"></li>
                            <li><a href="../login/logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>

                        </ul>
                    </li>
                    <li class="divider-vertical"></li>
                </ul>
            </div>
        </nav>
        
        <div id="page-wrapper">