<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>ROUTR!</title>
</head>

<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>


<nav>
	<div class="nav-wrapper">
		<a href="#" class="brand-logo" style="padding-left: 20px;">ROUTR</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="#">Home</a></li>
			<li><a href="about">About</a></li>
		</ul>
	</div>
</nav>
<?php echo form_open('login/authenticate_user'); ?>
<div class="container">
	<div class="row" >
		<div class="col s8">
			<div class="row">
				<h3 class="bold">Discover your region</h3>
				<p><a class="waves-effect waves-light btn" href="<?php echo site_url('route/index')?>"><i class="material-icons left">search</i>Chercher une route !</a></p>
			</div>
		</div>
		<div class="col s4">
			<form>
				<div class="row">
					<div class="input-field col s12">
						<input name="login" id="login" type="text" class="validate">
						<label for="login">Login</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="password" id="password" type="password" class="validate">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<button class="btn waves-effect waves-light center col s12" type="submit" name="action">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<footer class="page-footer">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">Footer Content</h5>
				<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">Links</h5>
				<ul>
					<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2014 Copyright Text
			<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
		</div>
	</div>
</footer>
</body>
</html>