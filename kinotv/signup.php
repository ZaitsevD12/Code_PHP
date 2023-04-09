<?php
include('config/db_conn.php');

    if(isset($_POST['submit']))
	{
		$fio=$_POST['fio'];
		$email=$_POST['email'];
		$login=$_POST['login'];
		$password=$_POST['password'];
		$id_roles=$_POST['id_roles'];
		
		try {
			//checking email if already exists
	   $sql_="SELECT count(*) FROM users WHERE email='".$email."' OR login='".$login."'";
	   
		$query_=$dbh->prepare($sql_);
		$results=$query_->fetchAll(PDO::FETCH_OBJ);
		if(count($results) > 0)
					{
			echo "<script>alert('Электронная почта или логин уже связаны с другой учетной записью.');</script>";
			}  else{
        		$sql="insert into users(id_roles,fio,email,login,password) values(:id_roles,:fio,:email,:login,:password)";
				$query=$dbh->prepare($sql);
				$query->bindParam(':id_roles',$id_roles,PDO::PARAM_INT);
				$query->bindParam(':fio',$fio,PDO::PARAM_STR);
				$query->bindParam(':email',$email,PDO::PARAM_STR);
				$query->bindParam(':login',$login,PDO::PARAM_STR);
				$query->bindParam(':password',$password,PDO::PARAM_STR);
				$query->execute();
				$_SESSION['msg'] = "Данные успешно добавлены!";
		}} catch (PDOException $e) {
			die("Ошибка: " . $e->getMessage());
			} 	
	} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Сайт кинотеатра с системой покупки билетов | Регистрация в системе</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	 <script type="text/javascript">
	function checkpass()
	{
	if(document.signup.password.value!=document.signup.repeatpass.value)
	{
	alert('Поля "Пароль" и "Повторить пароль" не совпадают.');
	document.signup.repeatpass.focus();
	return false;
	}
	return true;
	}   

	</script>
</head>
<body >

    

   <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
	  <div class="p-5">
             <span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
              <!-- form start -->
              <form class="border shadow p-3 rounded" name="signup" role="form" method="post" enctype="multipart/form-data" onsubmit="return checkpass();">
                
				<h1 class="text-center p-3">Форма регистрации</h1>
				 <div class="mb-3">
                    <label for="exampleInputEmail1">ФИО</label>
                    <input type="text" class="form-control" id="fio" name="fio" value="" required="true">
                  </div>
				  <div class="mb-3">
                    <label for="exampleInputEmail1">Электронная почта</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="abc@mail.ru" value="" required="true">
                  </div>
				  <div class="mb-3">
                    <label for="exampleInputEmail1">Логин</label>
                    <input type="text" class="form-control" id="login" name="login" value="" required="true">
                  </div>
				  <div class="mb-3">
                    <label for="exampleInputEmail1">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" value="" required="true">
                  </div>
				  <div class="mb-3">
				  <label for="exampleInputEmail1">Повторите пароль</label>
                                        <input type="password" class="form-control form-control-user" id="repeatpass"  name="repeatpass" required="true">
                                    </div>				  
				  <div class="mb-3">
                    <label for="exampleInputEmail1">Роль в системе</label>
                    <select type="text" name="id_roles" id="id_roles" value="" class="form-select mb-3" required="true">
						<option value="">Выберите роль в системе</option>
						<?php 
						$sql2 = "SELECT * from roles ";
						$query2 = $dbh -> prepare($sql2);
						$query2->execute();
						$result2=$query2->fetchAll(PDO::FETCH_OBJ);

						foreach($result2 as $row1)
						{ ?>  
						<option value="<?php echo htmlentities($row1->id);?>"><?php echo htmlentities($row1->role);?></option>
						 <?php } ?> 
                    </select>
                  </div>
                   
                  <button type="submit" class="btn btn-primary" name="submit">Регистрация</button>
              
			  </form>
    		  <hr>
                            <div class="text-center">
                                <h4><a class="small" href="login.php">Авторизация</a><h4>
                            </div>
                            <div class="text-center">
                                <h4><a class="small" href="index.php">На главную</a></h4>
                            </div>       
			  
          
              <hr>
          </div>
      
        </div>
   
</body>
</html>