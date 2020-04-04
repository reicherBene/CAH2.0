const playerList = document.getElementById('playerList');
const playerStatus = document.getElementById('statusInfo');

var newPlayer;
var newStatus;

function addPlayer(playerName){
	console.log("addPlayer");
	newPlayer = document.createElement('li');
	newPlayer.appendChild(document.createTextNode(playerName));
	playerList.appendChild(newPlayer);
}

//add theme options
function addThemeOptions(){
	console.log("addThemeOptions");
	for(let x = 0; x < themes.length; x++){
		if(themes[x].unlocked){
			console.log("newOption");
			newOption = document.createElement('option');
			newOption.appendChild(document.createTextNode(themes[x].outerName));
			themeSelect.appendChild(newOption);
		}
	}
}

function addThemeOption(themeName){
	let num = getNumber(themeName);
	if(themes[num].unlocked){
		console.log("add Option");
		newOption = document.createElement('option');
		newOption.appendChild(document.createTextNode(themes[num].outerName));
		themeSelect.appendChild(newOption);
	}
}

//disable button until 3 player joined
newPlayerNames.forEach(addPlayer);
addThemeOptions();