<?php

class Router {

	private $routes;

	public function __construct() {
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	public function run() {

		// Получить строку запроса

		// Проверить наличие такого запроса в routes.php

		// Если есть совпадение, определить какой controller
		// и action брабатывает запрос

		// Подключить файл класса-контроллера

		// Создать объект, вызвать метод (т.е. action)
	}
}