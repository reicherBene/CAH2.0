/*requires: 
	- array with Card texts (-> let whiteCardTextArray = array[];)
*/
const blackCard = document.getElementById('blackCard');
blackCard.classList.add('card');
let addText = document.createTextNode(blackCardText);
blackCard.appendChild(addText);

//scoreboard
const scoreboard = document.getElementById('scoreboard');


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


function addPlayer(playerName){
	console.log("addPlayer");
	newPlayer = document.createElement('tr');
	playerNameCell = document.createElement('td');
	playerNameCell.classList.add('nameCell');
	playerScoreCell = document.createElement('td');
	playerScoreCell.classList.add('scoreCell');
	playerNameCell.appendChild(document.createTextNode(playerName));
	
	players.push(new Player(playerName, playerCount));
	
	newPlayer.id = players[playerCount].id;
	
	playerNameCell.classList.add("nameCell");
	playerScoreCell.classList.add("scoreCell");
	playerScoreCell.appendChild(document.createTextNode(players[playerCount].score));
	newPlayer.appendChild(playerNameCell);
	newPlayer.appendChild(playerScoreCell);
	scoreboard.appendChild(newPlayer);
}
/*
players.forEach(function (player){
	addPlayer(player.name);
});*/
playerNames.forEach(function (name){
	addPlayer(name);
});

function setCzar(playerName){
	players.forEach(function(player){
		if(player.name === playerName) player.playerType = 'czar';
		else{player.playerType = 'slave';}
	});
	
}

const cardContainer = document.getElementById('whiteCards');
const cardContainer2 = document.getElementById('whiteCardsSlave');
const applyButton = document.getElementById("applyChose");
applyButton.addEventListener('click', onApply);
const logList = document.getElementById('logList');
let whiteCardArray = [];
let selectedCard;
let btnEnable = false;
let applied = false;

function Card(num, content, burn){
	this.num = num;
	this.id = "wc"+num;
	this.txt = content;
	this.burn = burn;
	this.burned = false;
	this.htmlClass = "whiteCard";
	this.content = document.createTextNode(content);
	this.htmlText = document.createElement('p');
	this.htmlElement = document.createElement('div');
	
	this.enabled = true;
	this.chosen = false;
}

function initCards(){
	console.log('initCards');
	
	let burn = true; //TODO
	
	whiteCardTextArray.forEach(function(cardText, index){
		whiteCardArray.push(new Card(index, cardText, burn));
	});
	
	whiteCardArray.forEach(function(card){
		let htmlCard = card.htmlElement;
		
		htmlCard.appendChild(card.content);
		htmlCard.setAttribute('class', card.htmlClass);
		htmlCard.setAttribute('id', card.id);
		cardContainer.appendChild(htmlCard);
		htmlCard.classList.add('box');
		htmlCard.classList.add('card');
		htmlCard.classList.add('wc');
		
		htmlCard.addEventListener('click', function(){ if(!card.burned) onSelected(card);});
	});
}

function disableCard(card){
	card.enabled = false;
	card.htmlElement.classList.add('disabled');
}

function addCard(cardText){
	let card = new Card(whiteCardArray.lenght, cardText);
	whiteCardArray.push(card);
	let htmlCard = card.htmlElement;
	htmlCard.appendChild(card.content);
	htmlCard.setAttribute('class', card.htmlClass);
	htmlCard.setAttribute('id', card.id);
	cardContainer.appendChild(htmlCard);
	htmlCard.classList.add('box');
	htmlCard.classList.add('card');
	htmlCard.classList.add('wc');
	
	htmlCard.addEventListener('click', function(){
		if(!card.burned) onSelected(card);
		});
		
	cardContainer2.appendChild(hmtlCard);
}

function onSelected(sCard){
	btnEnable = true;
	if(sCard.enabled){
		whiteCardArray.forEach(function(card){
			deselect(card);
		});
		sCard.chosen = true;
		selectedCard = sCard;
		sCard.htmlElement.classList.add('chosen');
		console.log('chose card: '+sCard.id);
	}
}

function deselect(card){
	card.chosen = false;
	card.htmlElement.classList.remove('chosen');
	console.log('deselect:' +card.id);
}

document.cookie = "appliedBool = false";
function onApply(){
	if(!applied){
		if (!btnEnable) gameLog("du musst erst eine Karte auswählen",3);
		else { 
			whiteCardArray.forEach(function(card){
				disableCard(card);
			});
			selectedCard.htmlElement.classList.remove('disabled');
			selectedCard.htmlElement.classList.add('applied');
		
			document.cookie = "appliedCard = "+selectedCard.txt;
			document.cookie = "appliedBool = true";
		
			console.log('applied '+selectedCard.id+': '+selectedCard.txt);
			applied = true;
		}
	}
}

let logCount = 0;
let log = [];
function gameLog(content, type){
	log.push(content);
	let newEntry = document.createElement('li');
	newEntry.classList.add('gameLog');
	newEntry.id = "log"+logCount;
	switch(type){
		case 3: 
			newEntry.classList.add('gameError');
			break;
		default: break;
	}
	
	newEntry.appendChild(document.createTextNode(content));
	
	if(logCount < 4) logList.appendChild(newEntry);
	else{
		logList.removeChild(logList.firstChild);
		logList.appendChild(newEntry);
	}
	logCount++;
}

//time bar
const timeBar = document.getElementById('ladebalkenReverse');
function startTimeBar(){
	timeBar.classList.add('tBarEmpty');
}

function resetTimeBar(){
	timeBar.classList.add('tBarFull');
}/*
function switchTimeBar(){
	if(timeBar.classList.contains('tBarFull')){
		timeBar.classList.replace('tBarFull', 'tBarEmpty');
	}
	else if(timeBar.classList.contains('tBarEmpty')){
		timeBar.classList.replace('tBarEmpty', 'tBarFull');
	}
}*/
window.onload = (event) => {
	startTimeBar();
}

//add theme options
function addThemeOptions(){
	for(let x = 0; x < themes.length; x++){
		if(themes[x].unlocked){
			newOption = document.createElement('option');
			newOption.appendChild(document.createTextNode(themes[x].outerName));
			themeSelect.appendChild(newOption);
		}
	}
}

initCards();
addThemeOptions();