<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
include('../config/db_conn.php');
 if(isset($_POST['submit']))
  {
	$eid=$_GET['editid'];
	$propic=$_FILES["newpic"]["name"];
	$extension = substr($propic,strlen($propic)-4,strlen($propic));
	$allowed_extensions = array(".jpg","jpeg",".png",".gif");
	if(!in_array($extension,$allowed_extensions))
	{
		$_SESSION['errmsg'] = "Изображения имеют недопустимый формат. Разрешен только формат jpg / jpeg / png / gif";
	}
	else
	{
		$propic=md5($propic).time().$extension;
		move_uploaded_file($_FILES["newpic"]["tmp_name"],"images/".$propic);
		$sql="update films set foto=:pic where id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pic',$propic,PDO::PARAM_STR);
		$query->bindParam(':eid',$eid,PDO::PARAM_STR);
		$query->execute();
		$_SESSION['msg'] = "Изображение успешно обновлено!";
    }
  }
  }else{
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Cистема покупки билетов | Обновление изображения</title>
    
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
            <h1>Обновление изображения фильма</h1>
          </div>
        </div>
		 <span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
		 <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
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
                <h3 class="card-title">Обновить изображение</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <?php
                   $eid=$_GET['editid'];
					$sql="SELECT * from films where id=$eid";
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
                    <label for="exampleInputEmail1">Текущее изображение</label>
                    <img src="images/<?php echo $row->foto;?>" width="200" height="200" value="<?php  echo $row->foto;?>">
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Новое изображение</label>
                    <input type="file" name="newpic" value="" class="form-control" id="newpic" required='true'>
                  </div> 
                 
                </div>
              <?php $cnt=$cnt+1;}} ?> 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Редактировать</button>
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
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>