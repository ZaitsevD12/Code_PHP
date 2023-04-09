<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['role'] == 2) {
include('../config/db_conn.php');

    if(isset($_POST['submit']))
	{
		$seanceId = $_POST['seanceId'];
		if(isset($_POST['permission']) && $seanceId !="")
			{
				$date = date('Y-m-d H:i:s');
				$id_users = $_SESSION['id'];
				foreach($_POST['permission'] as $value){
					$query_ = $dbh->prepare("INSERT INTO `tickets_users` (`id_users`,`id_seance`,`date_sale`,`permission`) VALUES (?,?,?,?)");
					$query_->execute([$id_users,$seanceId,$date,$value]);
					
				}
				$_SESSION['msg'] = "Данные успешно добавлены!";
				header("Location: view-tickets.php");
			}
			else {$_SESSION['msg'] = "Выберите ряд и место или вернитесь для выбора сеанса.";}
		
	}
  } else {
	header("Location: ../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Система управления детсадом | Купить билет</title>
    
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
            <h1>Купить билет - выбор ряда и места</h1>
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
				  
		             <label for="permission"><b>Ряд и место</b></label>
					  <table class="table table-bordered table-striped">
						<thead>
						<tr style="background-color:#1c87c9; color:#fff; text-align:center;">
						  <th colspan="5" >Экран</th>
						</tr>
						</thead>
						 <?php
						$pid=$_GET['pid']; 
						$sql="SELECT permission FROM tickets_users WHERE id_seance=".$pid;
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchALL(PDO::FETCH_ASSOC);
						if(count($results) > 0)
						{
							
							$i = 0;
							foreach($results as $row) {
							   $resultslist[$i] = $row['permission'];
							   $i++;
							}
							//-------------------------------------	
								 
							$rows = 5; // количество строк, tr
							$cols = 5; // количество столбцов, td
						
							for ($tr=1; $tr<=$rows; $tr++){ 
								echo '<tr style="background-color:lightgrey; text-align:center;">';
								for ($td=1; $td<=$cols; $td++){ 
								 $checked = "";
									  if(in_array("Ряд ".$tr." Место ".$td,$resultslist)){
										$checked = "checked"." disabled";
									  }
								echo '<td>'. '<input type="checkbox" name="permission[]" class="minimal" value="Ряд '.$tr.' Место '.$td.'"'.$checked.' ><br> Ряд '.$tr.' Место '.$td.'</td>';
								}
								echo '</tr>';
							}
							
						} else { ?>
						<!-----1-------->
						<tr style="background-color:lightgrey; text-align:center;">
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 1 Место 1" autocomplete="off" class="minimal"><br> Ряд 1 Место 1</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 1 Место 2" autocomplete="off" class="minimal"><br> Ряд 1 Место 2</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 1 Место 3" autocomplete="off" class="minimal"><br> Ряд 1 Место 3</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 1 Место 4" autocomplete="off" class="minimal"><br> Ряд 1 Место 4</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 1 Место 5" autocomplete="off" class="minimal"><br> Ряд 1 Место 5</td>
						
						</tr>
						<!-----2-------->
						<tr style="background-color:lightgrey; text-align:center;">
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 2 Место 1" autocomplete="off" class="minimal"><br> Ряд 2 Место 1</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 2 Место 2" autocomplete="off" class="minimal"><br> Ряд 2 Место 2</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 2 Место 3" autocomplete="off" class="minimal"><br> Ряд 2 Место 3</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 2 Место 4" autocomplete="off" class="minimal"><br> Ряд 2 Место 4</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 2 Место 5" autocomplete="off" class="minimal"><br> Ряд 2 Место 5</td>
						</tr>
						
						<!-----3-------->
						<tr style="background-color:lightgrey; text-align:center;">
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 3 Место 1" autocomplete="off" class="minimal"><br> Ряд 3 Место 1</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 3 Место 2" autocomplete="off" class="minimal"><br> Ряд 3 Место 2</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 3 Место 3" autocomplete="off" class="minimal"><br> Ряд 3 Место 3</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 3 Место 4" autocomplete="off" class="minimal"><br> Ряд 3 Место 4</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 3 Место 5" autocomplete="off" class="minimal"><br> Ряд 3 Место 5</td>
						</tr>
						
						<!-----4-------->
						<tr style="background-color:lightgrey; text-align:center;">
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 4 Место 1" autocomplete="off" class="minimal"><br> Ряд 4 Место 1</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 4 Место 2" autocomplete="off" class="minimal"><br> Ряд 4 Место 2</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 4 Место 3" autocomplete="off" class="minimal"><br> Ряд 4 Место 3</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 4 Место 4" autocomplete="off" class="minimal"><br> Ряд 4 Место 4</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 4 Место 5" autocomplete="off" class="minimal"><br> Ряд 4 Место 5</td>
						</tr>
						
						<!-----5-------->
						<tr style="background-color:lightgrey; text-align:center;">
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 5 Место 1" autocomplete="off" class="minimal"><br> Ряд 5 Место 1</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 5 Место 2" autocomplete="off" class="minimal"><br> Ряд 5 Место 2</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 5 Место 3" autocomplete="off" class="minimal"><br> Ряд 5 Место 3</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 5 Место 4" autocomplete="off" class="minimal"><br> Ряд 5 Место 4</td>
						<td>
						<input type="checkbox" name="permission[]" id="permission" value="Ряд 5 Место 5" autocomplete="off" class="minimal"><br> Ряд 5 Место 5</td>
						</tr>
						<?php } ?>
				   </table>
				   	</div>
					<div class="form-group">
                    <label for="exampleInputEmail1">Карта оплаты</label>
                    <input type="text" class="form-control" id="carts" name="carts" value="" required="true">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="" required="true">
                  </div>
				  <input type="hidden" id="seanceId" name="seanceId" value="<?php echo $pid; ?>">
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Оплатить</button>
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
<script>
$("input.minimal").on('click',function(e) {
    var dogsSelected = $("input.minimal:checked");
    var numSelected = dogsSelected.length;
    //alert("numSelected: " + numSelected);
	if (numSelected == 5) $("input.minimal").attr("disabled", true);
});			   
</script>
</body>
</html>