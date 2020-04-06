class Player {
    /**
     * 
     */
    // #userID = "";
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

   

}

module.exports = Player;