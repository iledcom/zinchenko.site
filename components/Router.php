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
			//trim — Удаляет пробелы (или другие символы) из начала и конца строки
			// вторым параметром указываются символы которые нужно удалить
		}
	}

	public function run() {

		// Получить строку запроса
		$uri = $this->getURI();

		// Проверить наличие такого запроса в routes.php
		foreach($this->routes as $uriPattern => $path) {
			// Сравниваем $uriPattern и $uri
			if(preg_match("~$uriPattern~", $uri)) {
				// preg_match — Выполняет проверку на соответствие регулярному выражению
				// Ищет в заданном тексте subject ($uri) совпадения с шаблоном pattern ("~$uriPattern~").

				// Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				//preg_replace — Выполняет поиск и замену по регулярному выражению
				// Выполняет поиск совпадений в строке subject ($uri) с шаблоном pattern ("~$uriPattern~") и заменяет их на replacement ($path).

				// Определить controller, action параметры	
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
		//call_user_func_array — Вызывает callback-функцию с массивом параметров
		//Метод созданного объекта (object) передаётся как массив, содержащий объект по индексу 0 и имя метода по индексу 1
		
		if($result != null) {
			die;
		}
	}
}