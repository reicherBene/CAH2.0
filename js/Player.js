class Player {
    /**
     * 
     */
    #id = "";
    #socketID = "";
    #gameID = "";
    #nickname = "";
    #score = 0;
    #hand = [];
    #czar = false;

    constructor(socketID, nickname) {
        // this.#userID = userID;
        this.#socketID = socketID;
        this.nickname = nickname;
    }

   valueOf(){
       return this.#id;
   }

}

module.exports = Player;