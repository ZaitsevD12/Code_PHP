<?php  
session_start();
include "config/db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if (empty($username)) {
		header("Location: ../index.php?error=Введите имя пользователя.");
	}else if (empty($password)) {
		header("Location: ../index.php?error=Введите пароль.");
	}else {
        
        $sql = "SELECT users.* FROM users JOIN roles ON users.id_roles=roles.id WHERE login='$username' AND password='$password'";
        $query = $dbh -> prepare($sql);
					$query->execute();
					$row=$query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount() > 0)
					{
        	// the user name must be unique
        	//$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password && $row['id_roles'] == $role) {
        		$_SESSION['id'] = $row['id'];
				//role 1(admin) 2('guardian') 3('educator')
        		$_SESSION['role'] = $row['id_roles'];
				$_SESSION['fio'] = $row['fio'];
        		$_SESSION['login'] = $row['login'];
                
				header("Location: ../home.php");

        	}else {
        		header("Location: ../index.php?error=Неверное имя пользователя или пароль.");
        	}
        }else {
        	header("Location: ../index.php?error=Неверное имя пользователя или пароль.");
        }

	}
	
}else {
	header("Location: ../index.php");
}