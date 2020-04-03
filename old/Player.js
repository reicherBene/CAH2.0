class Player{
    /**
     * 
     */
    #userID = "";
    #socketID = "";
    #nickname = "";
    #score = 0;
    #hand = [];

    constructor(userID){
        this.#userID = userID;
    }

    setNickname(nickname){
        this.#nickname = nickname;
    }

    getUserID() {
        return this.#userID;    
    }

}

module.exports = Player;