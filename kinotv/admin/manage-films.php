<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 1) {
include('../config/db_conn.php');
	//Code for Deletion
	if($_GET['del']){
			$pid=$_GET['id'];
		$sql="delete from films where id ='$pid'";
		$query = $dbh -> prepare($sql);
		$query->execute();
			$_SESSION['msg'] = "Данные успешно удалены!";		
	}
 }else{
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
 
  <title>Cистема покупки билетов | управление фильмами</title>
   <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
  <div class="content-wrapper" style="background-color:#FFCF79">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" >
          <div class="col-sm-12" >
            <h1>Управление фильмами</h1>
          </div>
        </div>
		<span style="color:red;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
        
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="color: green" >Добро пожаловать! Администратор: <?php echo htmlentities($_SESSION['fio']);?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color:#1c87c9; color:#fff;">
                  <th>№</th>
                  <th>Наименование фильма</th>
                  <th>Описание фильма</th>
                  <th>Жанр фильма</th>                  
                  <th>Длительность фильма</th>
				  <th>Действия</th>
                
                </tr>
                </thead>
                 <?php
					$sql="SELECT * FROM films";
					$query = $dbh -> prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);

					$cnt=1;
					if($query->rowCount() > 0)
					{
					foreach($results as $row)
					{               ?>
                
                <tr style="background-color:lightgrey;">
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->name);?></td>
                  <td><?php  echo htmlentities($row->description);?></td>
                  <td><?php  echo htmlentities($row->genre_film);?></td>
                  <td><?php  echo htmlentities($row->duration_film);?></td>
				  
				  <td> 
				     <a href="view-films-detail.php?editid=<?php echo htmlentities ($row->id);?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
					 <a href="edit-films-detail.php?editid=<?php echo htmlentities ($row->id);?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
					 <a href="manage-films.php?id=<?php echo $row->id;?>&del=delete" onClick="return confirm('Вы уверены, что хотите удалить?')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                  
                </tr>
                              
                <?php $cnt=$cnt+1;}} ?> 
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    //$("#example1").DataTable();
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
	  "scrollX": true,
	  "language": { "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json" },
    });
  });
</script>
</body>
</html>