<div class="headerholder">
	<div class="headerlogoholder">
		<img alt="logo" src="img/logo256.png">
	</div>
			
	<a href="spiele.php">SPIELE</a>
	<!-- <a href="">INFO</a>-->
	<a href="support.php">SUPPORT</a>
		
	<a href="index.php" id="name">LYSIN</a>
	<?php
	/*if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
	    echo '<a href="inc/logout.inc.php" id="login">ABMELDEN</a>';
	} else {
	    echo'<a href="login.php" id="login">ANMELDEN</a>';
	}*/?>
	
		
</div>
		
<!-- <div class="headerholderm">
	<div class="burgerholder" onclick="toggleNav()">
		<div class="burger"></div>
		<div class="burger"></div>
		<div class="burger"></div>
	</div>
	<div class="headerlogoholderm">
		<img alt="logo" src="img/logo256.png">
	</div>
	<div id="sidenav" class="sidenav">
		<a href="index.php">HOME</a>
		<a href="spiele.php">SPIELE</a>
		<a href="">INFO</a>
		<a href="support.php">SUPPORT</a> -->
		<?php
	/*if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
	    echo '<a href="inc/logout.inc.php">ABMELDEN</a>';
	} else {
	    echo'<a href="login.php">ANMELDEN</a>';
	}*/?>
	</div>
</div>
		
<script>
	var o = 0;
	function toggleNav() {
		if(o==0) {
			o=1;
			document.getElementById("sidenav").style.width = "100%";
		} else {
			o=0;
			document.getElementById("sidenav").style.width = "0px";
		}
	}
</script>
