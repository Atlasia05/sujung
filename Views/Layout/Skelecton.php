<?php
	use Art\Core\Link;

	$phpstyle = "";
	if($_SERVER['PHP_SELF'] != "/index.php") {
		$phpstyle = explode("/", $_SERVER['PHP_SELF'])[2];
	}

	
?>
<?php if($phpstyle == "check") : ?>
	<?php require_once (__VIEW . "/{$page}.php"); ?>
<?php else : ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<script src="https://kit.fontawesome.com/2fd94a74da.js" crossorigin="anonymous"></script>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel='icon' type='images/png' href='images/logo.png'>
		<script src="https://code.jquery.com/jquery-latest.min.js"></script>
		<link rel="stylesheet" href="css/font.css">
		<link rel="stylesheet" href="css/style.css">
		<?= Link::CSS($phpstyle); ?>
		<title>수정마켓</title>
	</head>

	<body>
		<?php require_once (__VIEW . "/Layout/header.php"); ?>
		<div class="row">
			<div class="row-9">
				<?php require_once (__VIEW . "/{$page}.php"); ?>
			</div>
			<div class="row-3">
				<?php require_once (__VIEW . "/Layout/right.php"); ?>
			</div>
		</div>
		<footer>
			<p>Copyright 2023. (project-sujung-market) All pictures cannot be copied without permission.</p>
		</footer>
		<?= Link::JS($phpstyle); ?>
	</body>
	</html>
<?php endif; ?>