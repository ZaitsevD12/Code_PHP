<?php  
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 2) {
    
   echo "<script>window.location.href='view-tickets.php'</script>";
   echo '<a href="../logout.php" class="btn btn-dark">Выйти</a>';
}else{
	header("Location: ../index.php");
}
?>