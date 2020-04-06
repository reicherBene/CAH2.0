const Player = require('./js/Player.js')

class Game {

    #id='';
    #password='';
    #gamestate=''; //ACHTUNG: soll nur "Lobby", "Running", "End" annehmen
    #numPlayer=0;
    #maxPlayer=3; // min. 3
    #WC=[];
    #BC=[];
    #currentBC='';
    #master=''; //socketID
    #player=[]; //Playerobjekte

    constructor(id, password, maxPlayer, master, package) {
        
        this.#id = id;
        this.#password = password;
        this.#maxPlayer = maxPlayer;
        this.#master = master;

        //load WC BC from package
    }
}

module.exports = Game;