<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
include('../config/db_conn.php');

     if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
	$description=$_POST['description'];
	$genre_film=$_POST['genre_film'];
	$duration_film=$_POST['duration_film'];
	
		$propic=$_FILES["propic"]["name"];
		$extension = substr($propic,strlen($propic)-4,strlen($propic));
		$allowed_extensions = array(".jpg","jpeg",".png",".gif");
		if(!in_array($extension,$allowed_extensions))
		{
			$_SESSION['errmsg'] = "Изображения имеют недопустимый формат. Разрешен только формат jpg / jpeg / png / gif";
		}
	else
		{

		$propic=md5($propic).time().$extension;
		 move_uploaded_file($_FILES["propic"]["tmp_name"],"images/".$propic);
		$sql="insert into films(name,foto,description,genre_film,duration_film) values(:name,:propic,:description,:genre_film,:duration_film)";
		$query=$dbh->prepare($sql);
		$query->bindParam(':name',$name,PDO::PARAM_STR);
		$query->bindParam(':propic',$propic,PDO::PARAM_STR);
		$query->bindParam(':description',$description,PDO::PARAM_STR);
		$query->bindParam(':genre_film',$genre_film,PDO::PARAM_STR);
		$query->bindParam(':duration_film',$duration_film,PDO::PARAM_STR);
		 $query->execute();
			
		   $LastInsertId=$dbh->lastInsertId();
		   if ($LastInsertId>0) {
			$_SESSION['msg'] = "Данные успешно добавлены!";
			//echo "<script>window.location.href ='add-person.php'</script>";
			}
			else
			{
			 $_SESSION['errmsg'] = "Ошибка. Пожалуйста, попробуйте снова.";
			}
		}
	}
	} else {
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Cистема покупки билетов | управление фильмами-создать</title>
    
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
            <h1>Добавить фильм</h1>
          </div>
        </div>
		<span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
		</span>
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
                <h3 class="card-title">Форма добавления фильма</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
				
				 <div class="form-group">
                    <label for="exampleInputEmail1">Наименование фильма</label>
                    <input type="text" class="form-control" id="name" name="name" required='true'>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Изображение фильма</label>
                    <input type="file" class="form-control" id="propic" name="propic" required="true">
                  </div>
				 <div class="form-group">
                    <label for="exampleInputEmail1">Описание фильма</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Описание фильма" required='true'></textarea>
                  </div>  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Жанр фильма</label>
                    <input type="text" class="form-control" id="genre_film" name="genre_film" required='true'>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Продолжительность фильма</label>
                    <input type="text" class="form-control" id="duration_film" name="duration_film" required='true'>
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