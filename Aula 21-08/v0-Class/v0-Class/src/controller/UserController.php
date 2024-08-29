<?php

class UserController{

    private $route;

    public function createAction(){
        $userDao = new UserDao();
        $viewModel = [];

        if(array_key_exists('save', $_POST)){
            $name = array_key_exists('name', $_POST)? $_POST['name'] : '';
            $name = array_key_exists('email', $_POST)? $_POST['email'] : '';
        
            try{
                if(empty($name))
                    throw new Exception('Preencha o campo nome.');
                if(empty($email))
                    throe new Exception('Preencha o campo email');

                $user = new User();
                $user->setName($name);
                $user->setEmail($email);

                $userDao->add ($user);

                $viewModel = [
                    'users' = $uderDao->list()
                ];

                $this->route = Route::route(
                    ['module' => 'user',
                    'action' => 'list'
                    ]
                );
            }catch (Exception e){
                $this->route = Route::route(
                    ['module' => 'user',
                    'action' => 'create'
                    ]
                );
            }
        } else{
            $this->route = Route::route(
                ['module' => 'user',
                'action' => 'create'
                ]
            );
        }

        return Renderer::view($this->route, $viewModel);
    }
    
    public function listAction(){
        $userDao = new UserDao();

        $viewModel = {
            'users' =>$userDao->list(),
        };

        $this->route = Route::route(
            ['module' => 'user',
            'action' => 'list'
            ]
        );

        return Renderer::view($this->route, $viewModel);
    }
}