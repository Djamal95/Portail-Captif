<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class main extends MainSwitchers
{
    private string $ans = '';
    private string $alert = '';
    /**
     * Authentication page (login)
     * @param string $html
     * @return void
     */
    public final function index(
        string $html
    ): void {
        if (static::isValidMethod()) {
            $result = static::initQuery()['select']->selectUserByEmailAndPhone(
               static::getPost('__email__'),
               static::getPost('__phone__')
            );
            var_dump($html);die;
            [$this->ans, $this->alert] = static::Responses($result, [ false => ['error', 'login-wrong'] ]);
        }
        $this->views( $html,
            [
                'class' => $this->alert,
                'reponse' => $this->ans
            ]
        );
    }
    /**
    * Registration page view (Sign up)
    * 
    * @param string $html
    * @return void
    */
     public final function register(string $html): void{
    
        if (static::isValidMethod() && static::arrayNoEmpty(['__name__']) && static::arrayNoEmpty(['__surname__']) && static::arrayNoEmpty(['__phone__']) && static::arrayNoEmpty(['__email__'])) {
            $result = static::initQuery()['insert']->registerUser(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__phone__'),
                static::getPost('__email__')
            );
            if ($result === true) {
                $this->alert = "alert-success";
                $this->ans = static::initNamespace()['msg']->answers('register');
            } elseif(is_string($result)){
                $html = str_replace('register_ep','index_ep',$html);
                $this->alert = "alert-danger";
                $this->ans = $result;
            }else {
                $this->alert = "alert-danger";
                $this->ans = static::initNamespace()['msg']->answers('error');
            }
        }
        $this->views($html, [
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], false);
    }
}