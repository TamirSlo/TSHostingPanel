<?php 

if(!@include("api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();
?>

<html>

<head>
	<title>Web Hosting Panel</title>
	<link rel="shortcut icon" type="image/gif" href="/assets/images/icon-lg.gif" />
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/signin.css">
	<script src="assets/js/main.js"></script>
	<script src="assets/js/toasts.js"></script>
</head>

<body>
	<div id="main">
		<script>document.getElementById("main").className += ' fadeout';</script>
		<form class="text-center form-signin" id="LoginForm">
			<img src="assets/images/icon-sm.gif" />
			<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
			<label for="inputUser" class="sr-only">Username</label>
			<input type="text" id="inputUser" name="username" autocomplete="username" class="form-control" placeholder="Username" required />
			<label for="inputPass" class="sr-only">Password</label>
			<input type="password" id="inputPass" name="password" autocomplete="current-password" class="form-control" placeholder="Password" required />
			<button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign in</button>
		</form>
	</div>

	<div aria-live="polite" aria-atomic="true" style="position: relative; min-height:100%;">
		<div id="toasts">
			
		</div>
	</div>
</body>

</html>
