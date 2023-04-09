<?php  
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
    
    echo "<script>window.location.href='manage-films.php'</script>";
	echo '<a href="../logout.php" class="btn btn-dark">Выйти</a>';
}else{
	header("Location: ../index.php");
} 
?>