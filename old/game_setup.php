<?php
include "database_connect.php";
include "scripts.php";

$db = connect_database();

saveSetting($db, "numInventar", mysqli_real_escape_link($db,$_POST["numInventar"]));

saveSetting($db, "numWin", mysqli_real_escape_link($db,$_POST["numWin"]));

saveSetting($db, "numPlayer", mysqli_real_escape_link($db,$_POST["numPlayer"]));

saveSetting($db, "antwortzeit", mysqli_real_escape_link($db,$_POST["antwortzeit"]));

$burnRound = mysqli_real_escape_link($db,$_Post["burnRound"]);

if($burnRound == true){
    saveSetting($db, "burnRound",$burnRound);
    saveSetting($db, "burnTime", mysqli_real_escape_link($db,$_POST["burnTime"]));
}
else{
    saveSetting($db, "burnRound","FALSE");
}

//header("Location: game.php");
header("Location: game-ohneDB.php");
exit();


?>
