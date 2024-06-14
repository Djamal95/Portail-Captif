<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class registration extends MainSwitchers
{
    private object $msg;
    private object $insert;    
    private string $alert =  '';
    private string $ans = '';

    /**
    * Initialize object properties when an instance is created
    * @return void
    */    
    public final function __construct()
    {
        $this->initializeObjects();
    }

    /**
    * Initialize each property using values retrieved from static configurations
    * @return void
    */
    private function initializeObjects(): void
    {
        $this->msg = $this->getFunctionObject(static::initNamespace(), 'msg');
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');

    }       
        
    /**
     * Start exemple page
     * @param string $html
     * @return void
    */      
    public final function exemplePages(string $html): void
    {
        $this->views( $html, [], false );
    }     
        

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function register(string $html): void{
    
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__']) && static::arrayNoEmpty(['__surname__']) && static::arrayNoEmpty(['__phone__']) && static::arrayNoEmpty(['__email__'])){
            $result = $this->insert->registerUser(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__phone__'),
                static::getPost('__email__')
             );
            if($result){
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers('succes');
            }else{
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers('error');
            }
        }
        $this->views( $html, [
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], false );
    }
}