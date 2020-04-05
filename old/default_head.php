<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<meta charset="ISO-8859-1">
<meta name="description" content="This is a good web version of 'cards against humanity'">
<script defer type="text/javascript">
<?php
	session_start();
	
	$defaultTheme = 'light';
	if(!$_SESSION['theme']) $_SESSION['theme'] = $defaultTheme;
	$theme = ($_COOKIE['changedTheme']) ? $_COOKIE['changedTheme'] : $_SESSION['theme'];
	
	$userName = ($_COOKIE['userName']) ? $_COOKIE['userName'] : '--nobody--';
	/*
	if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1)) {
        header("Location: login.php");//unterscheiden login<->registrieren; dementsprechend Auswahl in login.php
        exit();
    }*/
	if((isset($_SESSION['perms']) && $_SESSION['perms'] < 99)) header("Location: index.php?e=perm");
?>
</script>
<link rel="icon" href= <?php echo "img/light-grey.png"?> type="image/x-icon" id="iconLink">

<link rel="stylesheet" href="css/themes.css">
<link rel="stylesheet" href="css/cah_default.css">

<?php
	$useragent=$_SERVER['HTTP_USER_AGENT'];
?>
<script defer src="js/tools.js"></script><!--TODO-->
<script defer type="text/javascript">
	const wholePage = document.getElementById("html");
	let nowTheme = <?php echo '"'.$theme.'"'; ?>;
	
function changeTheme (oldTheme, newTheme){
	console.log("changeTheme from:"+oldTheme+" to:"+newTheme);
	if(!wholePage) console.log("wholePage is null");
	wholePage.className=newTheme;
	nowTheme = newTheme;
	createCookie('changedTheme', nowTheme);
};

function createCookie(name, value){
	document.cookie = name + "=" + value;
}
</script>
<script defer src="js/themes.js"></script>
<script defer src="js/changeTheme.js"></script>
<script defer type="text/javascript">
	console.log("$theme: "+<?php if(empty($theme)) echo '"isEmpty"'; else{ echo "'".$theme."'";} ?>+"");
	changeTheme(nowTheme, <?php echo "'".$theme."'";?>);
	
	const iconLink = document.getElementById('iconLink');
	
	<?php
		$isIn = false;
		$newHref;

		if(file_exists("img/".$theme.".png")){
			echo "console.log('file exists: $theme');\n";
			$isIn = true;
		}
		else{
			echo "console.log('file does not exist: $theme');\n";
			$isIn = false;
		}
		$newHref = ($isIn) ? 'img/'.$theme.'.png' : 'img/light-grey.png';
		$_SESSION['icon'] = $newHref;
	?>
	
	iconLink.href = <?php echo '"'.$newHref.'"' ?>;
	
	//document.addEventListener("DOMContentLoaded", changeTheme(nowTheme, <?php echo "'".$theme."'";?>));
	<?php $_SESSION['theme']=$theme; ?>
</script>
