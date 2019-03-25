var express = require("express");
var bodyParser = require('body-parser');
var http_port = process.env.HTTP_PORT || 6004;

var initHttpServer = () => {
    var app = express();
    app.use(bodyParser.json())
    app.post('/test', (req, res) => {

        console.log(req.body);
        res.send();
    });
    app.listen(http_port, () => console.log('Listening http on port: ' + http_port));
};
initHttpServer();