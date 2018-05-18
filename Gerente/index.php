<?php 
session_start();
include('header.php');

if(!$_SESSION['email'])
{

    header("Location: ../login/login.php");//redirect to login page to secure the welcome page without login access.
}
?>

<title> Gerencia- Modelo Balance Score Card Para La Empresa ArquiHierros S.A.S</title>

<?php include('container.php');?>

<div id="page-wrapper" style="text-align: center; vertical-align: middle;">
            
   <img height="90%" width="90%" src="../img/hierros.jpg" />

<div id="page-wrapper">
	
</div>

<?php include('footer.php');?> 












