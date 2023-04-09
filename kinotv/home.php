<?php 
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id'])) {   
	   if ($_SESSION['role'] == 1) header("Location: admin/");
	   elseif ($_SESSION['role'] == 2) header("Location: users/");
	  
	   else header("Location: index.php");
}
?>