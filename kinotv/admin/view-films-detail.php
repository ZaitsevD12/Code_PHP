<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
include('../config/db_conn.php');
}else{
	header("Location: ../index.php");
} 
  ?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Cистема покупки билетов | управление фильмами-просмотр</title>
    
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
            <h1>Управление фильмами-просмотр</h1>
          </div>
        </div>
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
                <h3 class="card-title">Форма просмотра фильма</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <?php
				$eid=$_GET['editid'];
				$sql="SELECT * FROM films where id=$eid";
				$query = $dbh -> prepare($sql);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);

				$cnt=1;
				if($query->rowCount() > 0)
				{
				foreach($results as $row)
				{               ?>
                <div class="card-body">
                  
				   <div class="form-group">
                    <label for="exampleInputEmail1">Наименование фильма</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlentities($row->name);?>" readonly='true'>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Изображение фильма</label>
                    <img src="images/<?php echo $row->foto;?>" width="200" height="200" value="<?php  echo $row->foto;?>">
                  </div>
				  				                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Описание фильма</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Описание фильма" readonly='true'><?php echo htmlentities($row->description);?></textarea>
                  </div>  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Жанр фильма</label>
                    <input type="text" class="form-control" id="genre_film" name="genre_film" value="<?php echo htmlentities($row->genre_film);?>" readonly='true'>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Продолжительность фильма</label>
                    <input type="text" class="form-control" id="duration_film" name="duration_film" value="<?php echo htmlentities($row->duration_film);?>" readonly='true'>
                  </div>
				 
                </div>
              <?php $cnt=$cnt+1;}} ?> 
               
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
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>