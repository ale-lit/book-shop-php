<?php

  require_once("controllers/authorcontroller.php");
  require_once("controllers/genrecontroller.php");
  require_once("controllers/gendercontroller.php");

  class Router {
    private $routes;

    public function __construct() {
      require_once("configs/routes.php");
      $this->routes = $routes;
    }

    public function run() {
      $requestedUrl = $_SERVER['REQUEST_URI'];

      foreach ($this->routes as $controller=>$paths) {
        foreach ($paths as $url => $actionWithParameters) {
          if(preg_match("~$url~", $requestedUrl)) {
            $actionWithParameters = preg_replace("~" . SITE_ROOT . "$url~", $actionWithParameters, $requestedUrl);
            $actionWithParametersArray = explode('/', $actionWithParameters);
            $action = array_shift($actionWithParametersArray); // Извлекаем action
            $requestedController = new $controller();
            $requestedAction = "action" . ucfirst($action);
            call_user_func_array(array($requestedController, $requestedAction), $actionWithParametersArray);
            break 2;
          }
        }
      }

      // echo "<pre>";
      // print_r($_SERVER);
      // echo "</pre>";
    }
  }