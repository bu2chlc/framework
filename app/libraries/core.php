<?php
// App core class
// creates URL & loads core controller
// URL format - /controller/method/params

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'Index';
    protected $params = [];

    public function __construct(){
    //    print_r($this->getUrl());
    $url = $this->getUrl();

    //look in controllers for first value
    if (file_exists('../app/controllers/'. ucwords($url[0]).'.php')){
        // if exists, set as current controller
        $this->currentController =ucwords($url[0]);
        // unset 0 index 
        unset($url[0]);
    }
    //require the controller
    require_once '../app/controllers/'.$this->currentController.'.php';
    //instantiate controller
    $this->currentController = new $this->currentController;

    // check for second part of URL
    if (isset($url[1])){
        // check to see if method exists in controller
        if (method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
            //unset second value in the array (params is the only part left)
            unset ($url[1]);
        }
    }
    // get params (if params exist, they get added otherwise empty array via ':' ternary)
    $this->params = $url ? array_values($url) : [];
    // call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl(){
        if (isset($_GET['url'])){
            // remove the trailing '/' at the end
            $url=rtrim($_GET['url'], '/');
            // sanitize the URL
            $url= filter_var($url, FILTER_SANITIZE_URL);
            // explode into an array
            $url=explode('/', $url);
            return $url;
        }
        $url[0]='/index';
        return $url;
    }
}