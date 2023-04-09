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
			<div id="slogan">
					<div class="image png"></div>
					<div class="inside">
						<h2>Рынок<span>киноиндустрии</span></h2>
						<p>Развитие рынка киноиндустрии непрерывно развивается и постоянно находится в состоянии трансформации. Трансформация происходит в зависимости от потребностей потребителей данной услуги. Постоянно расширяется сфера услуг и уровень обслуживания. </p>
					</div>
				</div>
				<div class="box">
					<div class="border-right">
						<div class="border-left">
							<div class="inner">
								<h3>Посмотреть качественный продукт <b>с идеальным качеством</b> <span>изображения и звука</span></h3>
								<div class="img-box1"><img src="images/1page-img1.jpg" alt="" />Это осуществимо лишь в кинотеатре, так как в домашних условиях чаще всего недостижимы данные критерии (пользовательские колонки не могут передать должное качество звука или качество изображения оставляет желать наилучшего). Поэтому спрос на услуги кинотеатра растет.</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<h3>Фильмы <span>в прокате</span></h3>
					<ul class="movies">
					<!------------------------>
					 <?php
					$sql="SELECT seance_admin.*, films.* FROM seance_admin INNER JOIN users ON seance_admin.id_admin = users.id INNER JOIN films ON seance_admin.id_films = films.id GROUP BY films.name";
					$query = $dbh -> prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					if($query->rowCount() > 0)
					{
					foreach($results as $row)
					{               ?>
						<li>
							<h4><?php  echo htmlentities($row->name);?></h4><img src="admin/images/<?php echo $row->foto;?>"  />
							<p><?php  echo htmlentities($row->description);?></p>
							<p><?php  echo htmlentities($row->genre_film);?></p>
							<p><?php  echo htmlentities($row->duration_film);?></p>
							<div class="wrapper"><a href="more-detailed.php?editid=<?php echo htmlentities ($row->id_films);?>&name=<?php  echo htmlentities($row->name);?>" class="link2"><span><span>Подробнее...</span></span></a></div>
						</li>
						
						
					<?php }} ?>
						<!----------------------------->
						<li class="clear">&nbsp;</li>
					</ul>
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