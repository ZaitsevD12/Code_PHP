<?php 
   session_start();
   if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Сайт кинотеатра с системой покупки билетов</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
	  <div class="p-5">
      	<form class="border shadow p-3 rounded"
      	      action="check-login.php" 
      	      method="post" 
      	      style="width: 450px;">
      	      <h1 class="text-center p-3">Вход в систему</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
		  <div class="mb-3">
		    <label for="username" 
		           class="form-label">Имя пользователя:</label>
		    <input type="text" 
		           class="form-control" 
		           name="username" 
		           id="username" required="true">
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Пароль:</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password" required="true">
		  </div>
		  <div class="mb-1">
		    <label class="form-label">Выберите роль в системе:</label>
		  </div>
		  <select class="form-select mb-3"
		          name="role" 
		          aria-label="Default select example">
			  <option selected value='2'>Пользователь</option>
			  <option value="1">Администратор</option>
		  </select>
		 
		  <button type="submit" 
		          class="btn btn-primary">Войти</button>
		</form>
		<hr>
                            <div class="text-center">
                                <h4><a class="small" href="signup.php">Регистрация</a><h4>
                            </div>
                            <div class="text-center">
                                <h4><a class="small" href="index.php">На главную</a></h4>
                            </div>  
       <hr>							
      </div>
	  </div>
</body>
</html>
<?php }else{
	header("Location: home.php");
} ?>