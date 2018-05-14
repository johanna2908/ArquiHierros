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
	
</div>

<?php include('footer.php');?> 












