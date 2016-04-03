
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<title><?php echo $name?></title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('css/bootstrap.min.css')?>"
	rel="stylesheet">

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link
	href="<?php echo base_url('css/ie10-viewport-bug-workaround.css')?>"
	rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?php echo base_url('css/dashboard.css')?>" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?php echo base_url('js/ie-emulation-modes-warning.js')?>"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Web Scrapper Robot Crawler fire
					fire punch The tournament edition gold II</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Settings</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Help</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
				</form>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li <?php if($page == 'main/main') echo 'class="active"'?>><a
						href="<?php echo base_url('main')?>">Main</a></li>
					<li <?php if($page == 'sites/main') echo 'class="active"'?>><a
						href="<?php echo base_url('sites')?>">Site Profile</a></li>
					<li <?php if($page == 'search/main') echo 'class="active"'?>><a
						href="<?php echo base_url('search')?>">Search</a></li>
					<li <?php if($page == 'search/main') echo 'class="active"'?>><a
						href="<?php echo base_url('search')?>">Order 66 (Crawl all)</a></li>


				</ul>

			</div>

		</div>
      <?php $this->load->view($page);?>
    </div>

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url('js/jquery.min.js')?>"><\/script>')</script>
	<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
	<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
	<script src="<?php echo base_url('js/holder.min.js')?>"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script
		src=".<?php echo base_url('js/ie10-viewport-bug-workaround.js')?>"></script>
</body>
</html>
