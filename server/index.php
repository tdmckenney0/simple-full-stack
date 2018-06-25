<?php

require_once('vendor/autoload.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Load the Environment
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

/**
 * Load the Database
 */
$capsule = new Capsule();
$capsule->addConnection([
    'driver' => $_ENV['DB_CONNECTION'],
    'database' => $_ENV['DB_DATABASE']
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

/**
 * Create The Test Table.
 */

Capsule::delete('DROP TABLE IF EXISTS `test_table`;');

Capsule::schema()->create('test_table', function ($table) {
    $table->increments('id');
    $table->string('name')->unique();
    $table->timestamps();
});

$res = Capsule::insert('INSERT INTO `test_table` (id, name) VALUES (1, "Savannah Wyatt");');
$res = Capsule::insert('INSERT INTO `test_table` (id, name) VALUES (2, "Lilianne Craig");');
$res = Capsule::insert('INSERT INTO `test_table` (id, name) VALUES (3, "David Craig");');

/**
 * Boot the Slim Framework 
 */
$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
});

$app->get('/', function (Request $request, Response $response, array $args) { 
    $data = Capsule::select('SELECT * FROM `test_table`;');

    $response->getBody()->write(json_encode($data));

    return $response;
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});

$app->run();