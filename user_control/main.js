'use strict';
var mysql = require('mysql');
var http = require('http');
var url = require('url');
var bodyParser = require('body-parser');
var express = require("express");
var http_port = process.env.HTTP_PORT || 6003;



var tmpRes =[];



class User {
    constructor (phone= "", name=""){
        this.phone = phone.toString();
        this.name = name.toString()
    }

}
 var firstUser = () => {
     return new User ("1234", "12345" );
 }

 var users = [firstUser()]; 
 
var initHttpServer = () => {
    var app = express();
    app.use(bodyParser.json());

    app.get('/login', function(req, res){
          console.log(getAllUsers());
        res.send(JSON.stringify(getAllUsers()));
      });

      app.get('/getAll', function(req, res){
        //users = new User ("sdfsdf", "sdfsdfsdf");
        //tmpRes = readData();
        //console.log(getAllUsers());
        if (readData()){
            res.send(JSON.stringify( tmpRes));
            tmpRes = [];
        }
      
    });
    app.listen(http_port, () => console.log('Listening http on port: ' + http_port));
};

 var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "48432",
        database: "coinbg"
      });


var login = () => {
   
   
        
     
    
};
 con.connect(
        function (err) { 
            if (err) { 
                console.log("!!! Cannot connect !!! Error:");
                throw err;
            }
            else {
                console.log("Connection established.");
                // readData();
                
            }   
        });
    

var readData = () => {
             // var tmpRes = [];
             con.query('SELECT * FROM userblock', 
                 function (err, results, fields) {
                     if (err) throw err;
                     //else console.log('Selected ' + results.length + ' row(s).');
                     for (var i = 0; i < results.length; i++) {
     
                         //console.log('Row: ' + JSON.stringify(results[i].firstName));
                         tmpRes.push({
                            mobile: results[i].mobile,
                            name: results[i].firstName + " " + results[i].lastName,
                            email:  results[i].email
                        });
     
                     }
                     //return obj;
                     console.log('Done.');
                 })
               return true;
         
     };  



readData();

   

initHttpServer();