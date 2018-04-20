<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

//OBTENER TODOS LOS CLIENTES
$app->get('/api/clientes', function(Request $request, Response $response){

    $consulta = "SELECT * FROM clientes";

    try{

        //instanciar BD
        $db = new db();

        //conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $clientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null; //para cerrar consulta;

        //Exportar y mostrar json

        echo json_encode($clientes);

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().' }';
    }

});

//OBTENER UN SOLO CLIENTE
$app->get('/api/clientes/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $consulta = "SELECT * FROM clientes WHERE id = '$id'";

    try{

        //instanciar BD
        $db = new db();

        //conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $cliente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null; //para cerrar consulta;

        //Exportar y mostrar un sólo cliente en json

        echo json_encode($cliente);

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().' }';
    }

});

//AGREGAR UN CLIENTE
$app->post('/api/clientes/agregar', function(Request $request, Response $response){

    $nombre = $request->getParam('nombre');
    $apellidos = $request->getParam('apellidos');
    $telefono = $request->getParam('telefono');
    $email = $request->getParam('email');
    $direccion = $request->getParam('direccion');
    $ciudad = $request->getParam('ciudad');
    $departamento = $request->getParam('departamento');

    //procedimiento almacenado los : son comodines de variables temp para seguridad
    $consulta = "INSERT INTO clientes  (nombre, apellidos, telefono, email, direccion, ciudad, departamento)VALUES (:nombre, :apellidos, :telefono, :email, :direccion, :ciudad, :departamento)";

    try{

        //instanciar BD
        $db = new db();

        //conexión
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellidos',$apellidos);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':direccion',$direccion);
        $stmt->bindParam(':ciudad',$ciudad);
        $stmt->bindParam(':departamento',$departamento);
        $stmt->execute();

        echo '{"Notice":{"text": Cliente agregado" }';
        //Exportar y mostrar un sólo cliente en json

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().' }';
    }

});

//AGRACTUALIZAR UN CLIENTE
$app->put('/api/clientes/actualizar/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $nombre = $request->getParam('nombre');
    $apellidos = $request->getParam('apellidos');
    $telefono = $request->getParam('telefono');
    $email = $request->getParam('email');
    $direccion = $request->getParam('direccion');
    $ciudad = $request->getParam('ciudad');
    $departamento = $request->getParam('departamento');

    //procedimiento almacenado los : son comodines de variables temp para seguridad
    $consulta = "UPDATE clientes SET 
                nombre       = :nombre,
                apellidos    = :apellidos,
                telefono     = :telefono,
                email        = :email,
                direccion    = :direccion,
                ciudad       = :ciudad,
                departamento = :departamento
                WHERE id = $id";

    try{

        //instanciar BD
        $db = new db();

        //conexión
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellidos',$apellidos);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':direccion',$direccion);
        $stmt->bindParam(':ciudad',$ciudad);
        $stmt->bindParam(':departamento',$departamento);
        $stmt->execute();

        echo '{"Notice":{"text": Cliente actualizado" }';
        //Exportar y mostrar un sólo cliente en json

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().' }';
    }

});

//ELIMINAR UN SOLO CLIENTE
$app->delete('/api/clientes/borrar/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $consulta = "DELETE FROM clientes WHERE id = '$id'";

    try{

        //instanciar BD
        $db = new db();

        //conexión
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->execute();
        $db = null; //para cerrar consulta;

        echo '{"error":{"text": "Cliente borrado" }';

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().' }';
    }

});