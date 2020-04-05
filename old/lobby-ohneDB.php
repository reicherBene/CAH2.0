<!DOCTYPE html>
<html class="light" id="html">
	<head>
		<meta name="author" title ="infCourse, Benedikt Reichert">
		<title>Cards against humanity | Lobby</title>
		
		<?php include 'default_head.php';
			$userType = $_GET['userType']; //temp
			if(empty($userType)) $userType = "host";
			$_SESSION['userType'] = $userType;
		?>
		
		<link rel="stylesheet" href="css/lobby.css">
		<?php include 'addTypeCSS.php'; ?>
		
		<script defer type='text/javascript'>
			<?php
				$userName = $_POST['userName'];
				if(empty($userName)) $userName = $_SESSION['userName'];
			
				//Hannes sein cod
				$php_array = array('array1', 'array2', 'array3');
				$js_array = json_encode($php_array);
				echo "var newPlayerNames = ".$js_array."\n";
			?>
		</script>
		<script defer src="js/lobby.js"></script>
		<script defer type="text/javascript">
			console.log("SESSION_userName"+<?php echo '"'.$_SESSION['userName'].'"'; ?>+ 'wait');
			console.log("SESSION_userType"+<?php echo '"'.$_SESSION['userType'].'"';?>+ 'wait');
			console.log("SESSION_theme"+<?php echo '"'.$_SESSION['theme'].'"'; ?>+ 'wait');
			//pNotify();
		</script>
	</head>
	<body id="theBody">
		<header>
			<div class="hfContent" id="headerContent">
				<h1 id="title">Cards against humanity <span id="subtitle">Lobby</span></h1>
				<ul id="headerNav">
					<li><a href=<?php echo "login.php?loginType=login"; ?>>Login</a></li>
					<li>|</li>
					<li><a href=<?php echo "login.php?loginType=reg"; ?>>Registrieren</a></li>
					<li>|</li>
					<li><a href=<?php echo "/inc/logout.inc.php"; ?>>Logout</a></li>
				</ul>
			</div>
		</header>
		<main>
		<div id="pageContent">
		    <!--TODO: unterschiedlicher content, je nachdem, ob als erster in der Lobby oder nicht (andere können keine Einstellungen vornehmen)-->
		    
			<!--Mitspieler Anzeige-->
			<div class="box" id="userListBox">
				<h2>Mitspieler</h2>
				<div id="userList">
					<ol id="playerList">
						<li id="player1"><?php echo $userName;?></li><!--display username, highlighted-->
				</ol>
				</div>
			</div>
			
			<!-- Platzhalter -->
			<div id="middleContainer">
			<div class="box" id="infoBox">
				<span id="infoText">Herzlich willkommen bei <span id="infoColored">Cards against humanity</span> !</span>
			</div>
			
				<div class="box" id="codeBoxCont">
					<h2 id="setHeader">Kartensets</h2>
				<div id="codeBox">
					<div id="labelCont">
						<div id="innerLabelCont1">
						<label for="packCode" class="selectorBox" id="packLabel">Kartenset-Code:</label>
						<input type="text" name="packCode" class="selector" id="packCode">
						</div>
						<div id="innerLabelCont2">
						<button class="button" id="applySet">Set hinzuf&uuml;gen</button>
						</div>
					</div>
					<div id="codeList">
						<div class="codeElement" id="code0">
							<span class="codeEName">1 (default original)</span>
							<img class="burner" src="img/cross2.png">
						</div>
						<div class="codeElement" id="code1">
							<span class="codeEName">2 (default)</span>
							<img class="burner" src="img/cross2.png">
						</div>
						<div class="codeElement" id="code2">
							<span class="codeEName">3 (default)</span>
							<img class="burner" src="img/cross2.png">
						</div>
						<div class="codeElement" id="code3">
							<span class="codeEName">4 (default)</span>
							<img class="burner" src="img/cross2.png">
						</div>
					</div>
				</div>
				</div>
			</div>
			
			<div class="box" id="settingBox">
				<h2>Einstellungen</h2>
				<form id="settings" method="post" action="game-ohneDB.php"><!--action="gameloop.php"--> 
					<ul>
						<li><label class="selectorBox" for="numInventar">Anzahl Handkarten:</label>
							<select name="numInventar" class="selector" id="numInventar">
								<!--wie groß soll der Auswahlbereich sein? -->
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option selected>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
							</select>
						</li>
						<li><label class="selectorBox" for="numWin">Punkte zum Gewinnen:</label>
							<input type="text" class="selector" name="numWin" id="numWin" value="5">
						</li>
						<li><label class="selectorBox" for="numPlayer">Anzahl Spieler:</label>
						<!--
						    - wie werden die Spieler letzendlich ausgewählt? Reihenfolge beim joinen?  @HannesSeinSenf: was machbar sein sollte, wäre in der Spielerdatenbank zu schauen wieviele schon da sind und dann eben nen neuen Eintrag zu erstellen. Also ja, letztendlich nach join Reihnfolge 
						    - was passiert, wenn nicht genügend Spieler in der Lobby sind?              @hannesSeinSenf: ich würde sagen sobald mehr als 3 ist spielen möglich, sodass es quasi nur die max spieler anzahl ist die man einstellt. und wenn voll ist würde ich so nen 10 sekunden countdown o.ä. zum starten.
						    - was passiert, wenn zu viele Spieler in der Lobby sind?                    
						        -> werden aus der Lobby geschmissen? @HannesSeinSenf. würde die Leute nicht direkt kicken, was wenn man ausversehen auf drei Stellt und dann quasi alle geckickt werden?
						    - Begrenzung der Spielerzahl auf ?7? -> join verhindern, wenn Lobby voll  @HannesSeinSenf: würde kein Limit, bzw. kein so niedriges Limit einbauen
						    -->
							<select name="numPlayer" class="selector" id="numPlayer">
								<option selected>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
							</select>
						</li>
						<li><label class="selectorBox">
							<input type="checkbox" name="burnRound" id="burnRound" checked>
							wegschmei&szlig;en erlauben</label></li>
							<!--TODO: variable setzen, in game.html abrufen und grafisch umsetzen-->
						<li><label class="selectorBox" for="burnTime">Antwortzeit</label>
							<select name="burnTime" class="selector" id="burnTime">
								<option>10s</option>
								<option>20s</option>
								<option selected>30s</option>
								<option>45s</option>
							</select>
						</li>
						<li id="startenBox">
							<input type="hidden" name="theme" value=<?php echo $theme; ?>>
							<input type="hidden" name="userType" value=<?php echo $userType; ?>>
							<input type="hidden" name="username" value=<?php echo $userName; ?>>
							<button type="submit" name="action" class="button" id="starten">Starten</button>
						</li>
					</ul>
				</form>
			</div>
		</div>
			<div class="box" id="statusBox">
				<ul id="statusInfo">
					<li class="playerStatus" id="user_host">Du bist der Host und musst die Einstellungen f&uuml;r das Spiel festlegen</li>
					<li class="playerStatus" id="user_player">Der Host legt die Einstellungen f&uuml;r das Spiel fest. Bitte warte, bis er das Spiel startet</li>
					<li class="playerStatus" id="user_default">Da ist wohl irgendwas schiefgelaufen</li>
					<li><label class="selectorBox" for="changeTheme">Farbschema: </label>
						<select class="selector" id="changeTheme">
							<option selected>--w&auml;hle ein Farbschema--</option>
						</select></li>
				</ul>
			</div>
			
		</main>
		<footer>
			<ul>
			    <li><a href="http://www.lysin-games.com/agb">Allgemeine Gesch&auml;ftsbedingungen</a></li>
			    <li><a href="http://www.lysin-games.com/datenschutz">Datenschutzerkl&auml;rung</a></li>
				<li><a href="http://www.lysin-games.com/impressum">Impressum</a></li>
			</ul>
		</footer>
	</body>
</html>
<!---->