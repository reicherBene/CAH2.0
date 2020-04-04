<!DOCTYPE html>
<html id="html">
	<head>
		<meta name="author" title="Benedikt Reichert">
		<title>Cards against humanity | Game</title>
		
		<?php 
			include 'default_head.php'; 
			//include 'scripts.php';
			
			$runningGame = true; //damit ein player/czar css file zugewiesen wird
			
			$isCzar = false;
			$theCzar = 'me';
			/*
			$theCzar = getCzar($db);
			*/
			$theCzar = ($_GET['playerType'] === "czar") ? $userName : $theCzar;
			if($theCzar === $userName) $isCzar = true;
			$_SESSION['playerType'] = ($isCzar) ? "czar" : "slave";
	    ?>
		
		<link rel="stylesheet" href="css/game.css">
		<link rel="stylesheet" href="css/roundResult.css">
		<?php include 'addTypeCSS.php'; 
			$userType = $_GET['userType'];
			$_SESSION['userType'] = $userType;
		?>
		<script defer type='text/javascript'>
			<?php
				$userName = $_SESSION['userName'];
			
				//$php_array = getTeilnehmer($db);
				$php_array = array('Hans', 'Olger', 'Jürgen', 'Ingeborg');
				$js_array = json_encode($php_array);
				echo "let playerNames = ".$js_array.";\n";
				
				/*
				$blackCard = blackIdToText($db, getAktivBlackcard($db));
				*/
				$blackCard = "'Hallo ich bin eine schwarze Karte und das ist eine L&uuml;cke. Oder Lücke? _________'";
				echo "let blackCardText = ".$blackCard.";\n" ;
				
				/*
				$karten_php = alle whiteCards, die gelegt wurden
				*/
				$karten_php = array('firstCard', 'secondCard', 'thirdCard');
				$karten_js = json_encode($karten_php);
				echo "let whiteCardTextArray = ".$karten_js.";\n";
				
				$choseTime = "90s";
			?>
		</script>
		<script defer src="js/roundResult.js"></script>
		<style type="text/css">
			#ladebalkenReverse{
				transition: width <?php echo $choseTime; ?>, background <?php echo $choseTime; ?>;
				transition-timing-function: linear, linear;
			}
		</style>
	</head>
	<body>
		<header>
			<div class="hfContent" id="headerContent">
				<h1 id="title">Cards against humanity <span id="subtitle">Game</span></h1>
				<ul id="headerNav">
					<li><a href=<?php echo "'login.php?loginType=login'"; ?>>Login</a></li>
					<li>|</li>
					<li><a href=<?php echo "'login.php?loginType=reg'"; ?>>Registrieren</a></li>
					<li>|</li>
					<li><a href=<?php echo "/inc/logout.inc.php"; ?>>Logout</a></li>
				</ul>
			</div>
		</header>
		<main>
			<div id="gameContainer">
				<div id="topContent">
				<div class="box" id="blackCard">
				
				</div>
				<div class="box" id="playerBoard">
					<!-- add table to game.php -->
					<table id="scoreboard">
						<tr>
							<th class="nameCell" id="playerHead">Spieler</th>
							<th class="scoreCell" id="pointHead">Punkte</th>
						</tr>
					</table>
				</div>
				</div>
				<div class="box" id="whiteCardContainer">
					<div id="czarContent">
						<div id="instructionBox">
							<h2 id="instruction">W&auml;hle die beste Karte aus und best&auml;tige:</h2>
							<div id="timerBar"><div id="ladebalkenReverse" class="tBarFull"></div></div>
						</div>
						<div id="whiteCards">
							
						</div>
						<div id="gameControl">
							<button class="button" id="applyChose">Auswahl best&auml;tigen</button>
						</div>
					</div>
					<div id="slaveContent">
						<div id="instructionBox">
							<h2 id="instruction">Der Czar w&auml;hlt eine der gelegten Karten aus:</h2>
						</div>
						<div id="whiteCardsSlave">
							
						</div>
					</div>
				</div>
			</div>
			<div class="box" id="statusBox">
				<ul id="statusInfo">
					<li><span id="czarText">Du bist der Czar und musst die Karte ausw&auml;hlen, die am besten passt.</span></li>
					<li><span id="slaveText">Du musst warten, bis der Czar seine Auswahl getroffen hat.</span></li>
					<li><label class="selectorBox" for="changeTheme">Farbschema: </label>
						<select class="selector" id="changeTheme">
							<option selected>--w&auml;hle ein Farbschema--</option>
						</select></li>
				</ul>
				<ul id="logList">
				
				</ul>
			</div>
		</main>
		<footer>
			<ul>
			    <li><a href="http://www.lysin-games.com/agb">Allgemeine Gesch&auml;ftsbedingungen</a></li>
			    <li><a href="http://www.lysin-games.com/datenschutz">Datenschutzerkl&auml;rung</a></li>
				<li><a href="http://www.lysin-games.com/impressum">Impressum</a></li>
				<li>&copy;lysin-games 2019</li>
			</ul>
		</footer>
	</body>
</html>