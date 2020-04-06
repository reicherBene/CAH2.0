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
    #settings=[];
    #players=[]; //Playerobjekte

    constructor(id, password, maxPlayer, master, package) {
        
        this.#id = id;
        this.#password = password;
        this.#maxPlayer = maxPlayer;
        this.#master = master;

        //load WC BC from package
    }

    removePlayer(playerID) {
        if (!this.playerInGame(oldPlayer)){
            return false;
        }
        this.#players.filter(element => {
            return element.valueOf()!==playerID;
        });
    }

    addPlayer(newPlayer){
        //player instanceof Player.js
        if (this.#numPlayer >= this.#maxPlayer) {
            return false;
        } else if (this.#gamestate!='Lobby') {
            return false;
        } else {
            if (this.playerInGame(newPlayer)) {
                return false;
            }
            this.#players.push(newPlayer);
            this.#numPlayer++;
            return true;
            
        }
    }

    playerInGame(newPlayer) {
        for(player in this.#players) {
            if (newPlayer.valueOf()===player.valueOf) {
                return true;
            }
        }
        return false;
    }

    gameSetup() {
        this.loadBC();
        this.loadWC();
    }

    loadWC() {
        //TODO
    }

    loadBC(){
        //TODO
    }

    get id(){
        return this.#id;
    }

    get password(){
        return this.#password;
    }

    get gamestate(){
        return this.#gamestate;
    }

    set gamestate(gamestate){
        if (gamestate==='Lobby' || gamestate==='Running' || gamestate==='End'){ 
            return false;
        }
        this.#gamestate = gamestate;
    }

    
    #numPlayer=0;
    #maxPlayer=3; // min. 3
    #WC=[];
    #BC=[];
    #currentBC='';
    #master=''; //socketID
    #settings=[];
    #players=[];

    valueOf(){
        return this.#id;
    }

}

module.exports = Game;