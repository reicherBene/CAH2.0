var mysql = require('mysql');




function getConnection() {
  var connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: 'cah'
  });
  
  connection.connect(function(err) {
    if (err){
      console.log(err);
    } else {
      console.log('Connected');
    }
  });  
  
  return connection;
}

// export default getConnection;
module.exports = getConnection;