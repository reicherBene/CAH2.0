!DOCTYPE html>
<html>
	<head>
		<title>Lysin | Login</title>
		<?php include_once 'inc/head.inc.php';?>
	</head>
	<body>
		
		<?php //include_once 'inc/header.inc.php';?>
		
		<div class="pagecontent">
		
		    
		
			<div class="loginholder">
				
				<button id="0" class="loginbtnlogin loginbtnactive" onClick="btn(this.id)">Login</button>
				<button id="1" class="loginbtnregister" onClick="btn(this.id)">Registrieren</button>
				
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
						<p>Vor- und Nachname*</p>
						<input type="text" class="formtexts" name="name" required>
						<br><br>
						<p>Benutzername*</p>
						<input type="text" class="formtexts" name="username" required>
						<br><br>
						<p>Passwort*</p>
						<input type="password" class="formtexts" name="password" required>
						<br><br>
						<p>Passwort bestätigen*</p>
						<input type="password" class="formtexts" name="passwordcheck" required>
						<br><br>
						<p>E-Mail Adresse</p>
						<input type="email" class="formtexts" name="email">
						<br><br>
						<p>Aktivierungscode*</p>
						<input type="text" class="formtexts" name="code" placeholder="LYS-X-XXXX-XXXX-XXXX" required>
						<br><br>
						<p class="s">* Pflichtangaben</p>
						<p class="s"><input type="checkbox" name="nameok"> Ich bin damit einverstanden, dass mein Name in der Liste der Mitwirkenden veröffentlicht wird (spätere Änderung möglich).</p>
						<p class="s"><input type="checkbox" required> Ich habe die <a href="agb.php">Nutzungsbedingungen</a> und die <a href="datenschutz.php">Datehschutzrichtlinien</a> gelesen und stimme ihnen zu.</p>
						<br>
						<button type="submit" class="loginbtnsubmitr" name="btnregsubmit">Registrieren</button>
					</form>
				</div>
				
				<script type="text/javascript">
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
                </script>
				
			</div>
			
			<?php include_once 'inc/footer.inc.php';?>
		
		</div>		
	</body>
</html>

