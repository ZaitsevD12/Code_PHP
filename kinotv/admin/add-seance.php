<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
include('../config/db_conn.php');

    if(isset($_POST['submit']))
	{
		$id_films=$_POST['id_films'];
		$date_seance=$_POST['date_seance'];
		$time_seance=$_POST['time_seance'];
		$hall_number=$_POST['hall_number'];
		$prices=$_POST['prices'];
		$id_admin = $_SESSION['id'];
		try {
		$sql="insert into seance_admin(id_admin,id_films,date_seance,time_seance,hall_number,prices) values(:id_admin,:id_films,:date_seance,:time_seance,:hall_number,:prices)";
		$query=$dbh->prepare($sql);
		$query->bindParam(':id_admin',$id_admin,PDO::PARAM_INT);
		$query->bindParam(':id_films',$id_films,PDO::PARAM_INT);
		$query->bindParam(':date_seance',$date_seance,PDO::PARAM_STR);
		$query->bindParam(':time_seance',$time_seance,PDO::PARAM_STR);
		$query->bindParam(':hall_number',$hall_number,PDO::PARAM_STR);
		$query->bindParam(':prices',$prices,PDO::PARAM_STR);
		$query->execute();
			
		  } catch (PDOException $e) {
			die("Ошибка: " . $e->getMessage());
			} finally {
			$_SESSION['msg'] = "Данные успешно добавлены!";
			}
		}
	} else {
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Система управления детсадом | Добавить сеанс</title>
    
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include_once('includes/header.php');?>
  <?php include_once('includes/sidebar.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Добавить сеанс</h1>
          </div>
        </div>
		<span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
		</span>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Форма добавления</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
				 
				 <div class="form-group">
                    <label for="exampleInputEmail1">Наименование фильма</label>
                    <select type="text" name="id_films" id="id_films" value="" class="form-control" required="true">
						<option value="">Выберите фильм</option>
						<?php 
						$sql2 = "SELECT * from films";
						$query2 = $dbh -> prepare($sql2);
						$query2->execute();
						$result2=$query2->fetchAll(PDO::FETCH_OBJ);

						foreach($result2 as $row1)
						{ ?>  
						<option value="<?php echo htmlentities($row1->id);?>"><?php echo htmlentities($row1->name);?></option>
						 <?php } ?> 
                    </select>
                  </div>
										 
				 <div class="form-group">
                    <label for="exampleInputEmail1">Дата сеанса</label>
                    <input type="date" class="form-control" id="date_seance" name="date_seance" value="" required="true">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Время сеанса</label>
                    <input type="time" class="form-control" id="time_seance" name="time_seance" value="" required="true">
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Номер зала</label>
                    <input type="text" class="form-control" id="hall_number" name="hall_number" value="" required="true">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Цена просмотра</label>
                    <input type="text" class="form-control" id="prices" name="prices" value="" required="true">
                  </div>
				  				  			                                  
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Добавить</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

</body>
</html>