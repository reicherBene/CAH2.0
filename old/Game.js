const Player = require('./Player.js');
class Game{
    
    /**
     * id:
     * players:
     * settings:
     * running: 
     * blackCards:
     * whiteCards:
     * gameState:
     * czar:
     */
    #id='';
    #players=[];
    #settings=[];
    #running=false;
    #blackCards=[];
    #whiteCards=[];
    #gameState='default';
    #czar="";
    constructor (id, players, settings){
        this.#id = id;
        this.#players = players;
        this.#settings = settings;
        //TODO load WC/BC
    }

    start(){
        //TODO
        console.log('starting game ' + this.#id);
        this.#running = true;
    }

    getCzar(){
        return this.#czar;
    }

    checkForWinner(){
        //TODO
        console.log('checking for winner');
    }

    getRunning(){
        return this.#running;
    }

    getId(){
        return this.#id;
    }
    
    getPlayers(){
        return this.#players;
    }

    getSettings(){
        return this.#settings;
    }

    getSb(){
        //TODO
    }

    nextRound(){
        //fillHands
        //new Czar
        //new BC
    }

    addPlayer(userID){
        this.#players.forEach(element => {
            if (element.userID == userID) {
                return;
            }
        });
        this.#players.push(new Player(userID));
    }
}

module.exports = Game;

