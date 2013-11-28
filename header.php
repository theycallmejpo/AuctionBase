<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $pageTitle ?></title>

	<!-- Bootstrap core CSS -->
	<link href="./assets/css/bootstrap.css" rel="stylesheet" />
	<link href="./assets/css/jumbotron-narrow.css" rel="stylesheet">

</head>

<body>
	<div class="container">
		<div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="./home.php">Home <span class="glyphicon glyphicon-home"></span></a></li>
          <li><a href="./searchauctions.php">Search <span class="glyphicon glyphicon-search"></span></a></li>
          <li><a href="./signup.php">Sign Up <span class="glyphicon glyphicon-user"></span></a></li>
        </ul>
        <h3 class="text-muted">AuctionBase</h3>
   	</div>

   	<?php include ("./currtime.php") ?>