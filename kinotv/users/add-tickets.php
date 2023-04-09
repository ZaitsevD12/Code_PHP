<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 2) {
include('../config/db_conn.php');

    if(isset($_POST['submit']))
	{
		$id_seance=$_POST['id_seance'];
		header("Location: permission.php?pid=".$id_seance);
	}
  }	else {
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  

    
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
            <h1>Купить билет</h1>
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
                <h3 class="card-title">Форма покупки</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
				 
				 <div class="form-group">
                    <label for="exampleInputEmail1">Сеанс фильма</label>
                    <select type="text" name="id_seance" id="id_seance" value="" class="form-control" required="true">
						<option value="">Выберите время</option>
						<?php 
						$sql2 = "SELECT seance_admin.*, films.name as name FROM seance_admin INNER JOIN users ON seance_admin.id_admin = users.id INNER JOIN films ON seance_admin.id_films = films.id";
						$query2 = $dbh -> prepare($sql2);
						$query2->execute();
						$result2=$query2->fetchAll(PDO::FETCH_OBJ);

						foreach($result2 as $row1)
						{ ?>  
						<option value="<?php echo htmlentities($row1->id);?>"><?php echo htmlentities($row1->name)." - ".htmlentities($row1->date_seance)." - ".htmlentities($row1->time_seance);?></option>
						 <?php } ?> 
                    </select>
                  </div>
							 
				  
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Дальше >></button>
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