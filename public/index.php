<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require '../src/config/db.php';


$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    echo "<script> console.log('prueba por develop');</script>";
    echo "<script> console.log('mis primeros pasitos');</script>";
    return $response;
});



//require '../src/rutas/clientes.php';
$app->run();