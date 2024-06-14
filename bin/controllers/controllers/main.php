<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class main extends MainSwitchers
{
    private string $ans = '';
    private string $alert = '';
    /**
     * Index page
     * @param string $html
     * @return void
     */
    public final function index(
        string $html
    ):void
    {
        $this->views($html, []);
    }
    
    /**
     * Authentification page ( login )
     * 
     * @param string $html
     * @return void
     */
    public final function login(
        string $html
    ): void
    {
        if (static::isValidMethod()) {

            $result = static::initConfig()['auth']->usersAuthManagers(
               static::getPost('__login__'),
               static::getPost('__password__')
            );

            [$this->ans, $this->alert] = static::Responses($result, [ false => ['error', 'login-wrong'] ]);
        }
        var_dump($this->ans);
        $this->views( $html,
            [
                'class' => $this->alert,
                'reponse' => $this->ans
            ]
        );
    }

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function register(string $html): void{
    
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__']) && static::arrayNoEmpty(['__surname__']) && static::arrayNoEmpty(['__phone__']) && static::arrayNoEmpty(['__email__'])){
            $result = static::initQuery()['insert']->registerUser(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__phone__'),
                static::getPost('__email__')
             );
            if($result){
                $this->alert = "alert-success";
                $this->ans = static::initNamespace()['msg']->answers('succes');
            }else{
                $this->alert = "alert-danger";
                $this->ans = static::initNamespace()['msg']->answers('error');
            }
        }
        $this->views( $html, [
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], false );
    }
}