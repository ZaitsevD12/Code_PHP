<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 2) {
include('../config/db_conn.php');
if($_GET['prt']){
			$pid=$_GET['id'];
			try {
			$sql="SELECT films.name as fname, seance_admin.*, tickets_users.* FROM tickets_users INNER JOIN users ON tickets_users.id_users = users.id INNER JOIN seance_admin ON tickets_users.id_seance = seance_admin.id INNER JOIN films ON seance_admin.id_films = films.id where tickets_users.id_users =".$_SESSION['id']." and tickets_users.id = ".$pid;
				$query = $dbh -> prepare($sql);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				if($query->rowCount() > 0)
				{
					require '../vendor/autoload.php';
					
					//$PHPWord = new \PhpOffice\PhpWord\PhpWord();
					$document = new \PhpOffice\PhpWord\TemplateProcessor('../Template/template.docx');
					
					$document->setValue('fname', $results[0]->fname); //Фильм
					$document->setValue('date_seance', $results[0]->date_seance); //дата сеанса
					$document->setValue('time_seance', $results[0]->time_seance); //время сеанса
					$document->setValue('date_sale', $results[0]->date_sale);// дата и время продажи билета
					$document->setValue('prices', $results[0]->prices);// цена
					$document->setValue('hall_number', $results[0]->hall_number);// номер зала
					$document->setValue('permission', $results[0]->permission);// ряд и место
					$document->saveAs('../Template/Template_full.docx'); //имя заполненного шаблона для сохранения
					$file = '../Template/Template_full.docx';
					header('Content-Type: application/msword');
					header('Content-Disposition: attachment; filename="Template_full.docx"');
					readfile($file);
				}
		  } catch (PDOException $e) {
			die("Ошибка: " . $e->getMessage());
			} finally {
			$_SESSION['msg'] = "Билет отправлен покупателю!";
			//echo'<meta http-equiv="refresh" content="2;mail-guard.php">';
			}
		}
	 
} else {
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Cистема покупки билетов | Просмотр купленных билетов</title>
    
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Купленные билеты</h1>
          </div>
        </div>
		<span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
		</span>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Просмотр и печать билетов</h3>
              </div>
               <!-- /.card-header -->
            <div class="card-body">
				  
			  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color:#1c87c9; color:#fff;">
                  <th>№</th>
                  <th>Наименование фильма</th>
                  <th>Дата сеанса</th>                  
                  <th>Время сеанса</th>
				  <th>Цена билета</th>
				  <th>Дата продажи билета</th>
				  <th>Номер зала</th>
				  <th>Ряд и место</th>
				  <th>Действия</th>                                 
                </tr>
                </thead>
                 <?php
					$sql="SELECT films.name as fname, seance_admin.*, tickets_users.*  FROM tickets_users INNER JOIN users ON tickets_users.id_users = users.id INNER JOIN seance_admin ON tickets_users.id_seance = seance_admin.id INNER JOIN films ON seance_admin.id_films = films.id where tickets_users.id_users = ".$_SESSION['id'];
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
                  <td><?php  echo htmlentities($row->fname);?></td>
                  <td><?php  echo htmlentities($row->date_seance);?></td>
                  <td ><?php  echo htmlentities($row->time_seance);?></td>
				  <td ><?php  echo htmlentities($row->prices);?></td>
				  <td ><?php  echo htmlentities($row->date_sale);?></td>
				  <td ><?php  echo htmlentities($row->hall_number);?></td>
				  <td ><?php  echo htmlentities($row->permission);?></td>
				 <td> 
					 
					 <a href="view-tickets.php?id=<?php echo $row->id;?>&prt=print" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                  </td>
                </tr>
                              
                <?php $cnt=$cnt+1;}} ?> 
              </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
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