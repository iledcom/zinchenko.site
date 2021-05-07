<?php

class Router {

	private $routes;

	public function __construct() {
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	/**
	* Returns request string
	* @Return string

	*/

	public function getURI(){
		if(!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run() {

		// Получить строку запроса
		$uri = $this->getURI();

		// Проверить наличие такого запроса в routes.php
		foreach($this->routes as $uriPattern => $path) {
			// Сравниваем $uriPattern и $uri
			if(preg_match("~$uriPattern~", $uri)) {
				// Если есть совпадение, определить какой controller и action брабатывает запрос
				$segments = explode('/', $path);
				$controllerName = array_shift($segments) . 'Controller';
				$controllerName = ucfirst($controllerName);
				//array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент.
				//ucfirst — Преобразует первый символ строки в верхний регистр
				$actionName = 'action' . ucfirst(array_shift($segments));
			}
		}

		// Подключить файл класса-контроллера
		$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

		if(file_exists($controllerFile)) {
			include_once($controllerFile);
		}

		// Создать объект, вызвать метод (т.е. action)
		$controllerObject = new $controllerName;
		$result = $controllerObject->$actionName();
		
		if($result != null) {
			die;
		}
	}
}