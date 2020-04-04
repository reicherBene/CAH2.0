<?php
function mysql_to_array($result){
    $array = array();
    if(mysqli_num_row($result)>0){
        while($row = mysqli_fetch_array($result)){
            array_push($array, $row);
        }
    }
    return $array;
}

function saveSetting($db,$name,$value){
    $db->query("UPDATE settings SET " .$name ." = " .$value);
}

function getSetting($db,$index){
    switch($index){
    case 1:
        return $db->query("SELECT numInventar FROM settings");
    case 2:
        return $db->query("SELECT numWin FROM settings");
    case 3:
        return $db->query("SELECT numPlayer FROM settings");
    case4:
        return $db->query("SELECT burnRound FROM settings");
    case5:
        return $db->query("SELECT burnTime FROM settings");
	}
}

function getAktivBlackcard($db){
        $result = $db->query("SELECT id FROM black_cards WHERE aktiv = TRUE");
        return $result;
}

function next_blackcard($db){
    $db->query("UPDATE black_cards SET aktiv = FALSE && gelegt = TRUE WHERE aktiv = TRUE");
    $db->query("UPDATE black_cards SET aktiv = TRUE WHERE gelegt = FALSE ORDER BY RAND() LIMIT 1");
    
}

function fill_hand($db,$benutzername){
    $num_hand = getSetting(1);
    $count = $db->query("SELECT COUNT(handVon) FROM white_cards WHERE handVon = ".$benutzername);
    $number = $num_hand - $count;
    
    $db->query("UPDATE white_cards SET gezogen = TRUE && handVon = " .$benutzername ." && gezogen = TRUE WHERE gezogen = FALSE && gelegt = FALSE ORDER BY RAND() LIMIT ".$number);
    
}

function getTeilnehmer($db){
    $result = $db->query("SELECT benutzername FROM players WHERE online == TRUE ORDER BY benutzername");
    $teilnehmer = mysql_to_array($result);
    return $teilnehmer;
}

function getCzar($db){
    $result = $db->query("SELECT benutzername FROM players WHERE czar = true");
    return $result;
}

function setCzar($db, $benutzername){
    $db->query("UPDATE players SET czar = FALSE WHERE czar = TRUE");
    $db->query("UPDATE players SET czar = TRUE WHERE benutzername == ".$benutzername);
}

function newCzar($db){
    $index = 0;
    $teilnehmer = getTeilnehmer($db);
    $currentCzar = getCzar($db);
    $pos = array_search($currentCzar, $teilnehmer);
    if($pos = count($teilnehmer)){
        $index = 0;
    }
    else{
        $index ++;
    }
    setCzar($db, $teilnehmer[$index]);
}

function playWhitecard($db,$id){
    $db->query("UPDATE whitecards SET aktiv = TRUE WHERE id = " .$id);
}

function czarChose($db,$id){
    $winner = $db->query("SELECT handVon FROM white_cards WHERE id = ".$id);
    $db->query("UPDATE players SET score = score + 1 WHERE benutzername = ".$winner);
}

function clearBoard($db){
    $db->query("UPDATE white_cards SET aktiv = FALSE && gezogen = TRUE && handVon = NULL WHERE aktiv = TRUE");
    $db->query("UPDATE black_cards SET aktiv = FALSE && gezogen = TRUE WHERE aktiv = TRUE");
}

function getScore($db, $benutzername){
    $result = $db->query("SELECT score FROM player WHERE benutzername = ".$benutzername);
    return $result;
}

function checkForWinner($db){
    $teilnehmer = getTeilnehmer($db);
    foreach($teilnehmer as $benutzername){
        $score = getScore($db, $benuztername);
        $numWin = getSetting(2);
        if($score == $numWin){
            return true;
        }
    }
    return false;
}

function burnCard($db,$id){
    //todo !!!! soll nach dem burnen die white card nochmal gezogen werden können?
    //ich würde die einfach bei der neuen Runde mit auffüllen, sonst könnte man sich ja einfach bis zu einer guten Karte durchklicken
    $db->query("UPDATE white_cards SET handVon = NULL WHERE text == ".$text);
}

function whiteIdToText($db, $id){
    $result = $db->query("SELECT text FROM white_cards WHERE id == ".$id);
    return $result;
}

function whiteTextToId($db, $text){
    $result = $db->query("SELECT id FROM white_cards WHERE text == ".$text);
    return $result;
}

function blackIdToText($db, $id){
    $result = $db->query("SELECT text FROM white_cards WHERE id == ".$id);
    return $result;
}

function blackTextToId($db, $text){
    $result = $db->query("SELECT id FROM white_cards WHERE text == ".$text);
    return $result;
}

function getHand($db,$benutzername){
    $result = $db->query("SELECT id FROM white_cards WHERE handVon = ".$benutzername);
    return $result;
}
?>