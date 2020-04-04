<!DOCTYPE html>
<html id="html">
	<head>
		<meta name="author" title ="infCourse, Benedikt Reichert">
		<title>Cards against humanity | Game</title> <!--evtl. später Lobby xyz statt Game -->
		
		<?php 
			include 'default_head.php'; 
			include 'scripts.php';
			include 'database_connect.php';
	            $db = connect_database();
			include 'settings.php';
			
			$numInventar = $_POST['numInventar'];
			$numWin = $_POST['numWin'];
			$numPlayer = $_POST['numPlayer'];
			$burnRound = $_POST['burnRound'];
			$burnTime = $_POST['burnTime'];
			
			/*
			$numInventar = getSetting(1);
			$numWin = getSetting(2);
			$numPlayer = getSetting(3);
			$burnRound = getSetting(4);
			$burnTime = getSetting(5);
			*/

			
			$runningGame = true; //damit ein player/czar css file zugewiesen wird
			$_SESSION['playerType'] = "slave";
	    ?>
		
		<link rel="stylesheet" href="css/game.css">
		<?php include 'addTypeCSS.php'; 
			$userType = $_GET['userType'];
			$_SESSION['userType'] = $userType;
		?>
		
		<script defer type='text/javascript'>
			<?php
				$username = $_SESSION['username'];
				$numInventar = getSettings($db,1);
			
				$php_array = getTeilnehmer($db);
				$js_array = json_encode($php_array);
				echo "let newPlayerNames = ".$js_array.";\n";
				
				//Datenbankabfrage Handkarten
				$karten_php = array('firstCard', 'secondCard', 'thirdCard', '4', '5');
				$karten_js = json_encode($karten_php);
				echo "let whiteCardTextArray = ".$karten_js.";\n";
			?>
		</script>
		<script defer src="js/game.js"></script>
		<script defer type="text/javascript">
			console.log("SESSION_userName"+<?php echo '"'.$_SESSION['username'].'"'; ?>+ 'wait');
			console.log("SESSION_userType"+<?php echo '"'.$_SESSION['userType'].'"';?>+ 'wait');
			console.log("SESSION_theme"+<?php echo '"'.$_SESSION['theme'].'"'; ?>+ 'wait');
			//pNotify();
		</script>
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
				<div class="box" id="blackCard">
				
				</div>
				<div class="box" id="playerBoard">
					<!--table-->
				</div>
				<div class="box" id="whiteCardContainer">
					<div id="instructionBox">
						<h2 id="instruction">W&auml;hle eine Karte aus:</h2>
					</div>
					<div id="whiteCards">
					
					</div>
					<div id="gameControl">
						<button class="button" id="applyCard" disabled>Karte legen</button>
					</div>
				</div>
			</div>
			<div class="box" id="timerBar"></div><!--TODO-->
			<div class="box" id="statusBox">
				<ul id="statusInfo">
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
				<li>&copy;lysin-games 2019</li>
			</ul>
		</footer>
	</body>
</html>
