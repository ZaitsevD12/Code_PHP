<?php
include('config/db_conn.php');
?>
<html lang="ru">
<head>
<title>Кинотеатр</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<!--<script src="js/Gill_Sans_400.font.js" type="text/javascript"></script>-->
<script src="js/script.js" type="text/javascript"></script>
<!--[if lt IE 7]>
	<script type="text/javascript" src="js/ie_png.js"></script>
	<script type="text/javascript">
		 ie_png.fix('.png, .link1 span, .link1');
	</script>
	<link href="ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body id="page1">
<div class="tail-top">
	<div class="tail-bottom">
		<div id="main">
<!-- HEADER -->
			<div id="header">
				<div class="row-1">
					<div class="fleft"><a href="index.html">Кинотеатр <span>"Кинотавр"</span></a></div>
					<ul>
						<li><a href="index.php"><img src="images/icon1-act.gif" alt="" /></a></li>
						<li><a href="about-us.html"><img src="images/icon2.gif" alt="" /></a></li>
						<li><a href="login.php"><img src="images/icon3.gif" alt="" /></a></li>
					</ul>
				</div>
				<div class="row-2">
					<ul>
						<li><a href="index.php" class="active">Главная</a></li>
						<li><a href="about-us.html">О нас</a></li>
						<li><a href="login.php">Личный кабинет</a></li>
						
					</ul>
				</div>
			</div>
<!-- CONTENT -->
<div id="content">
				<div class="line-hor"></div>
				<div class="box">
					<div class="border-right">
						<div class="border-left">
							<div class="inner">
							 <?php
								$eid=$_GET['editid'];
								$name=$_GET['name'];
								$sql="SELECT * FROM seance_admin where id_films=$eid";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);

								$cnt=1;
								if($query->rowCount() > 0)
								{
									?><h3><span><?php echo $name;?></span></h3>
									<div class="img-box1 alt"><img src="images/4page-img.jpg" alt="" /><h4><span>Дата: <?php  echo htmlentities($results[0]->date_seance);?></span></h4>
									 <table border='1' cellspacing="10" cellpadding="10" >
									 <thead>
										<tr style="background-color:#1c87c9; color:#fff;">
										  <th> Время </th>
										  <th> Цена(руб.) </th>
										</tr>
									 </thead>
									<?php
									
								foreach($results as $row)
								{               ?>
								<tr style="background-color:black;">								
								<td class="p1"><?php  echo htmlentities($row->time_seance);?> </td>
								<td class="p1"><?php  echo htmlentities($row->prices);?></td>
								</tr>
								<?php }} ?><td colspan="2"><a href="login.php" class="link2"><span><span align = "center">Купить</span></span></a></td></table></div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- FOOTER -->
<div id="footer">
				<div class="left">
					<div class="right">
						<div class="inside"> <b>Контакты:</b> +7 (84457) 4-62-21 - Касса<br />
								+7 (84457) 4-62-24 - Директор<br />
								d_drujba@bk.ru
								<br />
							<b>Адрес: Волгоградская область, г. Камышин
										ул. Пролетарская, 24
										МАУК ЦКД «Кинотавр»</b><br />
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>