<?php

class Renderer {
    static $page = FALSE;

    static public function view($route, $viewModel = FALSE){
        self::$page = $route;

        if($viewModel)
            foreach($viewModel as $key => $value)
                eval('$' . $key . '= $viewModel["$key"];');

        include(Renderer::layout());
    }

    static public function page(){
        return self::$page;
    }

    static public function layout(){
        return Route::VIEW_PATH . 'layout.php';
    }

    static public function header (){
        return Route::VIEW_PARTIAL_PATH . 'header.php';
    }

    static public function footer(){
        return Route::VIEW_PARTIAL_PATH . 'footer.php';
    }

    static public function mode(){
        return Route::VIEW_PARTIAL_PATH . 'mode.php';
    }
}