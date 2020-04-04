<!DOCTYPE html>
<html id="html">
	<head>
		<meta name="author" title ="infCourse, Benedikt Reichert">
		<title>Cards against humanity | Game</title> <!--evtl. später Lobby xyz statt Game -->
		
		<?php 
			include 'default_head.php'; 
			//include 'scripts.php';
			
			$runningGame = true; //damit ein player/czar css file zugewiesen wird
			
			$isCzar = false;
			$theCzar = 'me';
			/*
			$theCzar = getCzar($db);
			*/
			if($theCzar === $userName) $isCzar = true;
			$_SESSION['playerType'] = ($czar) ? "czar" : "slave";
	    ?>
		
		<link rel="stylesheet" href="css/game.css">
		<?php include 'addTypeCSS.php'; 
			$userType = $_GET['userType'];
			$_SESSION['userType'] = $userType;
		?>
		<script defer type='text/javascript'>
			<?php
				$userName = $_SESSION['userName'];
				//$numInv = getSettings($db,1);
			
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
				fill_hand($db, $userName);
				$karten_php = whiteIdToText($db, getHand($db, $userName));
				*/
				$karten_php = array('firstCard', 'secondCard', 'thirdCard', '4', '5', '6', '7', '8', '9', 'aaaaaaaand 10');
				$karten_js = json_encode($karten_php);
				echo "let whiteCardTextArray = ".$karten_js.";\n";
			?>
		</script>
		<script defer type = "text/javascript">
		/*
let players =[];
let playerCount = 0;

function Player(name, number){
	this.name = name;
	this.number = number
	this.id = 'player'+number;
	this.score = 0;
	this.playerType = "slave";
	this.finished = false;
}

function createPlayer(playerName){
	players.push(new Player(playerName, playerCount));
	
	//players[playerCount].score = 
}
playerNames.forEach(function(name){
	createPlayer(name, playerCount);
	playerCount++;
});*/
		</script>
		<script defer src="js/game.js"></script>
		<style type="text/css">
			#ladebalkenReverse{
				transition: width <?php echo $_POST['burnTime']; ?>, background <?php echo $_POST['burnTime']; ?>;
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
					<div id="instructionBox">
						<h2 id="instruction">W&auml;hle eine Karte aus:</h2>
						<div id="timerBar"><div id="ladebalkenReverse" class="tBarFull"></div></div>
					</div>
					<div id="whiteCards">
					
					</div>
					<div id="gameControl">
						<button class="button" id="applyCard">Karte legen</button>
					</div>
				</div>
				<div class="box" id="czarInfo">
					<span id="czarText">Du bist der Czar und musst warten bis deine Mitspieler ihre Karten ausgew&auml;hlt haben</span>
					<div id="clickCounter">
						<p id="ccInfo"></p>
						<p id="ccText"></p>
					</div>
					<button class="button" id="justClick">Zum Zeitvertreib hier klicken</button>
				</div>
			</div>
			<div class="box" id="statusBox">
				<ul id="statusInfo">
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
