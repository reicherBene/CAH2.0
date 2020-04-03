<html style="overflow: hidden">
	<head>
		<title>Lysin | Login</title>
		<?php include_once 'inc/head.inc.php';?>
	</head>
	<body>
		<?php include_once 'inc/header-empty.inc.php';?>
		<div class="page-container">	
			<div class="content-wrap">
				<div class="login-container">
					<form>
						<p style="font-weight: bold; font-size: 24px">Login</p>
						<input type="text" name="name" class="input" placeholder="Benutzername" required>
						<br><br>
						<input type="password" name="pwd" class="input" placeholder="Passwort" required>
						<br><br>
						<button type="submit" name="submit" class="btn">Einloggen</button>
					</form>
					<button class="btn btn-register">Registrieren</button>
				</div>
			</div>
			<?php include_once 'inc/footer.inc.php';?>
		</div>	
	</body>
</html>
