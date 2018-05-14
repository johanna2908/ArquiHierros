<?php
session_start();

if(!$_SESSION['email'])
{

    header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

?>

<html>
<head>

    <title>
        Registration
    </title>
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
</head>

<body>
	<div class="container">
    	<div class="row">
        	<div class="col-md-4 col-md-offset-4">
				<h1>Welcome</h1><br>
				<?php
					echo $_SESSION['email'];
				?>


				<h1><a href="logout.php">Logout here</a> </h1>

			</div>
		</div>
	</div>

</body>

</html>

