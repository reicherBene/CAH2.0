class Game{
    /**
     * id:
     * players:
     * settings:
     * running: 
     * blackCards:
     * whiteCards:
     * 
     */
    #id='';
    #players=[];
    #settings=[];
    #running=false;
    #blackCards=[];
    #whiteCards=[];
    constructor (id, players, settings){
        this.#id = id;
        this.#players = players;
        this.#settings = settings;
    }

    start(){
        //TODO
        console.log('starting game');
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
}

module.exports = Game;

