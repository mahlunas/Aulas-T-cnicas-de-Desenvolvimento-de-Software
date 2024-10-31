<?php

class UserController
{
    private $route;

    private $userDao;

    public function setDependecyInjection ($dependencyInjection)
    {
        $this->userDao = $dependencyInjection['userDao'];
    }

    public function createAction()
    {
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

                $this->userDao->add($user);

                $viewModel = array(
                    'users' => $this->userDao->list ()
                );

                $this->route = Route::route (['module' => 'user', 'action' => 'list']);

            }
            catch(Exception $e)
            {
                $this->route = Route::route (['module' => 'user', 'action' => 'create']);
            }
        }
        else
        {
            $this->route = Route::route (['module' => 'user', 'action' => 'create']);
        }

        return  Renderer::view($this->route, $viewModel);
    }

    public function updateAction()
    {

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

                $this->userDao->update($user);

                $viewModel = [
                    'users' => $this->userDao->list ()
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
                'user' => $this->userDao->getUser ($id)
            ];

            $this->route = Route::route (['module' => 'user', 'action' => 'update']);
        }

        return  Renderer::view($this->route, $viewModel);
    }

    public function listAction()
    {
        $viewModel = [
          'users' => $this->userDao->list(),
        ];

        $this->route = Route::route (['module' => 'user', 'action' => 'list']);

        return  Renderer::view($this->route, $viewModel);
    }

    public function deleteAction()
    {
        $id = array_key_exists ('id',$_REQUEST) ? $_REQUEST['id'] : '';

        $this->userDao->delete ($id);

        $viewModel = [
          'users' => $this->userDao->list(),
        ];

        $this->route = Route::route (['module' => 'user', 'action' => 'list']);

        return  Renderer::view($this->route, $viewModel);
    }
}
?>
