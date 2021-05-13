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
				// Получаем внутренний путь из внешнего согласно правилу

				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				// определить controller, action параметры
				
				$segments = explode('/', $internalRoute);
				// explode - Разбивает строку с помощью разделителя
				// Возвращает массив строк, полученных разбиением строки string 
				// с использованием separator в качестве разделителя
				$controllerName = array_shift($segments) . 'Controller';
				$controllerName = ucfirst($controllerName);
				//array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент.
				//ucfirst — Преобразует первый символ строки в верхний регистр
				$actionName = 'action' . ucfirst(array_shift($segments));
				$parameters = $segments;
			}
		}

		// Подключить файл класса-контроллера
		$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

		if(file_exists($controllerFile)) {
			include_once($controllerFile);
		}

		// Создать объект, вызвать метод (т.е. action)
		$controllerObject = new $controllerName;
		//$result = $controllerObject->$actionName($parameters);
		$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
		
		if($result != null) {
			die;
		}
	}
}