<?php

class UserController
{
    private $route;

    public function createAction()
    {
        $message = Message::singleton ();
        $userDao = new UserDao();
        $viewModel = [];

        if(array_key_exists ('save', $_POST))
        {
            $name =  array_key_exists ('name', $_POST) ? $_POST['name'] : '';
            $email =  array_key_exists ('email', $_POST) ? $_POST['email'] : '';

            try
            {
                if(empty($name))
                    throw new Exception('Preencha o campo Nome.');

                if(empty($email))
                    throw new Exception('Preencha o campo Email.');

                $user = new User();
                $user->setName($name);
                $user->setEmail($email);

                $userDao->add($user);

                $viewModel = array(
                    'users' => $userDao->list ()
                );

                $this->route = Route::route (['module' => 'user', 'action' => 'list']);

            }
            catch(Exception $e)
            {
                $message->addWarning ($e->getMessage());
                $this->route = Route::route (['module' => 'user', 'action' => 'create']);
            }
        }
        else
        {
            $this->route = Route::route (['module' => 'user', 'action' => 'create']);
        }

        $message->save();
        return  Renderer::view($this->route, $viewModel);
    }

    public function updateAction()
    {
        $userDao = new UserDao();
        $viewModel = [];

        $id = array_key_exists ('id',$_REQUEST) ? $_REQUEST['id'] : '';

        if(array_key_exists ('save', $_POST))
        {

            $name =  array_key_exists ('name', $_POST) ? $_POST['name'] : '';
            $email =  array_key_exists ('email', $_POST) ? $_POST['email'] : '';

            try
            {
                if(empty($name))
                    throw new Exception('Preencha o campo Nome.');

                if(empty($email))
                    throw new Exception('Preencha o campo Email.');

                $user = new User();
                $user->setId($id);
                $user->setName($name);
                $user->setEmail($email);

                $userDao->update($user);

                $viewModel = [
                    'users' => $userDao->list ()
                ];

                $this->route = Route::route (['module' => 'user', 'action' => 'list']);
            }
            catch(Exception $e)
            {
                $this->route = Route::route (['module' => 'user', 'action' => 'create']);
            }
        }
        else
        {
            $viewModel = [
                'user' => $userDao->getUser ($id)
            ];

            $this->route = Route::route (['module' => 'user', 'action' => 'update']);
        }

        return  Renderer::view($this->route, $viewModel);
    }

    public function listAction()
    {
        $message = Message::singleton ();

        $userDao = new UserDao();

        $viewModel = [
          'users' => $userDao->list(),
        ];
        
        $message->addMessage ('Usuários listados com sucesso!');

        $message->save ();

        $this->route = Route::route (['module' => 'user', 'action' => 'list']);

        return  Renderer::view($this->route, $viewModel);
    }
}

?>
