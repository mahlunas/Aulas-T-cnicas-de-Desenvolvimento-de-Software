<?php

    class homeController{
        public function index(){
            require_once 'view/home.php';
        }

        public function greetUser(){
            
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $name = isset ($_POST['name']) ? $_POST['name']: '';

                $user = new User($name);
                
                require_once 'view/greeting.php';
            }
            else {
                header('Location: index.php');
            }
        }
    }