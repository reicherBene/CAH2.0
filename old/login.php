<!DOCTYPE html>
<html id="html">
	<head>
		<title>Cards against humanity | Login</title>
		
		<?php include 'inc/login_head.inc.php'; ?>
		
		<link href="css/lysin-default-cah.css" rel="stylesheet">
		<link rel="stylesheet" href="css/login.css">
		<?php include 'addTypeCSS.php'; ?>
		
		<script defer type="text/javascript">
                function btn(id) {
                    if(id=="1") {
                        $("#1").addClass("loginbtnactive");
                        $("#0").removeClass("loginbtnactive");
                        $(".logindivlogin").css("display","none");
                        $(".logindivregister").css("display","block");
                    } else if(id=="0") {
                    	$("#0").addClass("loginbtnactive");
                        $("#1").removeClass("loginbtnactive"); 
                        $(".logindivlogin").css("display","block");
                        $(".logindivregister").css("display","none");
                    }
                }
				<?php
					$loginType = $_GET['loginType'];
					if($loginType == "")$loginType = $_POST['loginType'];
					if($loginType == "")$loginType = "login";
					
					if($loginType == "reg") echo "btn(1); \n";
					else{ echo "btn(0); \n";}
				?>
        </script>
	</head>
	<body>
		
		<div class="pagecontent">		    
		
			<div class="loginholder">
				
				<button id="0" class="loginbtnlogin loginbtnactive" onClick="btn(this.id);">Login</button>
				<button id="1" class="loginbtnregister" onClick="btn(this.id);">Registrieren</button>
				
				<div class="logindivlogin">
					<form action="inc/login.inc.php" method="POST">
						<p>Benutzername</p>
						<input type="text" class="formtexts" name="username" required>
						<br><br>
						<p>Passwort</p>
						<input type="password" class="formtexts" name="password" required>
						<br><br>
						<button type="submit" class="loginbtnsubmit" name="btnlogsubmit">Login</button>
					</form>
				</div>
				
				<div class="logindivregister">
					<form action="inc/register.inc.php" method="POST">
						<p>Benutzername*</p>
						<input type="text" class="formtexts" name="username" required>
						<br><br>
						<p>Passwort*</p>
						<input type="password" class="formtexts" name="password" required>
						<br><br>
						<p>Passwort bestätigen*</p>
						<input type="password" class="formtexts" name="passwordcheck" required>
						<br><br>
						<p>Aktivierungscode*</p>
						<input type="text" class="formtexts" name="code" placeholder="CAH-X-XXXX-XXXX-XXXX" required>
						<br><br>
						<p class="s">* Pflichtangaben</p>
						<p class="s"><input type="checkbox" required> Ich habe die <a href="https://lysin-games.com/agb.php">Nutzungsbedingungen</a> und die <a href="https://lysin-games.com/datenschutz.php">Datenschutzrichtlinien</a> gelesen und stimme ihnen zu.</p>
						<br>
						<button type="submit" class="loginbtnsubmitr" name="btnregsubmit">Registrieren</button>
					</form>
				</div>
			</div>
		</div>		
	</body>
</html>
