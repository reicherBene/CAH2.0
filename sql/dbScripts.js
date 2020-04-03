

dbConnection = require('./dbConnection.js')();
// console.log(db);
// dbConnection = db();

class Scripts {

  static gameToDB(gameID, settings) {
    gameID = "'" + gameID + "'";
    try {
     settings = convert(settings);
    } catch (err) {
      console.log(err);
      return false;
    }
    var req = "INSERT INTO games (gameID\, gamestate\, numPlayer\, maxPlayer\, burnround\, WC) VALUES (" + gameID + "\, 'waitStart'\, 0\, " + settings[0] + "\, " + settings[1] + "\, '" + settings[2] + "')";
    dbConnection.query(req);
  }

  static createGame(gameID, settings) {
    //check duplicated gameID
    
    
    // console.log(res);
    //store in DB
    // gameToDB(gameID, settings);
    
  }

  static addPlayer(gameID) {
    var req = "UPDATE games SET numPlayer = numPlayer + 1 WHERE gameID = '" + gameID + "'";
    dbConnection.query(req);
    console.log('Player joined game ' + gameID);
  }

  
}

function convert(arr) {
  var newArr = [];
  arr.forEach(element => {
    // console.log(element);
    if (element === ""){
      newArr.push('NULL');
      // throw "empty string Exception";
    } else if (element === true) {
      newArr.push(1);
    } else if (element === false) {
      newArr.push(0);
    } else {
      newArr.push(element);
    }
  });
  return newArr;
}



function handlerResult(err, result){
  if (err) {
    console.error(err.stack || err.message);
    return;
  }
  console.log('res: ' + result);
}

module.exports = Scripts;