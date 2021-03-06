<?php
ini_set('display_errors', 1);
define('WWW_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'Config.php';
require_once(WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'dataLogDAO.php');
require_once(WWW_ROOT . 'Slim' . DIRECTORY_SEPARATOR . 'Slim.php');

 
$app = new Slim();
 
$app->get('/datalog', 'getDatalog');
$app->get('/datalog/last', 'getLastDatalog');
$app->get('/datalog/:day',  'getDatalogOnDay');
$app->post('/datalog', 'addDataLog');
 
$app->run();


function getDatalog()
{
    $request = Slim::getInstance()->request();
    $datalogDAO = new dataLogDAO();
    $result = $datalogDAO->getDatalog();

    echo json_encode($result);
}

function getLastDatalog()
{
    $request = Slim::getInstance()->request();
    $datalogDAO = new dataLogDAO();
    $result = $datalogDAO->getLastDatalog();

    echo json_encode($result);
}

function addDataLog()
{
	$request = Slim::getInstance()->request();
    $datalogDAO = new dataLogDAO();

    $result = $datalogDAO->addDataLog($_GET['temperature'],$_GET['humidity'],$_GET['lux']);

    echo json_encode($result);
}

?>