<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class main extends MainSwitchers
{
    private string $ans = '';
    private string $alert = '';
    private string $http = '';
    /**
     * Authentication page (login)
     * @param string $html
     * @return void
     */
    public final function index(
        string $html
    ): void {
        $userSession = static::isGet('magic', 'string') ? static::getGet('magic') : 0;
        $ipadress = static::getIpAdress();
        if (static::isValidMethod()) {
            $result = static::initQuery()['select']->selectUserByEmailAndpassword(
                static::getPost('__email__'),
                static::getPost('__password__')
            );
            if (!$result) {
                $this->alert = 'alert-danger';
                $this->ans = static::initNamespace()['msg']->answers('login-wrong');
            }else{
                if (static::sendHTTPSResponse($userSession, $ipadress, static::getPost('__email__'), static::getPost('__password__'))) {
                    $this->alert = 'alert-success';
                    $this->ans = static::initNamespace()['msg']->answers('login-succes');

                }else{
                    $this->http = static::initNamespace()['msg']->answers('error-server');
                }
            }
        }
        $this->views($html,[
            'class' => $this->alert,
            'response' => $this->ans,
            'session' => $userSession,
            'sendHttp' => $this->http
        ]);
    }

    /**
     * Registration page view (Sign up)
     * @param string $html
     * @return void
     */
    public final function register(string $html): void
    {
        if (static::isValidMethod() && static::arrayNoEmpty(['__email__']) && static::arrayNoEmpty(['__namesurname__']) && static::arrayNoEmpty(['__phone__']) && static::arrayNoEmpty(['__password__'])) {
            $result = static::initQuery()['insert']->registerUser(
                static::getPost('__email__'),
                static::getPost('__namesurname__'),
                static::getPost('__phone__'),
                static::getPost('__password__')
            );
            if ($result === true) {
                $this->alert = "alert-success";
                $this->ans = static::initNamespace()['msg']->answers('register');
            } elseif (is_string($result)) {
                $html = str_replace('register_ep', 'index_ep', $html);
                $this->alert = "alert-danger";
                $this->ans = $result;
            } else {
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
