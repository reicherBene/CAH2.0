/*reqiures: default_head.php 
	-> vars: nowTheme
*/
/* -> include in php file*/
function Theme(outerName, innerName, type, unlocked){
		this.outerName = outerName;
		this.innerName = innerName;
		this.type = type;
		this.unlocked = unlocked;
}
	
themes = [
	new Theme("Hell - Blau|Orange", "light", "public", true),
	new Theme("Hell - Grau|Orange", "light-grey", "public", true),
	new Theme("Dunkel - Cyan", "dark-cyan", "public", true),
	new Theme("Dunkel - Türkis", "dark-lightSeaGreen", "public", true),
	new Theme("triggered", "triggered", "hidden", false),
	new Theme("night", "night", "hidden", false),
	new Theme("kitsch", "kitsch", "hidden", false)
];

function getInnerName(outerName){
	let innerName = "";
	for(let x=0; x < themes.length; x++){
		if(themes[x].outerName === outerName){
			innerName = themes[x].innerName;
			break;
		}
	}
	return innerName;	
}

function getOuterName(innerName){
	let outerName = "";
	for(let x=0; x < themes.length; x++){
		if(themes[x].innerName === innerName){
			outerName = themes[x].outerName;
			break;
		}
	}
	return outerName;
}

function getNumber(innerName){
	let number = -1;
	for(let x=0; x < themes.length; x++){
		if (themes[x].innerName === innerName){ number = x; break;}
	}
	return number;
}

function unlockTheme(innerName){
	let numb = getNumber(innerName);
	themes[numb].unlocked = true;
	console.log("unlocked "+themes[numb]);
	document.cookie = innerName+" = true";
	addThemeOption(innerName);
}

function checkThemeCookies(){
	let checks = [
		"kitsch",
		"night",
		"triggered"
		];
	let cook;
	
	checks.forEach(function(cname){
		cook = getCookie(cname);
		if(cook){
			unlockTheme(cname);
			console.log("Cookie: "+cname);
		}
	});
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}