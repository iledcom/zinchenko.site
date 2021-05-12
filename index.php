<?php
/*
// Format: dd-mm-yyyy
$string = '07.05.2021';

//Год 2021, месяц 05, день 21

$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';

$replacement = 'Год $3, месяц $2, день $1';

//preg_replace - Выполняет поиск и замену по регулярному выражению
echo preg_replace($pattern, $replacement, $string);


die;
*/



//FRONT CONTROLLER



//1.Общие настройки
ini_set('display_errors', 1);

error_reporting(E_ALL);



//2. Подключение файлов системы
define('ROOT', dirname(__FILE__));

require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/DataBase.php');



//3. Установка соединения с БД




//4. Вызов Router

$router = new Router();
$router->run();